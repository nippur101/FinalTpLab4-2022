</body>
<<<<<<< Updated upstream
<?php 
?>
=======
<?php use DAO\PetsDAO;
                                   use Models\Pets;

                         $petsDAO=new PetsDAO();
                           $user = $_SESSION["loggedUser"] ;
                        
                         foreach($petsDAO->getAll() as $pets) {
                              if($pets->getOwner()==$user->getUserID()){   
                                echo $pets->getName();
                            }
                        }

                              ?>
>>>>>>> Stashed changes
</html>
