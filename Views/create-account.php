<?php include_once('header.php');
include_once('nav.php'); ?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>PetHero! - Crear cuenta</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "User/Create" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="firstName" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
               </div>
               <div class="form-group">
                    <label for="">Apellido</label>
                    <input type="text" name="lastName" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
               </div>
               <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="mail" class="form-control form-control-lg" placeholder="Ingresar usuario" required>
               </div>
               <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" name="password1" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
               </div>
               <div class="form-group">
                    <label for="">Repita contraseña</label>
                    <input type="password" name="password2" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
               </div>
               <div class="form-group">
                    <label for="">Tipo</label>
                    <select name="type" class="form-control">
                         <option value="0">Seleccione</option>
                         <option value="1">Keeper</option>
                         <option value="2">Owner</option>
                    </select>
               </div>
               <div class="form-group">
                    <label for="">Elija una pregunta de seguridad:</label>
                    <select name="securityQuestion" class="form-control">
                         <option value="Cuando es el nacimiento de su madre?">Cuando es el nacimiento de su madre?</option>
                         <option value="Cual es el nombre de su primer mascota?">Cual es el nombre de su primer mascota?</option>
                         <option value="Cual es la direccion de su primer casa?">Cual es la direccion de su primer casa?</option>
                         <option value="Cual es el nombre de su primer pareja?">Cual es el nombre de su primer pareja?</option>
                         <option value="A donde fue su primer viaje fuera del pais?">A donde fue su primer viaje fuera del pais?</option>
                         <option value="A que edad finalizo sus estudios?">A que edad finalizo sus estudios?</option>
                         <option value="Como se llamaba su maestra favorita de primaria?">Como se llamaba su maestra favorita de primaria?</option>
                    </select>

                    <label for="">Respuesta: (recuerde anotar en algun lado estos datos)</label>
                    <input type="text" name="securityAnswer" class="form-control form-control-lg" placeholder="Respuesta..." required>

                    <label for="">Ingrese un numero de seguridad: (recuerde anotar en algun lado estos datos)</label>
                    <input type="password" name="securityNumber" class="form-control form-control-lg" required>
               </div>
               <button class="btn btn-primary btn-block btn-lg" type="submit">Crear cuenta</button> <br>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>