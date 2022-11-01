<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
     <span class="navbar-text">
          <strong>LabIV - TPFinal</strong>
     </span>
     <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          <?php if(isset($_SESSION["loggedUser"])) { 
               if($_SESSION["typeUser"] == 1){?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT."Keeper/CheckAndPushData" ?>">Perfil</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT."Keeper/ShowCalendarView" ?>">Calendario</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Home/OwnerList" ?>">Listar Owners</a>
               </li>
               <?php }elseif($_SESSION["typeUser"] == 2){ ?>
                    <li class="nav-item">
                         <a class="nav-link" href="<?php echo FRONT_ROOT."Home/KeeperList" ?>">Listar Keepers</a>
                    </li>
               <?php } ?>
               <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT."Owner/CheckAndPushData" ?>">Perfil</a>
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