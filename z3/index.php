<?php
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

$abilities = array($_POST['abilities']);
$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$list_abilities = array('immortality','pass_through_walls','levitation');

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
if(!preg_match($mailreg,$_POST['email'])){
        print_r('Неверный формат email');
	exit();
}
if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
 	print('Неверно указан год.<br/>');
	exit();
}
if(!preg_match($reg,$_POST['name'])){
	print_r('Неверный формат имени');
	exit();
}
if(!preg_match($bioreg,$_POST['biography'])){
	print_r('Неверный формат биографии');
	exit();
}
foreach($abilities as $checking){
	if(array_search($checking,$list_abilities)=== false){
		print_r('Неверный формат суперсил');
		exit();
	}
}

if ($errors) {
  exit();
}

$user = 'u52826';
$pass = '4927417';
$db = new PDO('mysql:host=localhost;dbname=u52826', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$list_abilities = array('immortality','pass_through_walls','levitation');
try {
  $stmt = $db->prepare("INSERT INTO person SET name = ?,email= ?, year= ?, gender= ?, count_limb= ?, biography= ?,checked= ?");
  $stmt->execute([$_POST['name'],$_POST['email'],$_POST['year'],$_POST['gender'],$_POST['count_limb'],$_POST['biography'],$_POST['checked']]);
  
  $id = $db->lastInsertId();
  $sppe= $db->prepare("INSERT INTO abilities SET power=:power, person_id=:person");
  $sppe->bindParam(':person', $id);
  foreach($abilities  as $ability){
	$sppe->bindParam(':power', $ability);
	if($sppe->execute()==false){
	  print_r($sppe->errorCode());
	  print_r($sppe->errorInfo());
	  exit();
	}
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
header('Location: ?save=1');
