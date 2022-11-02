<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Listado de keepers para cuidar a <?php echo $petToKeep->getName() . "(" . $petToKeep->getPetType() . ")"; ?> </h2>
               <form action="" method="POST">
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Email</th>
                              <th>Tamaño de Mascota</th>
                              <th>Costo de la estadia</th>
                              <th>Desde</th>
                              <th>Hasta</th>

                         </thead>
                         <tbody>
                              <?php if (empty($keepersInTime)) { ?>
                                   <tr>
                                        <td colspan="4">No hay Keepers disponibles en ese rango de fechas</td>
                                   </tr>
                              <?php } else { ?>
                                   <?php foreach ($keepersInTime as $keeper) { ?>
                                        <tr>
                                             <th><?php echo $keeper->getUserID(); ?></th>
                                             <th><?php echo $keeper->getFirstName(); ?></th>
                                             <th><?php echo $keeper->getLastName(); ?></th>
                                             <th><?php echo  $keeper->getEmail(); ?></th>
                                             <th><?php echo $keeper->getPetSize(); ?></th>
                                             <th> <?php echo $keeper->getStayCost(); ?></iframe></th>
                                             <?php $event = $eventOfKeepers[$keeper->getUserID()]; ?>
                                             <th><?php echo $event->getStartDate(); ?></th>
                                             <th><?php echo $event->getFinalDate(); ?></th>
                                        </tr>
                                   <?php } ?>
                         <?php } ?>
                         </tbody>
                    </table>
               </form>
               <form action="<?php echo FRONT_ROOT . "Keeper/HireKeeper" ?>" method="POST" class="mb-5">
                    <div class="container">
                         <h2 class="mb-4">Contratar keeper:</h2>
                         <label for="">Para <?php echo $petToKeep->getName(); ?> de id:</label>
                         <input type="text" name="petId" class="form-control form-control-lg" value="<?php echo $petToKeep->getPetId(); ?>">

                         <label for="">Id del Keeper?</label>
                         <input type="text" name="id" class="form-control form-control-lg" placeholder="Ingresar id" required>

                         <label for="">Desde...</label>
                         <input type="text" name="from" class="form-control form-control-lg" value="<?php echo $from ?>" required>

                         <label for="">Hasta...</label>
                         <input type="text" name="to" class="form-control form-control-lg" value="<?php echo $to ?>" required>
                    </div> <br>
                    <button class="btn btn-primary btn-block btn-lg" type="submit">Contratar!</button>
               </form>
          </div>
     </section>
</main>