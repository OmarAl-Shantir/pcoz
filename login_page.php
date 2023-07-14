<?php
  if (!isset($_SESSION['page'])){
    header("Location: index.php");
    die();
  } else {
?>
<body id="page-top">
    <div class="parralax-image">
      <header class="masthead">
          <div class="container">
              <div class="masthead-heading text-uppercase">Praktický časť odbornej zložky maturitnej skúšky</div>
              <a class="btn btn-primary btn-xl text-uppercase" href="#login">Prihlásenie</a>
          </div>
      </header>
    </div>
    <section class="page-section" id="login">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Prihlásenie</h2>
            <h3 class="section-subheading text-muted">Pre zobrazenie podkladov a odovzdanie úloh je potrebné sa prihlásiť.</h3>
        </div>
        <div class="row text-center justify-content-md-center">
            <form method="post" class="col-lg-4 md-8">
              <div class="form-group mb-2">
                <label for="user">Prihlasovacie meno:</label>
                <input type="text" class="form-control" name="user" id="user">
              </div>
              <div class="form-group mb-2">
                <label for="pass">Heslo:</label>
                <input type="password" class="form-control" name="pass" id="pass">
              </div>
              <button type="submit" class="btn btn-primary">Prihlásiť</button>
            </form>
        </div>
    </div>
</section>
<?php } ?>
