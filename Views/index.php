<?php include_once('header.php'); 
      include_once('nav.php');?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>PetHero!</h2>
          </header>

          <form action="<?php echo FRONT_ROOT."User/Login" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="mail" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
               </div>
               <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
               </div>
               
               <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button> <br>
               <script>
                    var btn = document.getElementById('crtAcc');
                    btn.addEventListener('click', function() {
                         document.location.href = '<?php echo 'create-account.php'; ?>';
                    }); //A esto no lo puedo hacer andar, deberia redigir a crear cuenta pero ni idea, es javascript
               </script>
               <button class="btn btn-secondary btn-block btn-lg" id="crtAcc">No tienes una cuenta? Click para crear una</button><br>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>