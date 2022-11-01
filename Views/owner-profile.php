
<?php
    require_once(VIEWS_PATH."header.php");
    require_once(VIEWS_PATH."nav.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4"><?php $user = $_SESSION["loggedUser"] ; 
                echo "Owner: ". $user->getFirstName()."  ".$user->getLastName().":" ?> </h2>
                 <form action="<?php echo FRONT_ROOT."Home/CreatePets" ?>" method="POST" >
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
                         <?php use DAO\PetsDAO;
use Models\Pets;

                         $petsDAO=new PetsDAO();
                           $user = $_SESSION["loggedUser"] ;
                           
                         function getPetList($user){

                         }
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
                                        
                                        
                              </tr>
                         <?php }}?>
                    </tbody>
                    <button  type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar Mascota</button>
               </table>
               </form>
               <form action="<?php echo FRONT_ROOT."Pets/deletePets" ?>" method="POST" id="deletePet" class="login-form bg-dark-alpha p-5 bg-light">
                    <div class="form-group">
                         <label for="">Id Mascota a Borrar</label>
                         <input type="text" name="petsId" class="form-control form-control-lg" placeholder="Id Mascota">
                    </div>
                    <button  type="submit" name="" form="deletePet" class="btn btn-dark ml-auto d-block">Borrar Mascota</button>
               </form>
          </div>
     </section>
</main>
