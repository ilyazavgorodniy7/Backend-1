<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
  }
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['email'] = !empty($_COOKIE['emal_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['count_limb'] = !empty($_COOKIE['count_limb_error']);
  $errors['biography '] = !empty($_COOKIE['biography_error']);
  $errors['checked'] = !empty($_COOKIE['checked_error']);
  $errors['abilities'] = !empty($_COOKIE['abilities_error']);
	
  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];

  include('form.php');
}

$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$list_abilities = array('1','2','3');
else {
  $errors = FALSE;
  if (empty($_POST['name'])) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('name_value', $_POST['fio'], time() + 30 * 24 * 60 * 60 * 12);
  }
  if (empty($_POST['name'])) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('name_value', $_POST['fio'], time() + 30 * 24 * 60 * 60 * 12);
  }	


  if ($errors) {
    header('Location: index.php');
    exit();
  }
  else {
    setcookie('name_error', '', 100000);
  }

  $user = 'u52826';
  $pass = '4927417';
  $db = new PDO('mysql:host=localhost;dbname=u52826', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  try {
	  $stmt = $db->prepare("INSERT INTO person SET name = ?,email= ?, year= ?, gender= ?, count_limb= ?, biography= ?,checked= ?");
	  $stmt->execute([$_POST['name'],$_POST['email'],$_POST['year'],$_POST['gender'],$_POST['count_limb'],$_POST['biography'],$_POST['checked']]);

	  $id = $db->lastInsertId();
	  $sppe= $db->prepare("INSERT INTO abilities SET power_id=:power, person_id=:person");
	  $sppe->bindParam(':person', $id);
	  foreach($_POST['abilities']  as $ability){
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
  setcookie('save', '1');
  header('Location: index.php');
}












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
 	print('Неверно указан год.');
	exit();
}
if(empty($_POST['checked'])){
	print('Примите согласие');
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
foreach($_POST['abilities'] as $checking){
	if(array_search($checking,$list_abilities)=== false){
		print_r('Неверный формат суперсил');
		exit();
	}
}

if ($errors) {
  exit();
}


header('Location: ?save=1');
