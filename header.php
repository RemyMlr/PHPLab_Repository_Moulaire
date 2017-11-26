    <head>
        <meta charset="UTF-8"> 
        <link rel="stylesheet" href="style.css"/>
        <title>Rémy</title>
    </head>
    <body> 
    <header>
        <nav class="header_nav">
            <ul id="navigation">
            
                <li<?php if ($nav == 'index.php'){echo ' id="active"';} ?>><a href="index.php">  Home </a> </li>
                <li<?php if ($nav == 'mybooks.php'){echo ' id="active"';} ?>><a href="mybooks.php">  My Books  </a> </li>
                <li<?php if ($nav == 'browser.php'){echo ' id="active"';} ?>><a href="browser.php">  Books Browser  </a> </li>
                <li<?php if ($nav == 'aboutus.php'){echo ' id="active"';} ?>><a href="aboutus.php">  About Us  </a> </li>
                <li<?php if ($nav == 'contact.php'){echo ' id="active"';} ?>><a href="contact.php">  Contact  </a> </li>
                <li<?php if ($nav == 'login.php'){echo ' id="active"';} ?>><a href="login.php"> LogIn </a> </li>
                <li<?php if ($nav == 'gallery.php'){echo ' id="active"';} ?>><a href="gallery.php"> Upload a file </a> </li>
                <li<?php if ($nav == 'displaygallery.php'){echo ' id="active"';} ?>><a href="displaygallery.php"> Gallery </a> </li>
            </ul>
        </nav>

    </header>