<?php
require_once(VIEWS_PATH . "header.php");
require_once(VIEWS_PATH . "nav.php");

?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php echo "Owner: " . $owner->getFirstName() . "  " . $owner->getLastName() . "." ?> </h2>
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

                              if($petsDAO->getAll()!=null){
                              foreach ($petsDAO->getAll() as $pets) {
                                  
                                   if ($pets->getOwner() == $owner->getUserID()) {                              ?>
                                        <tr>
                                             <th><?php echo $pets->getPetId(); ?></th>
                                             <th><?php echo $pets->getName(); ?></th>
                                             <th> <img width="200" height="150" class="image-item" src="<?php echo $pets->getVaccinationPlan(); ?>"></th>
                                             <th><img width="200" height="150" class="image-item" src="<?php echo  $pets->getImage(); ?>"></th>
                                             <th><?php echo $pets->getRaze(); ?></th>
                                             <th> <iframe width="200" height="150" src="<?php echo $pets->getVideo(); ?>"></iframe></th>
                                             <th><?php echo $pets->getPetType(); ?></th>
                                             <th><a href="../Pets/deletePets?petsId=<?php echo $pets->getPetId(); ?>">Delete</a></th>
                                        </tr>
                              <?php }}} 
                              ?>
                         </tbody>
                         <button type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar Mascota</button>
                    </table>
               </form>
          </div>
     </section>
</main>