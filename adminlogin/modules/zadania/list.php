<?php
  $per = $adminV->getAdminPermissionByIds($_SESSION['admin_logged'], 5);
  if($per == 0 ){
    header("Location: ".HOMEPAGE);
  }
  $user = new UserView();
  $userC = new UserController();
  $data = $user->getAllUsersData();
  if($per == 3 ){
    if(isset($_POST['save'])){
      foreach ($data as $id_user => $row) {
        for($i = 1;$i<=TASKS;$i++){
          $values[$id_user][$i] = $_POST["$id_user-$i"];
        }
      }
      $userC->saveHodnotenie($values, $_SESSION['admin_logged']);
      //header("Refresh:0");
    }
  }
?>
<script type="text/javascript" src="js/service.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/jquery.tablesorter.pager.min.css" integrity="sha512-TWYBryfpFn3IugX13ZCIYHNK3/2sZk3dyXMKp3chZL+0wRuwFr1hDqZR9Qd5SONzn+Lja10hercP2Xjuzz5O3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
-->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row col-sm-12 col-md-12">
      <div class="col-md-6"><h6 class="m-0 font-weight-bold text-primary">Zoznam žiakov</h6></div>
      <div class="col-md-6"><a class="btn btn-warning" href="/adminlogin/modules/zadania/organizacne_pokyny_a_zadania-ISS.pdf" download="Oraganizačné pokyny a zadania.pdf">Oraganizačné pokyny a zadania</a></div>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <p class="text-danger"><strong>Pri nahrávaní hodnotenia si prácu priebežne ukladajte (zelené tlačidlo "Uložiť" v dolnej časti stránky). V prípade potreby máte v hornej časti "Organizačné pokyny a zadania" v ktorých nájdete kritéria hodnotenia a počty bodov, ktoré môžete udeliť za jednotlivé úlohy.</strong></p>
        <form method="POST">
        <div class="row col-sm-12 col-md-12">
          <table class="table table-bordered dataTable tablesorter" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
              <tr role="row">
                <th class="sorting_asc text-center" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 40px;">ID</th>
                <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" aria-label="Meno: activate to sort column ascending" style="width: 300px;">Meno</th>
                <th class="text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="<?php echo TASKS;?>" style="width: 97px;">Úloha</th>
                <th class="sorting text-center" rowspan="2" style="width: 96px;">Skupina</th>
                <th class="sorting text-center" rowspan="2" style="width: 96px;">Hodnotenie</th>
                <th rowspan="2" style="width: 96px;"></th>
                <tr role="row">
                  <?php
                    for($i = 1;$i<=TASKS;$i++){
                      echo "<th class='text-center' tabindex='0' aria-controls='dataTable' rowspan='1' colspan='1' style='width: 97px;'>".$i."</th>";
                    }
                  ?>
                </tr>
              </tr>
            </thead>
            <tbody>
              <?php
              $json = json_decode("");
                foreach ($data as $id_user => $row) {
                  echo '
                  <tr role="row" class="odd">
                    <td class="sorting_1 text-center">'.$id_user.'</td>
                    <td>'.$row['fullname'].'</td>';
                      $p = 0;
                      for($i = 1;$i<=TASKS;$i++){
                        $value = $user->get_user_hodnotenie($id_user, $i,$_SESSION['admin_logged']);
                        $p += $user->countFilesInTask($id_user, $i);
                        $check = ($user->countFilesInTask($id_user, $i)>0?True:False);
                        if ($check){
                          echo "<td class='text-center'><input class='form-control' id='$id_user-$i' name='$id_user-$i' type='number' value='$value' min='0' max='20'></td>";
                        } else {
                          echo "<td class='text-center'><input hidden class='form-control' id='$id_user-$i' name='$id_user-$i' type='number' value='0' min='0' max='20'><i class='fa-solid fa-circle-xmark'></i></td>";
                        }
                      }
                    echo '<td class="text-center">'.$row['type'].'</td>';
                    echo '<td class="text-center">'.$user->get_hodnotenie($id_user, $_SESSION['admin_logged']).'</td>';
                    if ($p>0) {
                      echo '<td class="text-center"><a class="btn btn-primary" href="/adminlogin/modules/zadania/dir.php?id_user='.$id_user.'&task=all">Stiahnuť</a></td>';
                    } else {
                      echo '<td></td>';
                    }
                    echo '
                  </tr>
                  ';
                }
              ?>
            </tbody>
          </table>  
        </div>
        <div class="col-md-2">
          <button class="btn btn-success w-100" type="submit" name="save">Uložiť</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
  //include 'theme/footer.php';
 ?>
