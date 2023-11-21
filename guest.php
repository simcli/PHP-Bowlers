<!DOCTYPE html>
<html>

<head>

    <title>Guest login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    .header {
        background-color: #0074d9;
        color: #fff;
        padding: 20px;
    }

    .menu {
        background-color: #f0f0f0;
        padding: 20px;
        box-sizing: border-box;
        overflow: hidden;
    }

    .menu a {
        display: inline-block;
        margin: 0 10px;
        padding: 10px;
        text-decoration: none;
        color: #000;
    }

    .menu a:hover {
        background-color: #ddd;
    }

    .content {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        box-sizing: border-box;
    }

    .slideshow-container {
        position: relative;
        max-width: 100%;
        margin: 0 auto;
    }

    .slideshow-container img {
        width: 100%;
        display: none;
    }
    </style>
</head>

<body>
    <div class="header">
        <img src="logo.png" alt="Company Logo" width="500" />
    </div>
    <div class="menu">
        <a href="#">Teams</a>
        <a href="#">Players</a>
        <a href="#">Tournaments</a>
        <a href="#">Game Recaps</a>
    </div>
    <div class="content">
        <div class="slideshow-container">
            <img src="pins1.jpg" alt="Slideshow Image 1" style="display: block" />
            <img src="pins2.jpg" alt="Slideshow Image 2" />
            <img src="pins3.jpg" alt="Slideshow Image 3" />
            <!-- Add more images as needed -->
        </div>
    </div>
</body>

</html>