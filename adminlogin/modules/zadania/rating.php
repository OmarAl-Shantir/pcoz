<?php
  include "theme/page.php";
?>
<script type="text/javascript" src="js/service.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js" integrity="sha512-qzgd5cYSZcosqpzpn7zF2ZId8f/8CHmFKZ8j7mU4OUXTNRd5g+ZHBPsgKEwoqxCtdQvExE5LprwwPAgoicguNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.widgets.min.js" integrity="sha512-dj/9K5GRIEZu+Igm9tC16XPOTz0RdPk9FGxfZxShWf65JJNU2TjbElGjuOo3EhwAJRPhJxwEJ5b+/Ouo+VqZdQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/jquery.tablesorter.pager.min.css" integrity="sha512-TWYBryfpFn3IugX13ZCIYHNK3/2sZk3dyXMKp3chZL+0wRuwFr1hDqZR9Qd5SONzn+Lja10hercP2Xjuzz5O3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
-->
<?php
  $user = new UserView();
  $data = $user->getAllUsersData();
?>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Hodnotenie</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row col-sm-12 col-md-12">
          <table class="table table-bordered dataTable tablesorter" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
              <tr role="row">
                <th class="sorting_asc text-center" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 40px;">ID</th>
                <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" aria-label="Meno: activate to sort column ascending" style="width: 300px;">Meno</th>
                <th class="text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="<?php echo TASKS;?>" style="width: 97px;">Úloha</th>
                <th class="sorting text-center" rowspan="2" style="width: 96px;">Skupina</th>
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
                foreach ($data as $id_user => $row) {
                  echo '
                  <tr role="row" class="odd">
                    <td class="sorting_1 text-center">'.$id_user.'</td>
                    <td>'.$row['fullname'].'</td>';
                      $p = 0;
                      for($i = 1;$i<=TASKS;$i++){
                        $p += $user->countFilesInTask($id_user, $i);
                        $check = ($user->countFilesInTask($id_user, $i)>0?True:False);
                        if ($check){
                          echo '<td class="text-center"><a href="dir.php?id_user='.$id_user.'&task='.$i.'"><i class="fa-solid fa-circle-check"></i></a></td>';
                        } else {
                          echo '<td class="text-center"></td>';
                        }
                      }
                    echo '<td class="text-center">'.$row['type'].'</td>';
                    if ($p>0) {
                      echo '<td class="text-center"><a class="btn btn-primary" href="dir.php?id_user='.$id_user.'&task=all">Stiahnuť</a></td>';
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
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/pager.js"></script>
