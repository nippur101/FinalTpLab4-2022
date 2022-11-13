<?php include_once('header.php');
include_once('nav.php'); ?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>Confirmar reserva</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "Reserve/GenerateReserve" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">El keeper: <?php echo $keeper->getFirstName() . " " . $keeper->getLastName(); ?> de id:</label>
                    <input type="text" name="keeperId" value="<?php echo $keeper->getUserId();?>" class="form-control form-control-lg">

                    <label for="">Estara disponible desde:</label>
                    <input type="date" name="keeperStartDate" value="<?php echo $event->getStartDate(); ?>" class="form-control form-control-lg">

                    <label for="">Hasta:</label>
                    <input type="date" name="keeperFinalDate" value="<?php echo $event->getFinalDate(); ?>" class="form-control form-control-lg">

                    <label for="">Tu lo necesitas desde:</label>
                    <input type="date" name="neededStartDate" value="<?php echo $needed->getStartDate(); ?>" class="form-control form-control-lg">

                    <label for="">Hasta:</label>
                    <input type="date" name="neededFinalDate" value="<?php echo $needed->getFinalDate(); ?>" class="form-control form-control-lg">

                    <label for="">Lo contratarias:</label>
                    <input type="text" name="keeperAvaiableDays" value="<?php echo $keeperInterval->format('%a') . " dias"; ?>" class="form-control form-control-lg">

                    <label for="">Y tu necesitas:</label>
                    <input type="text" name="neededAvaiableDays" value="<?php echo $requestedInterval->format('%a') . " dias"; ?>" class="form-control form-control-lg">

                    <label for="">Con cada dia a un costo de:</label>
                    <input type="text" name="keeperStayCost" value="<?php echo $keeper->getStayCost(); ?>" class="form-control form-control-lg">

                    <label for="">Resultando en un total de:</label>
                    <input type="text" name="totalStayCost" value="<?php echo ($keeperInterval->format('%a') * $keeper->getStayCost()) ?>" class="form-control form-control-lg">
               
                    <label for="">La reserva es para <?php echo $petToKeep->getName() ?> de id:</label>
                    <input type="text" name="petId" value="<?php echo $petToKeep->getPetId(); ?>" class="form-control form-control-lg">
               </div>
               <div class="form-group">
                    <h3>¿Desea confirmar la reserva?</h3>
               </div>
               <button class="btn btn-primary btn-block btn-lg" type="submit">Confirmar reserva</button>
          </form>
          <form action="<?php echo FRONT_ROOT . "Keeper/ReturnKeepersInTime" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">Desde...</label>
                    <input type="date" name="startDate" value="<?php echo $needed->getStartDate(); ?>" class="form-control form-control-lg">

                    <label for="">Hasta...</label>
                    <input type="date" name="finalDate" value="<?php echo $needed->getFinalDate(); ?>" class="form-control form-control-lg">
               </div>
               <button class="btn btn-secondary btn-block btn-lg" type="submit">Volver a consultar en ese periodo</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>