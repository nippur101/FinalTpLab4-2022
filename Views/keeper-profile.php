<?php
    require_once(VIEWS_PATH."header.php");
    require_once(VIEWS_PATH."nav.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php   $user = $_SESSION["loggedUser"] ; 
                echo "Keeper: ".$user->getFirstName()."  ".$user->getLastName().":" ?> </h2>
     
                 <form action="<?php echo FRONT_ROOT."User/Create" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                <div class="form-group">
                    <label for="">Tarifa</label>
                    <input type="text" name="tarifa" class="form-control form-control-lg" placeholder="Tarifa" required>
                    <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button> <br>
               </div>
               </form>
               <form action="<?php echo FRONT_ROOT."Keeper/TimePeriod" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">Periodo de Tiempo Desde</label>
                    <input type="date" name="startDate" class="form-control form-control-lg" >
               </div>
               <div class="form-group">
                    <label for="">Hasta</label>
                    <input type="date" name="finalDate" class="form-control form-control-lg" >
               </div>
               <button class="btn btn-primary btn-block btn-lg" type="submit">Agregar</button> <br>
               </table>
               </form>
          </div>
     </section>
</main>
