<?php
header('Content-Type: text/html; charset=UTF-8');
$bioreg = "/^\s*\w+[\w\s\.,-]*$/";
$reg = "/^\w+[\w\s-]*$/";
$mailreg = "/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";
$list_abilities = array('1','2','3');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
	
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('password', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
    if (!empty($_COOKIE['password'])) {
      $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
        и паролем <strong>%s</strong> для изменения данных.',
        strip_tags($_COOKIE['user_id']),
        strip_tags($_COOKIE['password']));
    }
  }
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['count_limb'] = !empty($_COOKIE['count_limb_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['checked'] = !empty($_COOKIE['checked_error']);
  $errors['abilities'] = !empty($_COOKIE['abilities_error']);
	

  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма имени</div>';
  }
	if ($errors['year']) {
    setcookie('year_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма года</div>';
  }
	if ($errors['email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма email</div>';
  }
	if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages[] = '<div class="error">Выберите пол</div>';
  }
	if ($errors['count_limb']) {
    setcookie('count_limb_error', '', 100000);
    $messages[] = '<div class="error">Выберите кол-во конечностей</div>';
  }
	if ($errors['biography']) {
    setcookie('biography_error', '', 100000);
    $messages[] = '<div class="error">Неправильная форма биографии</div>';
  }
	if ($errors['checked']) {
    setcookie('checked_error', '', 100000);
    $messages[] = '<div class="error">Примите согласие</div>';
  }
	if ($errors['abilities']) {
    setcookie('abilities_error', '', 100000);
    $messages[] = '<div class="error">Выберите суперсилу</div>';
  }
	
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? '' : $_COOKIE['year_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['count_limb'] = empty($_COOKIE['count_limb_value']) ? '' : $_COOKIE['count_limb_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['checked'] = empty($_COOKIE['checked_value']) ? '' : $_COOKIE['checked_value'];
  $values['abilities'] = empty($_COOKIE['abilities_value']) ? '' : $_COOKIE['abilities_value'];
  include('form.php');
}
else {
  $errors = FALSE;
if (empty($_POST['name']) || !preg_match($reg,$_POST['name'])) {
    setcookie('name_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60 * 12);
  }
	
if (empty($_POST['email']) || !preg_match($mailreg,$_POST['email'])) {
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60 * 12);
  }
if (empty($_POST['year']) || !is_numeric($_POST['year']) || !preg_match('/^\d+$/', $_POST['year'])) {
    setcookie('year_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('year_value', $_POST['year'], time() + 30 * 24 * 60 * 60 * 12);
  }
if (empty($_POST['biography']) || !preg_match($bioreg,$_POST['biography'])) {
    setcookie('biography_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60 * 12);
  }
if (empty($_POST['gender'])) {
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('gender_value', $_POST['gender'], time() + 30 * 24 * 60 * 60 * 12);
  }
if (empty($_POST['count_limb'])) {
    setcookie('count_limb_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('count_limb_value', $_POST['count_limb'], time() + 30 * 24 * 60 * 60 * 12);
  }
if (empty($_POST['checked'])) {
    setcookie('checked_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    setcookie('checked_value', $_POST['checked'], time() + 30 * 24 * 60 * 60 * 12);
  }

if(empty($_POST['abilities'])){
	setcookie('abilities_error', '1', time() + 24 * 60 * 60);
	$errors = TRUE;
}
else {
    	setcookie('abilities_value', $_POST['abilities'], time() + 30 * 24 * 60 * 60 * 12);
 }

  if ($errors) {
    header('Location: index.php');
    exit();
  }

  $user = 'u52826';
  $pass = '4927417';
  $db = new PDO('mysql:host=localhost;dbname=u52826', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  try {
	  $stmt = $db->prepare("INSERT INTO person SET name = ?,email= ?, year= ?, gender= ?, count_limb= ?, biography= ?,checked= ?");
	  $stmt->execute([$_POST['name'],$_POST['email'],$_POST['year'],$_POST['gender'],$_POST['count_limb'],$_POST['biography'],$_POST['checked']]);
	  
	  $password = $db->prepare("INSERT INTO user_info SET login = ?, password = ?");
	  $password->execute([$_POST['login'],$_POST['password']]);
	  
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
if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
    // TODO: перезаписать данные в БД новыми данными,
    // кроме логина и пароля.
}
else {
    // Генерируем уникальный логин и пароль.
    // TODO: сделать механизм генерации, например функциями rand(), uniquid(), md5(), substr().
    $login = $db->lastInsertId();;
    $password = '';
    $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0','.',',',
                 '(',')','[',']','!','?',
                 '&','^','%','@','*','$',
                 '<','>','/','|','+','-',
                 '{','}','`','~');
    for($i = 0; $i < $number; $i++)
    {
      $index = rand(0, count($arr) - 1);
      $password .= $arr[$index];
    }
    // Сохраняем в Cookies.
    setcookie('login', $login);
    setcookie('password', $password);

    // TODO: Сохранение данных формы, логина и хеш md5() пароля в базу данных.
  }
  setcookie('save', '1');
  header('Location: ?save=1');
}
