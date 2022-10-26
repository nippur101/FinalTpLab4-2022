<?php include_once('header.php'); 
      include_once('nav.php');?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>PetHero! - Ingresa Tu Mascota</h2>
          </header>

          <form action="<?php echo FRONT_ROOT."User/Create" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Nombre Mascota" required>
               </div>
               <div class="form-group">
                    <label for="">Plan de Vacunacion</label>
                    <input type="text" name="vaccinationPlan" class="form-control form-control-lg" placeholder="Plan de Vacunacion" required>
               </div>
                <div class="form-group">
                    <label for="">Raza</label>
                    <input type="text" name="raze" class="form-control form-control-lg" placeholder="Raza" required>
               </div>
               <div class="form-group">
                    <label for="">Tipo</label>
                    <select name="type" class="form-control">
                         <option value="0">Seleccione</option>
                         <option value="Pequenio">Pequeño</option>
                         <option value="Mediano">Mediano</option>
                         <option value="Grande">Grande</option>
                    </select>
                </div>
               <div class="form-group">
                    <label for="">Video</label>
                    <input type="text" name="video" class="form-control form-control-lg" placeholder="Ingresa tu Video" required>
               </div>
               
                <button class="btn btn-primary btn-block btn-lg" type="submit">Guardar Mascota</button> <br>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>