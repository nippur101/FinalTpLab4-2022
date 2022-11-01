<?php
    require_once(VIEWS_PATH."header.php");
    require_once(VIEWS_PATH."nav.php");
    use DAO\PetsDAO;
    use Models\Pets;

    $user = $_SESSION["loggedUser"];
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
<<<<<<< Updated upstream
               <h2 class="mb-4"><?php echo "Owner: ". $user->getFirstName()."  ".$user->getLastName().":" ?> </h2>
               <form action="<?php echo FRONT_ROOT."Home/CreatePets" ?>" method="POST" >
=======
               <h2 class="mb-4"><?php $user = $_SESSION["loggedUser"] ; 
                echo "Owner: ". $user->getFirstName()."  ".$user->getLastName().":" ?> </h2>
                 <form action="<?php echo FRONT_ROOT."Pets/CreatePets" ?>" method="POST" >
>>>>>>> Stashed changes
               <table class="table bg-light-alpha">
                    <thead>
                         <th>ID</th>
                         <th>Nombre</th>
                         <th>Plan de Vacunacion</th>
                         <th>Foto</th>
                         <th>Raza</th>
                         <th>Video</th>
                         <th>Tipo</th>
                         <th>Borrar</th>
                    </thead>
                    <tbody>                         
<<<<<<< Updated upstream
                         <?php 
                         $petsDAO=new PetsDAO();

=======
                         <?php use DAO\PetsDAO;
                                   use Models\Pets;

                         $petsDAO=new PetsDAO();
                           $user = $_SESSION["loggedUser"] ;
                        
>>>>>>> Stashed changes
                         foreach($petsDAO->getAll() as $pets) {
                              if($pets->getOwner()==$user->getUserID()){                              ?>
                              <tr>
                                        <th><?php  echo $pets->getPetId();?></th>
                                        <th><?php echo $pets->getName();?></th>
                                         <th> <img width="200" height="150" class="image-item" src= "<?php echo $pets->getVaccinationPlan();?>"></th>
                                        <th><img width="200" height="150" class="image-item" src="<?php echo  $pets->getImage();?>" ></th>
                                        <th><?php echo $pets->getRaze();?></th>
                                        <th> <iframe width="200" height="150" src="<?php echo $pets->getVideo();?>" ></iframe></th>
                                        <th><?php echo $pets->getPetType();?>Mediano</th>

                                        
                                        <th><input type="reset" value="borrar" name=<?php  echo $pets->getPetId();?> formaction="<?php echo FRONT_ROOT."Pets/deletePets" ?>">
                                   </th>
                                        
                                        
                              </tr>
                         <?php }}?>
                    </tbody>
                    <button  type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar Mascota</button>
               </table>
               </form>
          </div>
     </section>
</main>
