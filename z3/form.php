<form action="" method="POST">
  <input name="fio" placeholder="fio"/>
  </br>
  <input name="mail" placeholder="mail">
  </br>
  <input name="year" placeholder="year">
  </br>
  <label>
    <input name="gender" type="radio" value="man">
    <?php
    printf('man');
    ?>
    <input name="gender" type="radio" value="woman">
    <?php
    printf('woman');
    ?>
   </label>
  </br>
  <label>
    <?php
      printf('Кол-во конечностей:');
    ?>
    </br>
    <input name="count_limb" type="radio" value="2-4">
    <?php
      printf('2-4');
    ?>
    <input name="count_limb" type="radio" value="5-7">
    <?php
      printf('5-7');
    ?>
    <input name="count_limb" type="radio" value="8-10">
    <?php
      printf('8-10');
    ?>
   </br>
   </label>
   <select name="abilities[]" multiple="multiple">
     <option value="Бессмертие" name="immortality">Бессмертие</option>
     <option value="Стены" name="pass_through_walls">Проходить сквозь стены</option>
     <option value="Левитация" name="levitation">Левитация</option>
   </select>
   <br>
   <?php
   printf('Biography');
   ?>
   </br>
   <textarea name="biography" type="textarea" placeholder="about me"></textarea>
   </br>
   <input type="checkbox" name="checked" value="on">
    С контрактом ознакомлен(а)
   </br>
   <input type="submit" value="submit" />
</form>
