<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>LabIV - TPFinal</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          <?php if(isset($_SESSION["loggedUser"])) { ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Home/ShowProfile" ?>">Perfil</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Home/Logout" ?>">Cerrar Sesión</a>
               </li>
          <?php }else{
               ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Home/Index" ?>">Iniciar Sesión</a>
               </li>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Home/Create" ?>">Registrarse</a>
               </li>
               <?php
          } ?>
     </ul>
</nav>