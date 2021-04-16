<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width = device-width, initial-scale=1.0">
        <title>logoPhile</title>
        <link type = "text/css" rel = "stylesheet" href="css/nav.css">
        <link type = "text/css" rel = "stylesheet" href="css/details.css"> 
        
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        
    </head>
    <body>
                 
          <nav class="navbar">
              <span class="navbar-toggle" id="js-navbar-toggle">
                  <i class="fas fa-bars"></i>
              </span>
              <!-- <a href="#" class="logo">
                
              </a> -->
              <img class = "logo" src = "./img/dim.png" height="100%" width="150"> 
              <ul class="main-nav" id="js-menu">
                <li>
                  <a href="home.php" class="nav-links">Home</a>
                </li>
                <li>
                  <a href="#" class="nav-links">Start Game</a>
                </li>
                <!-- <li>
                  <a href="#" class="nav-links">Multi Player</a>
                </li> -->
                <li>
                  <a href="help.php" class="nav-links">Help</a>
                </li>
              </ul>
            </nav>

       
  <?php 
          // generating a random seed and using it for fetching values from DB
          $seed = rand(10,100);
         
  ?>


  <div class="input_container">
    <!-- <form method = "post" action = "game.php?seed=<?php echo $seed;?>"> -->
      <form method = "post">
      <div class="row">
        <div class="col-25">
          <label for="name">User name</label>
        </div>
        <div class="col-75">
          <input type="text" id="name" name="name" required>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="category">Difficulty</label>
        </div>
        <div class="col-75">
            <select id="category" name="category" required>
              <option value="" disabled selected>Choose Category</option>
              <option value="Easy">Easy</option>
              <option value="Medium">Medium</option>
              <option value="Hard">Hard</option>
            </select>
        </div>
      </div>
      <br>
      <div class="row">
        <input type="submit" value='Start Game' id='btn' name='submit'>
      </div>
    </form>
</div>

      <?php
          $bool = false;
          require "connection.php";
          if(isset($_POST['submit'])){

              $user = $_POST['name'];
              $category = $_POST['category'];  
              $_SESSION['user'] = $user;
              $_SESSION['category'] = $category;
              //echo "SESSION:".$_SESSION['category'];
              $bool = true;  
              header('location:game.php?page=1&seed='.$seed);

          }
         
      ?>
        <script src="js/nav.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

        </body>
    </html>