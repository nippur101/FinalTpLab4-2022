<?php include_once('header.php'); 
      include_once('nav.php');?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>Bienvenido Keeper <?php $firstName." ".$lastName ?> </h2>
          </header>

          <form action="<?php echo FRONT_ROOT."Home/Add" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <button class="btn btn-primary btn-block btn-lg" type="submit">Ok</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>