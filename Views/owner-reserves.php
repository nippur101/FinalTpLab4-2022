<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"> Reservas</h2>
               <form action="<?php echo FRONT_ROOT . "Reserve/RetrieveMadedReserves" ?>" method="POST">
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>ID</th>
                              <th>From</th>
                              <th>To</th>
                              <th>Pet Name</th>
                              <th>Pet Size</th>
                              <th>Total Payment</th>
                              <th>Status</th>
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
                                        <td><?php
                                             $pet = $pet_DAO->GetPet($reserve->getPets());
                                             echo $pet->getName();
                                             ?></td>
                                        <td><?php echo $pet->getPetType(); ?></td>
                                        <td><?php echo $reserve->getTotalCost(); ?></td>
                                        <td><?php
                                             switch ($reserve->getKeeperReviewStatus()) {
                                                  case 0:
                                                       echo "Unseen";
                                                       break;
                                                  case 1:
                                                       echo "Approved";
                                                       break;
                                                  case 2:
                                                       echo "Rejected";
                                                       break;
                                             }
                                             ?></td>
                                        <td><?php
                                             switch ($reserve->getPaymentReviewStatus()) {
                                                  case 0:
                                                       echo "No";
                                                       break;
                                                  case 1:
                                                       echo "Yes";
                                                       break;
                                             }
                                             ?></td>
                                        <td><a href="../Reserve/DeleteReserve?reserveId=<?php echo $reserve->getReserveId(); ?>">Cancel</a></td>
                                        <td><a href="../Reserve/PaidOut?reserveId=<?php echo $reserve->getReserveId(); ?>">Go pay</a></td>
                                        <td><a href="../Reviews/GenerateReview?reserveId=<?php echo $reserve->getReserveId(); ?>">Review it</a></td>
                                   </tr>
                              <?php
                              }
                              ?>
                         </tbody>
                         <button type="submit" name="" class="btn btn-dark ml-auto d-block">Refresh</button>
                    </table>
               </form>
          </div>
     </section>
</main>