<?php
class UserView extends User{

  public function logIn($username, $pass){
    $cost = 12;
    $user_data = $this->userLogIn($username);
    if (password_verify($pass, $user_data['pass']) && $user_data['active'] == 1){
      if (password_needs_rehash($user_data['pass'], PASSWORD_DEFAULT, ['cost' => $cost])) {
        $pwd = password_hash($pass, PASSWORD_DEFAULT, ['cost' => $cost]);
        if (!empty($pwd)){
          $this->changePassword($user_data['id_user'], $pwd);
        }
      }
      return $user_data['id_user'];
    } else {
      return 0;
    }
  }

  public function getData($id){
    $user_data = $this->getDataById($id);
    foreach ($user_data as $key => $value) {
      $res[$key] = $value;
    }
    return $res;
  }

  public function countSubmissionByTask($id_user, $task){
    return count($this->getSubmissionByTask($id_user, $task));
  }
}
?>