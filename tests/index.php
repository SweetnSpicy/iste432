<?php
  include_once "testing.php";
  
  $db = new DB();
  $db->createDB();

  $id = $db->insertUser("cxm1544","password","Admin");
  if($id > 0){
      echo "<p> You inserted 1 row whose id is $id.</p>";
  } else{
      echo "<p> Failed to insert a ropw </p>";
  }
  $n = $db->delete(3);

  $str = $db->getAllUsers();
  echo $str;
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title; ?></title>
</head>
<body>

</body>
</html>
