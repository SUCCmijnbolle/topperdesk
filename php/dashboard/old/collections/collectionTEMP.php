<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Collection</title>
    <link rel="stylesheet" href="../../css/dashboard/yourcol.css">
    <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <nav>   
    <h1>Your Collection</h1>
    <div class="backbtnpad">
        <a href="../dashboard/dashcoll.php" class="backbtn">Back to your collections</a>
        </div>
    
    </nav>

    <main>
        <div class="container">
            <img class="myImages" id="myImg" src="../../img/RPSD_logopng.png" onclick="currentSlide(1)" alt="EEEEEEEEEEEEEEEEEEEEEEEEE" width="200">
            <img class="myImages" id="myImg" src="../../img/RPSD_icon.png" onclick="currentSlide(2)" alt="EEEEEEEEEEEEEEEEEEEEEEEEE" width="200">
            <img class="myImages" id="myImg" src="../../img/RPSD_logopng.png" onclick="currentSlide(3)" alt="EEEEEEEEEEEEEEEEEEEEEEEEE" width="200">
        </div>
        </main>
        <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
        </div>
        
    <footer>
        <h5 style="color: black; font-family: 'Noto Sans JP', sans-serif; position: absolute; bottom: 0px; ">Copyright © 2021-2022 Sociale Staats Eenheden Van Het Koninkrijk Der Nederlanden ™</h5>
        </footer>
        <script src="../../js/dashcoll.js"></script>
    </body>
</html>