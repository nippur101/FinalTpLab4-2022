
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
                         <th>Foto</th>
                         <th>Raza</th>
                         <th>Video</th>
                         <th>Tipo</th>
                    </thead>
                    <tbody>                         
                         <?php // foreach($petList as $pets) {?>
                              <tr>
                                        <th><?php // echo $pets->getPetId();?>1</th>
                                        <th><?php //echo $pets->getName();?>Tito</th>
                                        <th><?php //echo $pets->getImage();?><img width="200" height="150" class="image-item" src="https://olondriz.com/wp-content/uploads/2020/04/ambar-perrito-1-1024x899.jpg" ></th>
                                        <th><?php //echo $pets->getRaze();?>perro</th>
                                        <th><?php //echo $pets->getVideo();?> <iframe width="200" height="150" src="https://www.youtube.com/embed/rsTLyukvxGU" title="CACHORROS TIERNOS Y BONITOS 🧡 ¡Vídeos de Perros Cachorros! Lunacreciente" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></th>
                                        <th><?php //echo $pets->getPetType();?>Mediano</th>
                                        
                                        
                              </tr>
                         <?php //}?>
                    </tbody>
                    <button  type="submit" name="" class="btn btn-dark ml-auto d-block">Agregar Mascota</button>
               </table>
               </form>
          </div>
     </section>
</main>
