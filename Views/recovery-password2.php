<?php include_once('header.php');
include_once('nav.php'); ?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>Complete los campos:</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "User/CheckSecurityRecovery" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <label for="">Recuperando mail:</label>
               <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $user->getEmail(); ?>" required readonly>

               <label for=""><?php echo $userSecurityQuestion ?></label>
               <input type="text" name="userAnswerQuestion" class="form-control form-control-lg" placeholder="Respuesta..." required>

               <label for="">Ingrese su numero de seguridad:</label>
               <input type="text" name="userAnswerNumber" class="form-control form-control-lg" placeholder="Respuesta..." required>

               <label for="">Ingrese su nueva contrasena:</label>
               <input type="password" name="newPassword1" class="form-control form-control-lg" required>

               <label for="">Ingrese de nuevo su nueva contrasena:</label>
               <input type="password" name="newPassword2" class="form-control form-control-lg" required>

               <button class="btn btn-primary btn-block btn-lg" type="submit">Vamos!</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>