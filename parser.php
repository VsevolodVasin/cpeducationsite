<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP EDU</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <header>
        <div id="logo" onclick="topFunction()">
            <span onclick="window.location.href='index.php';">CP EDUCATION</span>
        </div>
       
        <div class="search">
            <form name="search" method="post" action="parser.php">
            <input type="text" name="query" placeholder="Поиск курса"></input>
            <button type="submit" ></button>
            </form>
        </div>
    </header>
    
    <main>
        <div class="zogolovoksearch">
            <span>Результаты поиска по запросу: 
            <?php 
            echo $_POST['query']; 
            ?>
            </span>
        </div>
        <div class="searchresult"> 


<?php


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://hackathon-api.kasict.ru/01/api/PostRequestSearch");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "Keyword=" . $_POST['query']);
           
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));


// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);

$manage = json_decode($server_output, true);
$result= $manage['searchResult'];

            foreach($result as $item) {
            
                echo '<div class="postsearched">';
                echo '<span>'.$item['Course_name'].'</span>';
                echo '<p>'.$item['Course_description'].'</p>';
                echo '<p>'.$item['Course_URL'].'</p>';
                echo'<p>'.$item['Course_education_time'].'</p>';
                echo '<p>'.$item['Course_place'.'</p>'];
                echo'<p>'. $item['Course_cos'].'</p>';
                                   
           
                 
                 
            
                 $competences= $item['requestCompetences'];
            
            
            
          

                 foreach($competences as $comp) {
                echo '<p>'.$comp['Competence_name'].'</p>';
                  
                 echo '<p>'.$comp['Competence_description'].'</p>';
                 
                 
            }
                echo ' </div>';
            
            }





?>
</div>
    </main>
  
  <script>
    window.onscroll = function()
    {scrollFunction()};
    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
       document.getElementById("logo").style.display = "block";
      }
      else {
        document.getElementById("logo").style.display = "block";
    }
}
 function topFunction() {
     document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
     
 }
  </script>

</body>
</html>