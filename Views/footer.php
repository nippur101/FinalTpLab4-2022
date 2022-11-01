</body>
<?php 

 $user = $_SESSION["loggedUser"] ; 
 foreach($user->getFreeTimePeriod() as $time){
 
echo $time->getStartDate()."   |   ".$time->getFinalDate()."<br>";
 }
?>
</html>
