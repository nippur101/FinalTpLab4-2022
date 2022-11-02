<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");

use DAO\KeeperDAO;

$user = $_SESSION["loggedUser"];
$keeperDAO = new KeeperDAO();
?>

<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php $user = $_SESSION["loggedUser"];
                                   if ($user->getUserType() == 2) {
                                        echo "Owner: " . $user->getFirstName() . "  " . $user->getLastName() . ":";
                                   } else {
                                        echo "Keeper: " . $user->getFirstName() . "  " . $user->getLastName() . ":";
                                   } ?> </h2>
               <h2 class="mb-4"> LISTA DE KEEPERS</h2>
               <form action="<?php echo FRONT_ROOT . "Keeper/CheckAndPushData" ?>" method="POST">
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Email</th>
                              <th>Tamaño de Mascota</th>
                              <th>Costo de la estadia</th>
                              <th>Reseñas</th>

                         </thead>
                         <tbody>
                              <?php

                              foreach ($keeperDAO->getAll() as $keeper) {
                              ?>
                                   <tr>
                                        <th><?php echo $keeper->getUserID(); ?></th>
                                        <th><?php echo $keeper->getFirstName(); ?></th>
                                        <th> <?php echo $keeper->getLastName(); ?>"</th>
                                        <th><?php echo  $keeper->getEmail(); ?>" </th>
                                        <th><?php echo $keeper->getPetSize(); ?></th>
                                        <th> <?php echo $keeper->getStayCost(); ?>" </iframe></th>
                                        <th><?php echo $keeper->getReviews(); ?></th>


                                   </tr>
                              <?php } ?>
                         </tbody>
                         <button type="submit" name="" class="btn btn-dark ml-auto d-block">Perfil Usuario</button>
                    </table>
               </form>

          </div>
     </section>
</main>