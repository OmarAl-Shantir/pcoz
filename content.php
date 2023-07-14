<?php
  if (!isset($_SESSION['page'])){
    header("Location: index.php");
    die();
  } else {
    $user = new UserView();
    $userC = new UserController();
    $data = $user->getData($_SESSION['user']);
    $tasks = 4;
    for ($t=1;$t<=$tasks;$t++){
      $uploaddir = 'users_submissions/'.$data['directory']."/".$t."/";
      if (!is_dir($uploaddir) && !mkdir($uploaddir,0755, true)){
        die("Error creating folder $uploaddir");
      }
      if(isset($_POST["odovzdat".$t])){
        $countfiles = count($_FILES['task'.$t]['name']);
        for($i=0;$i<$countfiles;$i++){
          $filename = $_FILES['task'.$t]['name'][$i];
          $userC->uploadSubmission($_SESSION['user'],$filename,$t);
          move_uploaded_file($_FILES['task'.$t]['tmp_name'][$i],$uploaddir.$filename);
        }
      }
    }
?>
<body id="page-top">
    <div class="parralax-image"><div class="parralax-image">
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
          <div class="container">
              <a class="navbar-brand" href="#page-top"><img src="theme/pcoz/assets/img/logo.png" alt="..." /></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  Menu
                  <i class="fas fa-bars ms-1"></i>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link btn-xl" href="#submission">Odovzdať</a></li>
                    <li class="nav-item">
                      <form method="post">
                          <button name="logOut" class="btn btn-primary btn-xl text-uppercase" type="submit">Odhlásiť</button>
                      </form>
                    </li>
                  </ul>

              </div>
          </div>
      </nav>
      <header class="masthead">
          <div class="container">
              <div class="masthead-heading text-uppercase">Praktická časť odbornej zložky maturitnej skúšky</div>
              <h2 class="section-subheading">Ste prihlásený ako <?echo $data['fullname'];?></h2>
          </div>
      </header>
    </div>
    <section class="page-section" id="submission">
      <div class="container">
        <div class="text-center">
          <h2 class="section-heading text-uppercase">Odovzdanie, skupina: <?php echo $data['type'];?></h2>
          <h4>Každú úlohu nahrávajte samostatne. Ku každej úlohe môžete nahrať viac súborov.
          Po odovzdaní úlohy už súbory nie je možné meniť, ani nahrať nové riešenie.
          Ak potrebujete nahrať celú zložku, pred nahratím ju skomprimujte do archívu .zip alebo .rar.</hS4>
        </div>

      <?php
        for ($i = 1; $i<=$tasks; $i++){
          if ($user->countSubmissionByTask($_SESSION['user'],$i) ==  0){
          ?>
            <h2 class="section-subheading">Úloha č.<?echo $i;?></h2>
            <form name="submission<?php echo $i;?>" method="post" class="submission col-md-12 d-flex justify-content-center mb-5" enctype="multipart/form-data">
              <div class="input-group">
                <div class="input-group">
                  <label class="input-group-btn">
                      <span class="btn btn-primary btn-xl">
                          Nahrať súbory <input type="file" name="task<?php echo $i;?>[]" id="task<?php echo $i;?>" style="display: none;" multiple>
                      </span>
                  </label>
                  <input type="text" class="form-control" id="texttask<?php echo $i;?>" readonly>
                </div>
              </div>
              <input name="odovzdat<?php echo $i;?>" class="btn btn-primary btn-xl text-uppercase" type="submit" value="Odovzdať">
            </form>
          <?php
          } else {
            ?>
            <h2 class="section-subheading">Úloha č.<?echo $i;?> <i class="fa-solid fa-circle-check"></i></h2>
            <div class="submission col-md-12 d-flex justify-content-center mb-5 text-center">
                  <h3>Zadanie bolo odovzdané.</h3>
            </div>
            <?
          }
        }
      ?>
      </div>
<?php } ?>
