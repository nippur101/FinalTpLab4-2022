<?php include_once('header.php');
include_once('nav.php'); ?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>Ingrese su email para continuar:</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "User/PasswordRecoveryByEmail" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <input type="text" name="mail" class="form-control form-control-lg" placeholder="example@exmp.com" required>
               <button class="btn btn-primary btn-block btn-lg" type="submit">Recuperar</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>