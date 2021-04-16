var splits = [];
var deleteArr = [];
var tempArr = [];
var answeredPages = [];
var tempAns = [];
var answerbox = "";
var flag = true;


$(".number-input").keyup(function(e){
  if($(this).val().length >= 11)
       $(".call-button").addClass("show");  
  if(e.which == 8)
     $(".call-button").removeClass("show");
})

//called when key is pressed in textbox
$(".number-input").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
      if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
               return false;
      }
});


$("[data-number]").on('click',function(){
  if($(".number-input").val().length <= 13){
    answerbox = $(".number-input").val() + $(this).data("number");
    $(".number-input").val(answerbox);
    splits.push($(this).data("number"));
    var currentText = $(this).data("number");
    $('#'+currentText).hide();


    var len = answerbox.length;
    var i = 0;
    flag = true;
    for(i = 0;i < length;i++){
      if(answerbox[i] != currentPageAns[i]){
          flag = false;
          break;
      }
    }
    if(flag){
      tempArr.push(currentText);
      
    }
    if(answerbox == currentPageAns){
      for(var j = 0;j < tempArr.length;j++){
        deleteArr.push(tempArr[j])
        
      }
      //alert("Going good!!");
      console.log("right ans"); 
      var url_string = window.location.href;          // get current URL
      var url = new URL(url_string);
      var currentPageNum = url.searchParams.get("page");  // current page num from URL
      answeredPages.push(currentPageNum);

      // storing to session
      sessionStorage.setItem('answeredPages',JSON.stringify(answeredPages));
      sessionStorage.setItem('splitDeleteArray',JSON.stringify(deleteArr));
      
    }
      
    console.log(currentPageAns);  // can be accessed.
  }

  if($(".number-input").val().length == 11)
     $(".call-button").addClass("show");  
});

$(".delete").on('click',function(){
    // getting the last elem from array 
    var word = splits.pop();   
    // make deletion possible only when some input is present on text box 
    if($(".number-input").val()){    
      var lengthOfLastSplittedWord = word.length;   // len of last elem
      // slicing the answerbox string and erasing last word
      var answerbox = $(".number-input").val().slice(0,-lengthOfLastSplittedWord);  
      // since the word is removed from answerbox showing it in splitted words div
      $('#'+word).show();         
      $(".number-input").val("");
      $(".number-input").val(answerbox);
      // $(".call-button").removeClass("show");
    }
});

