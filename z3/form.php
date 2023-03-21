include('style.css');
<form action="index.php" method="POST">
  <?php
    <label class="user-name">
    printf('Имя пользователя:');
    <br>
    <input name="name" placeholder="name">
    <br>
    </label>
  ?>
  <input name="fio" />
  <input name="year" placeholder="year">
  <input type="submit" value="ok" />
</form>
