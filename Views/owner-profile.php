<?php
    require_once(VIEWS_PATH."header.php");
    require_once(VIEWS_PATH."nav.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php $user = $_SESSION["loggedUser"] ; 
                echo $user->getFirstName()."  ".$user->getLastName().":" ?> </h2>
                 <form action="<?php echo FRONT_ROOT."Home/CreatePets" ?>" method="POST" >
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ID</th>
                         <th>Nombre</th>
                         <th>Raza</th>
                         <th>Video</th>
                         <th>Tipo</th>
                    </thead>
                    <tbody>                         
                         <?php foreach($petList as $pets) {?>
                              <tr>
                                        <th><?php echo $pets->getPetId();?></th>
                                        <th><?php echo $pets->getName();?></th>
                                        <th><?php echo $pets->getRaze();?></th>
                                        <th><?php echo $pets->getVideo();?></th>
                                        <th><?php echo $pets->getPetType();?></th>
                                        
                                        
                              </tr>
                         <?php }?>
                    </tbody>
                    <button  type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar Mascota</button>
               </table>
               </form>
          </div>
     </section>
</main>
