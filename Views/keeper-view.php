<?php include_once('header.php'); 
      include_once('nav.php');
      include 'Models\calendar.php';?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>Mi cuenta</h2>
          </header>
          <?php //EN CONSTRUCCION !!!!!!!!!!!!! ?>
          <form action="<?php echo FRONT_ROOT."Keeper/Update" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                <div class="form-group">
                    <label for="">Direccion</label>
                    <input type="text" name="adress" class="form-control form-control-lg" placeholder="<?php echo $keeper->getAddress(); ?>" required>
               </div>
                <div class="form-group">
                    <label for="">Costo de hospedaje</label>
                    <input type="text" name="stayCost" class="form-control form-control-lg" placeholder="<?php echo $keeper->getStayCost(); ?>" required>
               </div>
               <div class="form-group">
                    <label for="petS">Tamanio del perro a cuidar</label>
                    <select name="petSize" id="petS">
                         <option value="grande">Grande</option>
                         <option value="chico">Chico</option>
                         <option value="mediano">Mediano</option>
                    </select>
               </div>
               <div class="form-group">
                    <label for="petS">Ingresar nuevo periodo:</label> <br>
                    <input type="date" id="start" name="dateStart" value="2022-10-01" min="2020-01-01" max="2030-12-31">
                    <input type="date" id="end" name="dateEnd" value="2022-10-02" min="2020-01-01" max="2030-12-31">
               </div>

               <button class="btn btn-primary btn-block btn-lg" type="submit">Actualizar datos</button> <br>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>