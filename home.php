<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name = "viewport" content="width = device-width, initial-scale=1.0">
        <title>logoPhile</title>
        <link type = "text/css" rel = "stylesheet" href="css/nav.css">
        <link type = "text/css" rel = "stylesheet" href="css/home.css">
        
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        
    </head>
    <body>
                 
          <nav class="navbar">
              <span class="navbar-toggle" id="js-navbar-toggle">
                  <i class="fas fa-bars"></i>
              </span>
              <img class = "logo" src = ./img/dim.png height="100%" width="150"> 
              <ul class="main-nav" id="js-menu">
                <li>
                  <a href="#" class="nav-links">Home</a>
                </li>
                <li>
                  <a href="details.php" class="nav-links">Start Game</a>
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
                require "connection.php";                
                $query = "SELECT * FROM word ORDER BY RAND() LIMIT 1";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_fetch_array($result);
            ?>
            

          <div class = "word-of-the-day">
              <p style="padding-top: 1vh;font-weight: bold;text-align: center;font-size: 2em">Word of the day</p>
              <p style="padding-top:2vh;font-weight: bold;font-size: 1.2em"> <?php echo $rows['words']; ?> </p><br>
              <p style="padding-left : 1vw;font-size: 1 em;"><i>- <?php echo $rows['meanings']; ?></i></p><br><br>
          </div>

          <div class = "play-now-div">
            <p class  = "p1">A logophile loves, adores, and cherishes words.</p><br>
            <p class = "p2">Are you a logophile..?</p><br><br><br>
            <form>
              <button formaction = "details.php" class="button" style="vertical-align:middle" ><span>Play Now</span></button>
            </form>
          </div>

          <script src="js/nav.js"></script>
        
    </body>
</html>
 


