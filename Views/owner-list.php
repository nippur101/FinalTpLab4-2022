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
               <h2 class="mb-4"><?php $user = $_SESSION["loggedUser"];
                                   if ($user->getUserType() == 2) {
                                        echo "Owner: " . $user->getFirstName() . "  " . $user->getLastName() . ":";
                                   } else {
                                        echo "Keeper: " . $user->getFirstName() . "  " . $user->getLastName() . ":";
                                   } ?> </h2>
               <h2 class="mb-4"> LISTA DE OWNERS</h2>
               <form action="<?php echo FRONT_ROOT . "Owner/CheckAndPushData" ?>" method="POST">
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Email</th>
                              <th>Telefono</th>
                              <th>Mascota</th>

                         </thead>
                         <tbody>
                              <?php


                              foreach ($ownerDAO->getAll() as $owner) {
                              ?>
                                   <tr>
                                        <th><?php echo $owner->getUserID(); ?></th>
                                        <th><?php echo $owner->getFirstName(); ?></th>
                                        <th> <?php echo $owner->getLastName(); ?>"</th>
                                        <th><?php echo  $owner->getEmail(); ?>" </th>
                                        <th><?php echo $owner->getPhone(); ?></th>
                                        <th> <?php echo $owner->getPets(); ?>" </iframe></th>
                                        <th><?php foreach ($petsDAO->getAll() as $pets) {
                                                  if ($pets->getOwner() == $owner->getUserID()) {
                                                       echo $pets->getName() . ", ";
                                                  }
                                             } ?></th>


                                   </tr>
                              <?php } ?>
                         </tbody>
                         <button type="submit" name="" class="btn btn-dark ml-auto d-block">Perfil Usuario</button>
                    </table>
               </form>

          </div>
     </section>
</main>