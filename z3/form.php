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
    printf('Кол-во конечностей');
    <input name="count_limb" type="radio" value="2-4">
    printf('2-4');
    <input name="count_limb" type="radio" value="5-7">
    printf('5-7');
    <input name="count_limb" type="radio" value="8-10">
    printf('8-10');
    ?>
   </label>
   
  <input type="submit" value="ok" />
</form>
