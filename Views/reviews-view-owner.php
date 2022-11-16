<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Reviews maded</h2>
               <form action="<?php echo FRONT_ROOT . "Reviews/ViewReviewsByOwner" ?>" method="POST">
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>ID</th>
                              <th>Description</th>
                              <th>Date</th>
                              <th>Score</th>
                              <th>Pet</th>
                              <th>Keeper</th>
                         </thead>
                         <tbody>
                              <?php
                              foreach ($reviews as $review) {
                              ?>
                                   <tr>
                                        <td><?php echo $review->getReviewsId(); ?></td>
                                        <td><?php echo $review->getDescription(); ?></td>
                                        <td><?php echo $review->getDate(); ?></td>
                                        <td><?php echo $review->getUserScore(); ?></td>
                                        <td><?php
                                             $pet = $pet_DAO->GetPet($review->getPets());
                                             echo $pet->getName();
                                             ?></td>
                                        <td><?php
                                             $keeper = $keeper_DAO->GetKeeper($review->getKeeper());
                                             echo $keeper->getFirstName() . " " . $keeper->getLastName();
                                        ?></td>
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