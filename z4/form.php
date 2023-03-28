
<html>
  <head>

    <style>
      .error {
        border: 2px solid red;
      }
    </style>
        <link rel="stylesheet" href="style.css" type="text/css">
  </head>
  <body>
  <?php
  if (!empty($messages)) {
    print('<div id="messages">');
    foreach ($messages as $message) {
      print($message);
    }
    print('</div>');
  }
  ?>
  <form action="index.php" method="POST">
      <label>
      <?php
        printf('Имя пользователя:');
      ?>
      <br>
      <input name="name" placeholder="name">
      </label>
      <label>
      <?php
        printf('Почта:');
      ?>
      <br>
      <input name="email" type="email" placeholder="email">
      </label>
      <label>
      <?php
        printf('Год рождения:');
      ?>
      <br>
      <input name="year" placeholder="year">
      </label>
      <label>
      <?php
        printf('Пол:');
      ?>
      <br>
      <?php
        printf('М');
      ?>
      <input type="radio" name="gender" value="1">
      <?php
        printf('Ж');
      ?>
      <input type="radio" name="gender" value="2">
      </label>
      <label>
      <?php
        printf('Количество конечностей: ');
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
      </label>
      <label>
      <?php
        printf('Сверхспособности:');
      ?>
      <br>
      <select name="abilities[]" multiple="multiple"> 
        <option value="1">Бессмертие</option>
        <option value="2">Проходить сквозь стены</option>
        <option value="3">Левитация</option>
      </select>
      </label>
      <label>
      <?php
        printf('Биография:');
      ?>
      <br>
      <textarea name="biography" placeholder="about me"></textarea>
      </label>
      <label>
      <?php
        printf('С контрактом ознакомлен(-а)');
      ?>
      <input type="checkbox" name="checked" value="on">
      </label>
      <label>
      <input type="submit" value="ok" class="button"/>
      </label>
    </form>
  </body>
</html>
