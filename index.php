<?php
  session_start();
  include "init.php";
  $_SESSION['page'] = 'index';
  if (!isset($_SESSION['user']) && isset($_POST['user']) && isset($_POST['pass'])){
    $user = new UserView();
    $id_user = $user->logIn($_POST['user'], $_POST['pass']);
    if ($id_user>0){
      $_SESSION['user'] = $id_user;
    }
  }
  if (isset($_SESSION['user']) && isset($_POST['logOut'])){
    unset($_SESSION['user']);
  }

  include "theme/pcoz/page.php";
  include "theme/pcoz/header.php";

  if(!isset($_SESSION['user'])){
    include "login_page.php";
  }
  else {
    include "content.php";
  }

  include "theme/pcoz/footer.php";
  $_SESSION['page'] = '';
?>