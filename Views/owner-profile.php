<?php include_once('header.php'); 
      include_once('nav.php');?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>Mi cuenta</h2>
          </header>

          <form action="<?php echo FRONT_ROOT."Owner/Update" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="firstName" class="form-control form-control-lg" placeholder=<?php $owner->getFirstName() ?> required>
               </div>
               <div class="form-group">
                    <label for="">Apellido</label>
                    <input type="text" name="lastName" class="form-control form-control-lg" placeholder=<?php $owner->getLastName() ?> required>
               </div>
                <div class="form-group">
                    <label for="">Telefono</label>
                    <input type="text" name="phone" class="form-control form-control-lg" placeholder=<?php $owner->getPhone() ?> required>
               </div>
               <div class="form-group">
                    <label for="">Mascotas</label>
                    <select name="pets" class="form-control">
                         <?php foreach($owner->getPets() as $pet){ ?>
                              <option value="<?php echo $pet->getType() ?>"><?php echo $pet->getType() ?></option>
                         <?php } ?>
                    </select>
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Actualizar datos</button> <br>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>