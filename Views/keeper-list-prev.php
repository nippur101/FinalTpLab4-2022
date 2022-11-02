<?php 
include_once('header.php');
include_once('nav.php'); 
$todaysDate = date("Y") . "-" . date("m") . "-" . date("d");
$tomorrowDate = date("Y") . "-" . date("m") . "-" . date("d", strtotime("+1 day"));
?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>Cuando necesitas un Keeper?</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "Keeper/ReturnKeepersInTime" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">Desde...</label>
                    <input type="date" name="startDate" value="<?php echo $todaysDate; ?>" class="form-control form-control-lg">
               </div>
               <div class="form-group">
                    <label for="">Hasta...</label>
                    <input type="date" name="finalDate" value="<?php echo $tomorrowDate; ?>" class="form-control form-control-lg">
               </div>
               <button class="btn btn-primary btn-block btn-lg" type="submit">Ok</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>