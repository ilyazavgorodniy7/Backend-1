<html>
<header>
  <link rel="stylesheet" href="style.css" type="text/css">
</header>
<body>
<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if (!empty($_SESSION['login'])) {
  // Если есть логин в сессии, то пользователь уже авторизован.
  // TODO: Сделать выход (окончание сессии вызовом session_destroy()
  //при нажатии на кнопку Выход).
  // Делаем перенаправление на форму.
  header('Location: ./');
}

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>

<form action="index.php" method="POST">
  <input name="login" placeholder="login"/>
  <input name="password"  placeholder="password"/>
  <input type="submit" value="Войти" />
</form>
<?php
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
  // TODO: Проверть есть ли такой логин и пароль в базе данных.
  // Выдать сообщение об ошибках.
  // Если все ок, то авторизуем пользователя.
  $_SESSION['login'] = $_POST['login'];
  // Записываем ID пользователя.
  $_SESSION['user_id'] = $db->lastInsertId();;

  // Делаем перенаправление.
  header('Location: ./');
}
?>
</body>
</html>
