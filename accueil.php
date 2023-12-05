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
        
        $(document).ready(function(){ 
            var $carrousel = $('#carrousel'),
                $img = $('#carrousel img'),
                indexImg = $img.length - 1,
                i = 0,
                $currentImg = $img.eq(i);

            $img.css('display', 'none');
            $currentImg.css('display', 'block');

            $carrousel.append('<div class="controls"> <span class="prev">Precedent</span><span class="next">Suivant</span></div>');

            
            $('.next').click(function(){
                i++;
                $img.css('display', 'none');
                $currentImg = $img.eq(i);
                $currentImg.css('display', 'block');
            });

            
            $('.prev').click(function(){
                i--;
                $img.css('display', 'none');
                $currentImg = $img.eq(i);
                $currentImg.css('display', 'block');
            });

            
            $('.next, .prev').click(function(){
                if (i > indexImg) {
                    i = indexImg;
                }
                if (i < 0) {
                    i = 0;
                }
            });


            
            function slideImg(){
                setTimeout(function(){
                    if (i < indexImg){
                        i++;
                    } else {
                        i = 0;
                    }
                    $img.css('display', 'none');
                    $currentImg = $img.eq(i);
                    $currentImg.css('display', 'block');
                    slideImg();
                }, 4000);
            }

            
            slideImg(); 
        });
    </script>


</head>
<body>
    <div class="wrapper">
        

        <div class="menu">

            <div id="logo">
        <a href="#" class="action-button animate blue">Accueil</a>
        <a href="#" class="action-button animate blue">Réseau</a>
        <a href="#" class="action-button animate blue">Vous</a>
        <a href="#" class="action-button animate blue">Notifs</a>
        <a href="#" class="action-button animate blue">Messagerie</a>
        <a href="#" class="action-button animate blue">Emploi</a>
    
            </div>

        </div>
        

        <div class="leftcolumn">

            <div id="carrousel">
        
            <li><img src="rafale1.jpg" width="100" height="100" /></li>
            <li><img src="rafale2.jpg" width="100" height="100" /></li>
            <li><img src="rafale3.jpg" width="100" height="100" /></li>
            <li><img src="rafale4.jpg" width="100" height="100" /></li>
            <li><img src="rafale5.jpg" width="100" height="100" /></li>
            <li><img src="rafale6.jpg" width="100" height="100" /></li>
            <li><img src="rafale7.jpg" width="100" height="100" /></li>
        
        </div>
        

        <div class="rightcolumn">
            <p>ECE In est une platforme de réseau social...
                <br>
            </p>
        </div>

        <div id="footer">
            <footer>
             <strong> ECE In <br> 75015 Paris </strong>      
            </footer> 
        
        
        </div>
    </div>
    </div>
<div class="fond-second-plan">
    <h1 class="logo"> <img src="ecebaniere.jpg" alt="logo de ECE"></h1>
</div>


</body>
</html>