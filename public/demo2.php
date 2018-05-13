<?php
  function authenticate() {
    header('WWW-Authenticate: Basic realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You must enter a valid login ID and password to access this resource<br/>";
    exit;
  }

  if (!isset($_SERVER['PHP_AUTH_USER']) ||
      (isset($_POST['SeenBefore']) && $_POST['SeenBefore'] == 1 && isset($_POST['OldAuth']) && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER'])) {
   authenticate();
  }else {
   echo "<p>Welcome: {$_SERVER['PHP_AUTH_USER']}<br>";
   //echo "Old: {$_REQUEST['OldAuth']}";
   echo "<form action='{$_SERVER['PHP_SELF']}' METHOD='POST'><br/>";
   echo "<input type='hidden' name='SeenBefore' value='1'><br/>";
   echo "<input type='hidden' name='OldAuth' value='{$_SERVER['PHP_AUTH_USER']}'><br/>";
   echo "<input type='submit' value='Re Authenticate'><br/>";
   echo "</form></p><br/>";
  }
?>