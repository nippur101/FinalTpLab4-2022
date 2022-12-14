
<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");

use DAO\PetsDAO;
use DAO\PetsPDO;

$petsDAO = new PetsPDO();
$user = $_SESSION["loggedUser"];
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php echo "Owner: " . $user->getFirstName() . "  " . $user->getLastName() . "." ?> </h2>
               <form action="<?php echo FRONT_ROOT . "Home/CreatePets" ?>" method="POST">
                    <table class="table bg-light-alpha">
                         <thead>
                              <th>ID</th>
                              <th>Nombre</th>
                              <th>Plan de Vacunacion</th>
                              <th>Foto</th>
                              <th>Raza</th>
                              <th>Video</th>
                              <th>Tipo</th>
                         </thead>
                         <tbody>
                              <?php


                              foreach ($petsDAO->getAll() as $pets) {
                                   if ($pets->getOwner() == $user->getUserID()) {                              ?>
                                        <tr>
                                             <th><?php echo $pets->getPetId(); ?></th>
                                             <th><?php echo $pets->getName(); ?></th>
                                             <th> <img width="200" height="150" class="image-item" src="<?php echo $pets->getVaccinationPlan(); ?>"></th>
                                             <th><img width="200" height="150" class="image-item" src="<?php echo  $pets->getImage(); ?>"></th>
                                             <th><?php echo $pets->getRaze(); ?></th>
                                             <th> <iframe width="200" height="150" src="<?php echo $pets->getVideo(); ?>"></iframe></th>
                                             <th><?php echo $pets->getPetType(); ?></th>


                                        </tr>
                              <?php }
                              } ?>
                         </tbody>
                         <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar Mascota</button>
                    </table>
               </form>
               <form action="<?php echo FRONT_ROOT . "Pets/deletePets" ?>" method="POST" id="deletePet" class="mb-5">
                    <div class="form-group">
                         <h3>Id Mascota a Borrar</h3>
                         <input type="text" name="petsId" class="form-control form-control-lg" placeholder="Id Mascota">
                    </div>
                    <button type="submit" name="" form="deletePet" class="btn btn-dark ml-auto d-block">Borrar Mascota</button>
               </form>
          </div>
     </section>
</main>