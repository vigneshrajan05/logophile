<?php
  session_start();
  require 'connection.php';
  $seed = $_GET['seed'];
  $username = $_SESSION['user'];
  $category = $_SESSION['category'];
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel = "stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/game.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
      <nav class="navbar">
              <span class="navbar-toggle" id="js-navbar-toggle">
                  <i class="fas fa-bars"></i>
              </span>
              <!-- <a href="#" class="logo">
                
              </a> -->
              <img class = "logo" src = ./img/dim.png height="100%" width="150"> 
              <ul class="main-nav" id="js-menu">
                <li>
                  <a href="home.php" class="nav-links">Home</a>
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
      
   
    <div class = "pagination">
    <button type = "button" class = "hint-btn" id="btn" onclick = "hint()">Hint</button>
      <?php
           
          // define how many results you want per page
          $results_per_page = 1;

          // Since we fetch only 5 questions all the time
          $number_of_results = 5;   

          // determine number of total pages available
          $number_of_pages = ceil($number_of_results/$results_per_page);

          // determine which page number visitor is currently on
          if (!isset($_GET['page'])) {
            $page = 1;
          } 
          else {
            $page = $_GET['page'];
          }

          // determine the sql LIMIT starting number for the results on the displaying page
          $this_page_first_result = ($page-1)*$results_per_page;
          
          // retrieve selected results from database and display them on page
          $sql='SELECT * FROM word WHERE category = "'.$category.'" ORDER BY RAND('.$seed.') LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
          
          $result = mysqli_query($conn, $sql);
          
          while($row = mysqli_fetch_array($result)) {
            
            echo '<p style="color:white" class = "qn"><q>'.$row['meanings'].'</q></p>';
            $correctWord = $row['words'];     // correct ans for this page
            $currentHint = $row['hints'];
          }
          
          
          
          // display the links to the pages
          for ($page=1;$page <= $number_of_pages;$page++) {
            echo '<span class = "page" id='.$page.'><a href="game.php?page='. $page .'&seed='.$seed.'">' . $page . '</a></span>';
          } 
      ?>
      
      
  </div>

  <!-- This content is hidden and showed only when user completes the challenge -->
  <p id = "win-popup" title = "Logofied!!" style = "background: rgba(255, 219, 177, 0.418); font-family:system-ui;font-weight:600;">
       <i> Wohoooo!! Congrats <?php echo $username; ?>, you are a logophile </i>
  </p>

  <!-- content to be present in hint dialog box -->
  <p id = "hint-dialog" title = "Hint" style = "background: rgba(255, 219, 177, 0.418); font-family:system-ui;font-weight:600;">
    <?php 
      echo $currentHint.'<br>('.strlen($correctWord).' letter word)<br>(Starts with "'.$correctWord[0].$correctWord[1].'")'; ?>
  </p> 

  <div class="wrapper">
    <div class="phone">
      <div class="phone-container">
        <input type="text" maxlength="13" class="number-input" id="numberInput" value=""/>
        
        <div class="keyboard">
          <div class="number aling-right">
            <span><i class="delete"><img src="https://image.flaticon.com/icons/svg/61/61167.svg" width="30" height="30" alt="Left Arrow free icon" title="Left Arrow free icon"></i></span>
            
          </div>

          <div class="number">

          <?php
           
            $splitted_words = array();

            if(isset($_SESSION['category'])){
              $category = $_SESSION['category'];
             // echo '<span style="color:white;">'.$category.'</span>';
            }

            $sql = "SELECT * FROM word WHERE category = '".$category."' ORDER BY RAND(".$seed.") LIMIT 5";
            $result = mysqli_query($conn, $sql);
            
            while($row = mysqli_fetch_array($result)) {

              $str = $row["words"]; 
              if(strlen($str) == 4){
                $split = str_split($str,2);
              }
              else if(strlen($str) == 5){
                $split = str_split($str,3);
              }
              else if(strlen($str)==7 || strlen($str)==10 || strlen($str)==13){
                $split = str_split($str,4);
              }
              else{
                $len = (strlen($str))/3;
                $split = str_split($str,$len);
              }

              $arr_count = count($split);
              for($i = 0 ;$i < $arr_count;$i++){
                  array_push($splitted_words, $split[$i]);
              }
            }

            $shuffle_count = count($splitted_words);
            shuffle($splitted_words);     
            for($i = 0;$i < $shuffle_count;$i++){
             
              echo '<span id = '.$splitted_words[$i].'><span data-number='.$splitted_words[$i].'><i>'.$splitted_words[$i].'</i></span></span>';
              
            }

         ?>
            
          </div>
        </div>
      </div>
    </div>
    
  </div>  
</body>

</html>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
  <script  src="js/game.js">  </script>
  <script src="js/nav.js"></script>
  <script>
      $("#hint-dialog").hide();   // to hide the p tag. we only want it to be a pop up
      $("#win-popup").hide();     // show this only when the user wins

      function hint(){
        $(function(){
         $( "#hint-dialog" ).dialog({
           autoOpen: true,
            show: {
            effect: "bounce",
            duration: 1000
            },
            hide: {
              effect: "explode",
              duration: 1000
            }
         });
 
      $( "#btn" ).on( "click", function() {
          $( "#hint-dialog" ).dialog( "open" );
      });
    });
    }

    function winner(){
        $(function(){
         $( "#win-popup" ).dialog({
            autoOpen: true,
            width: 400,
            height: 150,
            modal:true,
            
            show: {
            effect: "bounce",
            duration: 1000
            },
            hide: {
              effect: "explode",
              duration: 1000
            },
            close: function(event, ui)  { 
                window.location.href = "home.php",
                $(".ui-widget-overlay").removeClass('modal-opened');
            }
         });
 
      $( "#btn" ).on( "click", function() {
          $( "#hint-dialog" ).dialog( "open" );
      });
    });
    }


    // assigning current page answers to a javascript var from php
    var currentPageAns = '<?php echo $correctWord; ?>';
    var arrAssigned = false;
    // executed only once, for the first time
    if(!sessionStorage.getItem('init')){
        //console.log('Else executed');
        sessionStorage.setItem('init', 'true');
        sessionStorage.setItem('score', '0');
    }
    else{
        //console.log("Else");
        if(sessionStorage.getItem('splitDeleteArray') && sessionStorage.getItem('answeredPages')){
          deleteArr = JSON.parse(sessionStorage.getItem('splitDeleteArray'));
          answeredPages = JSON.parse(sessionStorage.getItem('answeredPages'));
          console.log(deleteArr);
          console.log(answeredPages);
          arrAssigned = true;
        }
    }

    if(arrAssigned){
      
      for(var k = 0;k < deleteArr.length;k++){
          $('#'+ deleteArr[k]).hide(); 
      }

      for(var p = 0;p < answeredPages.length;p++){
          $("#"+answeredPages[p]).css("background-color","green");
      }
      
      //console.log("arrAssigned");
    }
    
    
    $("[data-number]").on('click',function(){
      answerbox = $(".number-input").val();
      if(currentPageAns == answerbox){
        
        //console.log(currentPageAns);  
        sessionStorage.setItem('score',parseInt(sessionStorage.getItem('score'))+1);
        var score = parseInt(sessionStorage.getItem('score'));
        if(score == 5)
          winner();
      }  
    });

  </script>
      
</body>
</html>
