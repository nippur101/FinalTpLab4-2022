<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");
$user = $_SESSION["loggedUser"];

$todaysDate = date("Y") . "-" . date("m") . "-" . date("d");
$tomorrowDate = date("Y") . "-" . date("m") . "-" . date("d", strtotime("+1 day"));

?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php echo "Keeper: " . $user->getFirstName() . "  " . $user->getLastName() . ":" ?> </h2>

               <form action="<?php echo FRONT_ROOT . "Keeper/AddSecondInfo" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                    <div class="form-group">
                         <label for="">Direccion</label>
                         <input type="text" name="address" class="form-control form-control-lg" placeholder="<?php echo $keeper->getAddress(); ?>" required>

                    </div>
                    <div class="form-group">
                         <label for="">Tipo</label>
                         <select name="petSize" class="form-control">
                              <option value="0">Seleccione</option>
                              <option value="Pequenio">Pequeño</option>
                              <option value="Mediano">Mediano</option>
                              <option value="Grande">Grande</option>
                         </select>
                    </div>
                    <div class="form-group">
                         <label for="">Tarifa</label>
                         <input type="text" name="stayCost" class="form-control form-control-lg" placeholder="<?php echo $keeper->getStayCost(); ?>" required>

                    </div>
                    <button class="btn btn-primary btn-block btn-lg" type="submit">Aceptar</button> <br>
               </form>


               <form action="<?php echo FRONT_ROOT . "Keeper/TimePeriod" ?>" id="freeTime" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                    <div class="form-group">
                         <label for="">Periodo de Tiempo Desde</label>
                         <input type="date" name="startDate" value="<?php echo $todaysDate; ?>" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                         <label for="">Hasta</label>
                         <input type="date" name="finalDate" value="<?php echo $tomorrowDate; ?>" class="form-control form-control-lg">
                    </div>
                    <button class="btn btn-primary btn-block btn-lg" form="freeTime" type="submit">Agregar</button> <br>
                    </table>
               </form>
          </div>
     </section>
</main>