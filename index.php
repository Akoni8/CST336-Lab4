<?php
    $backgroundImage = "./img/sea.jpg"; 
    function getTenRandomImages($imgURLs) {
        $imagesToDisplay = array_slice($imgURLs, 0, 10); 
        return $imagesToDisplay; 
    }
    
    if (isset($_GET['keyword'])) {
        include "./api/pixabayAPI.php";
        if($_GET['keyword'] == null && $_GET['category'] == null){
            echo "select keyword by typing or using drop down menu";
        }
        elseif($_GET['keyword'] == null)
        {
            $imgURLs = getImageURLs($_GET['category'],$_GET['radio']);
            $imgsToDisplay = getTenRandomImages($imgURLs); 
            $backgroundImage = $imgsToDisplay[array_rand($imgsToDisplay)]; 
        }
        else{
        $imgURLs = getImageURLs($_GET['keyword'],$_GET['radio']); 
        $imgsToDisplay = getTenRandomImages($imgURLs); 
        // set random background image 
        $backgroundImage = $imgsToDisplay[array_rand($imgsToDisplay)]; 
        }
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @import url("./css/styles.css"); 
        </style>
        <style>
            body {
                background-image: url("<?=$backgroundImage?>");
            }
        </style>
    </head>
    <body>
        
        <?php 
            if (!isset($imgsToDisplay)) {
                // show prompt to user to enter query
                echo "<h2> Enter query to see imagees from Pixabay</h2>"; 
                    
            } 
            else {
                // show carousel
                    echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">'; 
                    echo '<ol class="carousel-indicators"> '; 
                    for ($i = 0; $i < count($imgsToDisplay); $i++) {
                        echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"'; 
                        echo $i == 0 ? 'class="active"' : ''; 
                        echo '></li>'; 
                    } 
                    echo '</ol>'; 
                    
                    echo '<div class="carousel-inner" role="listbox">'; 
                    
                    for ($i = 0; $i < count($imgsToDisplay); $i++) {
                        echo '<div class="item '; 
                        echo $i == 0 ? 'active' : ''; 
                        echo '">'; 
                        echo '<img src="'.$imgsToDisplay[$i].'" alt="...">'; 
                        echo '</div>';     
                    } 
                
                    echo '</div>'; 
                ?>
                
                <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              
        </div>    
        <?php
            } // finishes the else 
        ?>
        
        <form>
 
            <input type="text" name="keyword" placeholder="Keyword">
            <input type="submit" value="Submit">
            
            <div>
                <select name="category" id="drop-down" style:"color: black; font-size:1.5em">
                    <option value>Select-One</option>
                    <option value="animal">Animal</option>
                    <option value="games">Games</option>
                    <option value="sports">Sports</option>
                    <option value="food">Food</option>
                    <option value="school">School</option>
                </select>
            </div>
            <div id="layoutDiv">
                <input type="radio" name="layout" value="horizontal" id="layout_h"/>
                <label for="layout_h">Horizontal</label>
                </br>
                <input type="radio" name="layout" value="vertical" id="layout_v"/>
                <label for="layout_v">Vertical</label>
            </div>
        </form>
        
        <?php
        $keyword = $_POST['keyword'];
        
        if(isset($_POST['submit'])){
 
            if(isset($_POST['radio']))
            {
                echo "You have selected :".$_POST['radio'];  //  Displaying Selected Value
            }
            $selected_val = $_POST['keyword'];  // Storing Selected Value In Variable
            echo "You have selected :" .$selected_val;  // Displaying Selected Val
        }
        ?>
        
        
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>