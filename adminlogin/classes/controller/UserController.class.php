<?php
class UserController extends User{
  public function uploadSubmission($id_user, $filename, $task){
    $this->uploadSubmissionFiles($id_user, $filename, $task);
  }

  public function update_user_data($id, $fullname, $username, $email, $directory, $active){
    $active = ($active==NULL)?0:$active;
    $this->updateUserData($id, $fullname, $username, $email, $directory, $active);
  }

  public function change_password($id, $old_pass, $new_pass,$was_lost = 0){
    $cost = 12;
    $pwd = password_hash($new_pass, PASSWORD_DEFAULT, ['cost' => $cost]);
    if ($was_lost == 1){
      if (!empty($pwd)){
        $this->changePassword($id, $pwd);
        return "Heslo bolo zmenené";
      } else {
        return "Heslo nebolo zmenené";
      }
    } else {
      if (($id == $_SESSION['admin_logged'] && password_verify($old_pass, $this->getDatabyId($id)['pass'])) || ($_SESSION['admin_role'] == 1)) {
        if (!empty($pwd)){
          $this->changePassword($id, $pwd);
          return "Heslo bolo zmenené";
        }
      } else {
        return "Zlé pôvodné heslo";
      }
    }
  }

  public function saveHodnotenie($data,$id_admin){
    $user = new UserView();
    foreach ($data as $id_user => $tasks) {
      foreach ($tasks as $id_task => $val) {
        $value = $user->get_user_hodnotenie($id_user, $id_task, $id_admin, true);
        if ($value > 0){
          $this->updateHodnotenie($id_admin, $id_user, $id_task, $val);
        } else {
          if ($val != 0){
            $this->insertHodnotenie($id_admin, $id_user, $id_task, $val);
          } else {
            $this->insertHodnotenie($id_admin, $id_user, $id_task, 0);
          }
        }
      }
    }
  }

  /*public function rating($id_user, $data){
    if (empty($this->getRating($id_user))){
      $this->insertRating($id_user, $data);
    } else {
      $this->updateRating($id_user, $data);
    }
  }*/
}
?>