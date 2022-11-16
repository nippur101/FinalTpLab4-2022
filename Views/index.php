<?php
include_once('header.php');
include_once('nav.php'); ?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>PetHero!</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "User/Login" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="mail" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
               </div>
               <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                    <a href="../User/RecoveryPassword">No recuerdo mi contraseña...</a>
               </div>

               <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button> <br>

          </form>
          <form action="<?php echo FRONT_ROOT . "User/CreateAccount" ?>" method="" class="login-form bg-dark-alpha p-5 bg-light">

               <button class="btn btn-secondary btn-block btn-lg" id="crtAcc">No tienes una cuenta? Click para crear una</button><br>

          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>