<?php
session_start();
if (isset($_POST['dropdown'])) {
  $dropdown = $_POST['dropdown'];
  // Perform any other operations or assignments with $dropdown as needed
  $_SESSION['dropdown'] = $dropdown; // Assign the value to the session variable
  echo 'Success';
  print_r($_POST);
}
?>
