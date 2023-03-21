<link rel="stylesheet" href="style.css" type="text/css">
<form action="index.php" method="POST">
    <label class="user-name">
    <?php
      printf('Имя пользователя:');
    ?>
    <input name="name" placeholder="name">
    </label>
    <?php
      printf('Почта:');
    ?>
    <input name="email" type="email" placeholder="email">
    <?php
      printf('Год рождения:');
    ?>
    <input name="year" placeholder="year">
    <?php
      printf('Пол:');
      printf('М');
    ?>
    <input type="radio" name="gender" value="1">
    <?php
      printf('Ж');
    ?>
    <input type="radio" name="gender" value="2">
    <?php
      printf('Количество конечностей:');
      printf('1');
    ?>
    <input type="radio" value="1" name="count_limb">
    <?php
      printf('2');
    ?>
    <input type="radio" value="2" name="count_limb">
    <?php
      printf('3');
    ?>
    <input type="radio" value="3" name="count_limb">
    <?php
      printf('Сверхспособности:');
    ?>
    <select name="abilities[]" multiple="multiple"> 
      <option value="1">Бессмертие</option>
      <option value="2">Проходить сквозь стены</option>
      <option value="3">Левитация</option>
    </select>
    <?php
      printf('Биография:');
    ?>
    <textarea name="biography" placeholder="about me"></textarea>
    <?php
      printf('С контрактом ознакомлен(а)');
    ?>
    <input type="checkbox" name="checked" value="on">
    <input type="submit" value="ok" />
  </form>
