
<html>
  <header>
    <link rel="stylesheet" href="style.css" type="text/css">
  </header>
  <head>
    <style>
      .error {
        text-align:center;
        width:150px;
        border: 2px solid red;
        gap:2px;
      }
    </style>
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
      <input name="name" placeholder="name" <?php if ($errors['name']) {print 'class="error"';} ?> name_value="<?php print $values['name'];?>" >
      </label>
      <label>
      <?php
        printf('Почта:');
      ?>
      <br>
      <input name="email" type="email" placeholder="email" <?php if ($errors['email']) {print 'class="error"';} ?> email_value="<?php print $values['email']; ?>">
      </label>
      <label>
      <?php
        printf('Год рождения:');
      ?>
      <br>
      <input name="year" placeholder="year" <?php if ($errors['year']) {print 'class="error"';} ?> year_value="<?php print $values['year']; ?>">
      </label>
      <label <?php if ($errors['gender']) {print 'class="error"';} ?> gender_value="<?php print $value['gender']; ?>">
      <?php
        printf('Пол:');
      ?>
      <br>
      <?php
        printf('М');
      ?>
      <input type="radio" name="gender" value="1" >
      <?php
        printf('Ж');
      ?>
      <input type="radio" name="gender" value="2">
      </label>
      <label  <?php if ($errors['count_limb']) {print 'class="error"';} ?> count_limb_value="<?php print $values['count_limb']; ?>">
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
      <label  <?php if ($errors['abilities']) {print 'class="error"';} ?> abilities_value="<?php print $values['abilities']; ?>">
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
      <textarea name="biography" placeholder="about me"  <?php if ($errors['biography']) {print 'class="error"';} ?> biography_value="<?php print $values['biography_limb']; ?>"></textarea>
      </label>
      <label <?php if ($errors['checked']) {print 'class="error"';} ?> checked_value="<?php print $values['checked_limb']; ?>">
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
