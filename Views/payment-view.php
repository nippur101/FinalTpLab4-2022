<?php include_once('header.php');
include_once('nav.php'); ?>

<main class="d-flex align-items-center justify-content-center height-100">
     <div class="content">
          <header class="text-center">
               <h2>Confirmar reserva</h2>
          </header>

          <form action="<?php echo FRONT_ROOT . "Reserve/FinishPayment" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div class="form-group">
                    <label for="">El keeper: <?php echo $keeper->getFirstName() . " " . $keeper->getLastName();?> </label>
                    <label for="">Sera contratado desde: <?php echo $event->getStartDate(); ?></label>
                    <label for="">Hasta: <?php echo $event->getFinalDate(); ?></label>
                    <label for="">Con cada dia a un costo de: <?php echo $keeper->getStayCost(); ?></label>
                    <label for="">Resultando en un total de: <?php echo ($keeperInterval->format('%a') * $keeper->getStayCost()) ?></label>
                    <label for="">La reserva es para <?php echo $petToKeep->getName() ?> de id: <?php echo $petToKeep->getPetId(); ?></label>
               </div>
               <div class="form-group">
                    <label for="">Codigo de reserva:</label>
                    <input type="text" name="reserveId" value=<?php echo $event->getReserveID();?> class="form-control form-control-lg" required>

                    <label for="">Numero de tarjeta:</label>
                    <input type="text" name="cardNumber" class="form-control form-control-lg" required>

                    <label for="">Fecha de vencimiento:</label>
                    <input type="month" name="cardDate" class="form-control form-control-lg" required>

                    <label for="">Codigo de seguridad:</label>
                    <input type="text" name="cardSegurity" class="form-control form-control-lg" required>
               </div>
               <div class="form-group">
                    <h3>¿Desea realizar el pago?</h3>
               </div>
               <button class="btn btn-primary btn-block btn-lg" type="submit">Pagar</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>