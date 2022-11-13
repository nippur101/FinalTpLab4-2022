<?php 
include_once('header.php');
include_once('nav.php'); 
$todaysDate = date("Y") . "-" . date("m") . "-" . date("d");
$tomorrowDate = date("Y") . "-" . date("m") . "-" . date("d", strtotime("+1 day"));
?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>Que mascota necesitas cuidar?</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "Keeper/KeeperList" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
               <select name="petId" required>
                    <option value="" disabled selected>Selecciona una mascota</option>
                    <?php foreach($petList as $pet){ ?>
                         <option value="<?php echo $pet->getPetId() ?>"><?php echo $pet->getName() ?></option>
                    <?php } ?>
               </select>
               </div>
               <button class="btn btn-primary btn-block btn-lg" type="submit">Ok</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>