<form action="" method="POST">
  <input name="fio" placeholder="fio"/>
  <input name="mail" placeholder="mail">
  <input name="year" placeholder="year">
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
  <input type="submit" value="ok" />
</form>
