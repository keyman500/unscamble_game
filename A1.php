<html>
  <head> 
    <link rel="stylesheet" href="styles.css">
    <title>php word game</title>
  </head>
  <body>
<div class="contact-us">
  <form action="index.php" method="post">
   <?php  
        $words = loadwords();
   displaywords($words);
 ?>
    <input placeholder="answer 1" name="answer1"  required type="text" /><input name="answer2" placeholder="answer 2" type="text" /><input name="answer3" placeholder="answer 3" type="text" /><input name="answer4" placeholder="answer 4" type="text" /><input name="answer5" placeholder="answer 5" type="text" /><button name="submit" type="submit">Submit answers</button>
    <?php 
  if(isset($_POST['submit'])) { 
    $check= check_answers();
    process_answers($check);
        } 
    ?>
  </form>
</div>
  </body>
</html>
    <?php 
    //this php tag contains all the functions that was used too create this webapp.
  
    function scamble($word){
        $word2 = $word;
        $word2 = preg_replace('/\s+/', '',str_shuffle($word) );
        while($word2 ==$word){
        $word2 = preg_replace('/\s+/', '',str_shuffle($word) );
        }
       return $word2;
    }

    function displaywords($words){
        echo "<p>Try too unscamble the following words: <ol>";
        foreach($words as $x => $x_value) {
    
  echo  "<li>" .$x_value."</li>";
}
echo "</ol></p>";

    }

    function loadwords(){
  
    $myfile = fopen("words.txt", "r") or die("Unable to open file!");

    for($i=0;$i<5;$i++){

        $word = fgets($myfile);

        $words[$word] = scamble($word);

    }

    return $words;
    }

    function get_ans(){
      $words = loadwords();
       $ans = array();
       $i =0;
          foreach($words as $x => $x_value) {
    
         $ans[$i] = trim($x);

         $i++;
         
            }
    return $ans;

    }

    function check_answers(){
        $check = array();
        $ans = get_ans();

         if($_POST['answer1']==$ans[0])
            $check[0]= 1;
        else
           $check[0]= 0;
        if($_POST['answer2']==$ans[1])
            $check[1]= 1;
        else
           $check[1]= 0;
        if($_POST['answer3']==$ans[2])
            $check[2]= 1;
        else
           $check[2]= 0;
         if($_POST['answer4']==$ans[3])
            $check[3]= 1;
        else
           $check[3]= 0;
        if($_POST['answer5']==$ans[4])
            $check[4]= 1;
        else
           $check[4]= 0;

   return $check;
    }

  function count_correct($answers){
      $x=0;
    for($i=0;$i<5;$i++){
        if($answers[$i]==1){
            $x+=1;
        }
    }
    return $x;
  }

  function process_answer($answer){
      if($answer ==1){
          return "✔";
      }else{
          return "✘";
      }
  }

 function process_answers($answers){
     echo "<div id='asnwers'>";
  for($i=0;$i<5;$i++){
      
      echo "<br/> answer ".($i + 1)." ".process_answer($answers[$i]);
  }
  echo "<br/>you got ".count_correct($answers)." right.";
  echo "</div>";
 }

    ?> 
    <?php
/* 
this php tag is too site sourses

https://stackoverflow.com/questions/2109325/how-do-i-strip-all-spaces-out-of-a-string-in-php/2109339

https://www.php.net/manual/en/function.str-shuffle.php

https://www.php.net/manual/en/language.variables.external.php

css from:
https://codepen.io/rickyeckhardt/pen/poJwRRb
*/
?>