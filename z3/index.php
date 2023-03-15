<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }

  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.

$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$list_sup = array('immortality','pass_through_walls','levitation');

$errors = FALSE;
if(empty($_POST['name'])){
	print_r('Заполните Имя!');
	exit();
}
if(empty($_POST['email'])){
	print_r('Заполните email!');
	exit();
}
if(empty($_POST['year'])){
	print_r('Заполните год!');
	exit();
}
if(empty($_POST['biography'])){
	print_r('Заполните биографию!');
	exit();
}
if(empty($_POST['gender'])){
	print_r('Заполните пол!');
	exit();
}
if(empty($_POST['count_limb'])){
	print_r('Заполните кол-во конечностей!');
	exit();
}

if (empty($_POST['mail']) || !preg_match('/@/', $_POST['mail']) ) {
  print('Не верно указана почта.<br/>');
  $errors = TRUE;
}

if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
  print('Неверно указан год.<br/>');
  $errors = TRUE;
}

if(!preg_match($reg,$_POST['name'])){
	print_r('Неверный формат имени');
	exit();
}
if(!preg_match($bioreg,$_POST['biography'])){
	print_r('Неверный формат биографии');
	exit();
}
if(!preg_match($mailreg,$_POST['mail'])){
	print_r('Неверный формат email');
	exit();
}

// *************
// Тут необходимо проверить правильность заполнения всех остальных полей.
// *************

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u52826'; // Заменить на ваш логин uXXXXX
$pass = '4927417'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=u52826', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO person SET name = ?,mail= ?, year= ?, gender= ?, count_limb= ?, biography= ?,checked= ?");
  $stmt->execute([$_POST['fio'],$_POST['mail'],$_POST['year'],$_POST['gender'],$_POST['count_limb'],$_POST['biography'],$_POST['checked']]);
  
  $id = $db->lastInsertId();
  $sppe= $db->prepare("INSERT INTO super SET name=:name, per_id=:person");
  $sppe->bindParam(':person', $id);
  foreach($_POST['abilities'] as $ability ){
    $sppe->bindParam(':name', $ability);
    $sppe->execute($_POST['abilities']);
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}


//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
