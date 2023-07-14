<?php
class UserView extends User{

  public function logIn($username, $pass){
    $user_data = $this->userLogIn($username, $pass);
    if (password_verify($pass, $user_data['pass'])){
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

  public function getAllUsersData(){
    $users_data = $this->getAllUsers();
    foreach ($users_data as $id_user => $data) {
      foreach ($data as $key => $value) {
        $res[$id_user][$key] = $value;
      }
    }
    return $res;
  }

  public function getUserDirectory($id_user){
    $data = $this->getDataById($id_user);
    return $data['directory'];
  }

  public function countFilesInTask($id_user, $task){
    $dir = $this->getUserDirectory($id_user);
    $directory = __DIR__."/../../../users_submissions/".$dir."/".$task."/";
    $files = scandir($directory);
    if ($files){
      return count($files)-2;
    } else {
      return 0;
    }
  }

  public function getFilesInTask($id_user, $task){
    $dir = $this->getUserDirectory($id_user);
    $directory = "../../../users_submissions/".$dir."/".$task."/";
    $files = scandir($directory);
    unset($files[0]);
    unset($files[1]);
    $files = array_values($files);
    return $files;
  }

  public function get_user_hodnotenie($id_user, $id_task, $id_admin, $check = false){
    return $this->getUserHodnotenie($id_user, $id_task, $id_admin, $check);
  }

  public function get_hodnotenie($id_user, $id_admin){
    $body = $this->getHodnotenie($id_user, $id_admin);
    if($body >= 72){
      $znamka = 1;
    } else if(($body <= 71) && ($body >= 56)){
      $znamka = 2;
    } else if(($body <= 55) && ($body >= 40)){
      $znamka = 3;
    } else if(($body <= 39) && ($body >= 20)){
      $znamka = 4;
    } else if($body <= 19){
      $znamka = 5;
    }
    if (!empty($body)){
      return "$body b => $znamka";
    } else {
      return "";
    }
  }
}
?>
