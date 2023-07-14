<?php
  include "theme/page.php";
  $id_user = $_POST['id_user'];
  $restrictions = array(
    1 => 'e',
    2 => 'f',
    3 => 'c',
    4 => 'b'
  );
?>
<script type="text/javascript" src="theme/js/pcoz.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js" integrity="sha512-qzgd5cYSZcosqpzpn7zF2ZId8f/8CHmFKZ8j7mU4OUXTNRd5g+ZHBPsgKEwoqxCtdQvExE5LprwwPAgoicguNg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.widgets.min.js" integrity="sha512-dj/9K5GRIEZu+Igm9tC16XPOTz0RdPk9FGxfZxShWf65JJNU2TjbElGjuOo3EhwAJRPhJxwEJ5b+/Ouo+VqZdQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/jquery.tablesorter.pager.min.css" integrity="sha512-TWYBryfpFn3IugX13ZCIYHNK3/2sZk3dyXMKp3chZL+0wRuwFr1hDqZR9Qd5SONzn+Lja10hercP2Xjuzz5O3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
-->
<?php
  $user = new UserView();
  $data = $user->getData($id_user);
?>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Hodnotenie</h6>
  </div>
  <div class="card-body">
    <form method="post">
    <div class="table-responsive">
      <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row col-sm-12 col-md-12">

          <table class="table table-bordered dataTable tablesorter" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
              <tr role="row">
                <th class="sorting_asc text-center rotate-sm-l-90" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 20px;">Hodnotenie<br>podľa bodu</th>
                <th class="text-center" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="<?php echo TASKS;?>" style="width: 600px;">Úloha</th>
                <tr role="row">
                  <?php
                    for($i = 1;$i<=TASKS;$i++){
                      echo "<th class='text-center' tabindex='0' aria-controls='dataTable' rowspan='1' colspan='1' style='width: 100px;'>".$i."</th>";
                    }
                  ?>
                </tr>
              </tr>
            </thead>
            <tbody>
                <div class="form-group">
                <?php
                for($p = 'a'; $p<= 'f'; $p++){
                ?>
                  <tr role="row">
                    <td><?php echo "$p)"; ?></td>
                      <?php
                        for($i = 1;$i<=TASKS;$i++){
                          echo "<td>";
                          if($p <= $restrictions[$i]) {
                            echo "<input class='form-input text-center col-sm-12 col-md-12' type='number' id='$i-$p' onblur='sumary(".TASKS.")'>";
                          }
                          echo "</td>";
                        }
                      ?>
                  </tr>
                <?php } ?>
                <tr role="row">
                  <td>spolu</td>
                  <td class="text-center" id=""></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
            </tbody>
          </table>
          <button class="btn btn-primary">Uložiť</button>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>
