<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");

use DAO\OwnerDAO;
use DAO\PetsDAO;

$user = $_SESSION["loggedUser"];
$ownerDAO = new OwnerDAO();
$petsDAO = new PetsDAO();
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"> Reservas</h2>
               <form action="<?php echo FRONT_ROOT . "Reserve/RetrievePendingReserves" ?>" method="POST">
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>ID</th>
                              <th>From</th>
                              <th>To</th>
                              <th>Pet Name</th>
                              <th>Pet Size</th>
                              <th>Total Payment</th>
                              <th>Approved</th>
                              <th>Paid out</th>
                         </thead>
                         <tbody>
                              <?php
                              foreach ($reserves as $reserve) {
                              ?>
                                   <tr>
                                        <td><?php echo $reserve->getReserveID(); ?></td>
                                        <td><?php echo $reserve->getStartDate(); ?></td>
                                        <td><?php echo $reserve->getFinalDate(); ?></td>
                                        <td><?php echo $reserve->getPets()->getName(); ?></td>
                                        <td><?php echo $reserve->getPets()->getSize(); ?></td>
                                        <td><?php echo $reserve->getTotalCost(); ?></td>
                                        <td><?php echo $reserve->getKeeperReviewStatus(); ?></td>
                                        <td><?php echo $reserve->getPaymentReviewStatus(); ?></td>
                                   </tr>
                              <?php
                              }
                              ?>
                         </tbody>
                         <button type="submit" name="" class="btn btn-dark ml-auto d-block">Refresh</button>
                    </table>
               </form>
               <form action="<?php echo FRONT_ROOT . "Reserve/ConfirmReserve" ?>" method="POST">
                    <div>
                         <label for="">Reserve ID</label>
                         <input type="text" name="reserveId" value="">
                         <button type="submit" name="" class="btn btn-green ml-auto d-block">Confirm</button>
                    </div>
               </form>
               <form action="<?php echo FRONT_ROOT . "Reserve/RefuseReserve" ?>" method="POST">
                    <div>
                         <label for="">Reserve ID</label>
                         <input type="text" name="reserveId" value="">
                         <button type="submit" name="" class="btn btn-red ml-auto d-block">Refuse</button>
                    </div>
               </form>
          </div>
     </section>
</main>