<?php
  if(!(isset($_SESSION["loggedUser"]))){
    require_once(VIEWS_PATH."index.php");
  }
  
?>  