<?php include_once('header.php'); 
      include_once('nav.php');?>

<main class="d-flex align-items-center justify-content-center height-100" >
     <div class="content">
          <header class="text-center">
               <h2>Escribir una review para <?php echo ($keeper->GetFirstName() . " " . $keeper->GetLastName()) ?></h2>
          </header>

          <form action="<?php echo FRONT_ROOT."Reviews/CreateNewReview" ?>" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
               <div>
                    <label for="">Calificacion</label>
                    <input type="number" name="score" value="" min="1" max="5" class="form-control form-control-lg" required>

                    <label for="">Comentario</label>
                    <textarea type="text" name="comment" value="" class="form-control form-control-lg" rows="4" cols="50" required></textarea>

                    <input type="hidden" name="reserveId" value="<?php echo $reserve->getReserveId(); ?>">
               </div><br>
          
               <button class="btn btn-primary btn-block btn-lg" type="submit">Vamos!</button>
          </form>
     </div>
</main>

<?php include_once('footer.php'); ?>