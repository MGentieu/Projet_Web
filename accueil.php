<?php

session_start();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Emploi</title>
    <link href="ecein.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
    var $carrousel = $('#carrousel'), 
        $img = $('#carrousel img'), 
        indexImg = $img.length - 1, 
        i = 0, 
        k = indexImg,
        j = i + 1,
        $currentImg = $img.eq(i),
        $prevImg = $img.eq(k),
        $nextImg = $img.eq(j);

    $img.css('display', 'none');
    //$prevImg.css('display', 'block');
    $currentImg.css('display', 'block');
    //$nextImg.css('display', 'block'); 
    
    $('#next').click(function(){ 
        i++; 
        j++;
        k++;
        if (i > indexImg) {
            i = 0;
        }
        if (k > indexImg) {
            k = 0;
        }
        if (j > indexImg) {
            j = 0;
        }
        
        $img.css('display', 'none'); 
        //$prevImg = $img.eq(k); 
        //$prevImg.css('display', 'block');
        $currentImg = $img.eq(i); 
        $currentImg.css('display', 'block');
        //$nextImg = $img.eq(j); 
        //$nextImg.css('display', 'block');
    });

    $('#prev').click(function(){ // image précédente
        i--;
        k--;
        j--;
        if (i < 0) {
            i = indexImg;
        }
        if (k < 0) {
            k = indexImg;
        }
        if (j < 0) {
            j = indexImg;
        }
        
        $img.css('display', 'none');
        //$prevImg = $img.eq(k); 
        //$prevImg.css('display', 'block');
        $currentImg = $img.eq(i); 
        $currentImg.css('display', 'block');
        //$nextImg = $img.eq(j); 
        //$nextImg.css('display', 'block');
    });

    function slideImg(){
        setTimeout(function(){ 
            i++; 
            j++;
            k++;
            if (i > indexImg) {
                i = 0;
            }
            if (k > indexImg) {
                k = 0;
            }
            if (j > indexImg) {
                j = 0;
            }
            $img.css('display', 'none');
            //$prevImg = $img.eq(k); 
            //$prevImg.css('display', 'block');
            $currentImg = $img.eq(i); 
            $currentImg.css('display', 'block');
            //$nextImg = $img.eq(j); 
            //$nextImg.css('display', 'block');
            slideImg(); 
        }, 1000); 
    } 

    slideImg();   
});

    </script>


</head>
<body>
    <div class="wrapper">


        <div class="gauche">
            <h1>ECE In: Social Media Professionel <br> 
                <br> de l'ECE Paris</h1>
        </div>

        <div class="droite">
        <div class="logoece"><img src="ecebaniere.jpg" alt="logo de ECE" width="200px" height="70px"></div>
        </div>
        
        
        
        <div _d="titre"></div>

        <div class="menu">
            
                
            
            <div id="logo">
                <a href="accueil.php" class="action-button animate red">Accueil</a>
                <a href="monreseau.php" class="action-button animate blue">Réseau</a>
                <a href="vous.php" class="action-button animate blue">Vous</a>
                <a href="notification.php" class="action-button animate blue">Notification</a>
                <a href="messagerie.php" class="action-button animate blue">Messagerie</a>
                <a href="emploi.php" class="action-button animate blue">Emploi</a>
            </div>

        </div>
        

        <div class="leftcolumn" id="carrousel">

            
                <ul>
                    <li><img src="france1.jpg" width="100" height="100" /></li>
                    <li><img src="france2.jpg" width="100" height="100" /></li>
                    <li><img src="france3.jpg" width="100" height="100" /></li>
                    <li><img src="france4.jpg" width="100" height="100" /></li>
                    <li><img src="france5.jpg" width="100" height="100" /></li>
                    <li><img src="france6.jpg" width="100" height="100" /></li>
                    <li><img src="france7.jpg" width="100" height="100" /></li>
                </ul>
                <input type="button" id="prev" value="Précédent" onclick="change_color1()">
                <input type="button" id="next" value="Suivant" onclick="change_color1()">
            
        </div>
        

        <div class="rightcolumn">
            <p>ECE In est une platforme de réseau social...
                <br>
            </p>
        </div>
        <div class="rightestcolumn">
            
            
        </div>

        <div id="footer">

            <div class="gauche">
            <h1>ECE In: Social Media Professionel <br> 
                <br> de l'ECE Paris</h1>
            </div>

        <div class="droite">
        <div class="logoece"><img src="ecebaniere.jpg" alt="logo de ECE" width="200px" height="70px"></div>
        </div>
            

            <footer>
             <strong> ECE In <br> 75015 Paris </strong>      
            </footer> 
        
        
        </div>
    </div>
    
<div class="fond-second-plan">

</div>


</body>
</html>