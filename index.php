
<?php
// Dit heb ik gekopieerd uit de opdracht://
//stap 1

// ===================================
// MAIN APP
// ===================================
$page = getRequestedPage();
showResponsePage($page);

// ===================================
// FUNCTIONS
// ===================================

function getRequestedPage()
{
    $requestType = $_SERVER['REQUEST_METHOD'];

    if ($requestType == "POST") {
        $requestedPage = getPostVar('page', 'home');
    } else {
        $requestedPage = getUrlVar('page', 'home');
    }
    return $requestedPage;
}

function showResponsePage($page)
{
    beginDocument();
    showHeadSection();
    showBodySection($page);
    endDocument();
};

// =========================================== 


function getPostVar($key, $default = "")
{
    return getArrayVar($_POST, $key, $default);
};

function getUrlVar($key, $default = '')
{
    return getArrayVar($_GET, $key, $default);
};

function getArrayVar($array, $key, $default = '')
{
    return isset($array[$key]) ? $array[$key] : $default;
}
// ===================================================


//============================================== 

function beginDocument()
{
    echo "<!doctype html>
    <html>";
}

function showHeadSection()
{
    echo '<head>
    <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>';
}

function showBodySection($page)
{
    echo '    <body>' . PHP_EOL;
    showHeader($page);
    showMenu();
    showContent($page);
    showFooter();
    echo '    </body>' . PHP_EOL;
}

function endDocument()
{
    echo  '</html>';
}

//============================================== 


//============================================== 

function showHeader($page)
{
    echo '<h1 class="headers">'. $page . 'page</h1>';
}

function showMenu()
{
    echo '<nav>
          <ul class="menu">
              <li><a href="index.php?page=home">HOME</a></li>
              <li><a href="index.php?page=about">ABOUT</a></li>
              <li><a href="index.php?page=contact">CONTACT</a></li>
          </ul>
        </nav>';

    // Dit is de NAVbar voor een GET request. 
    //Misschien moet ik nog een en ander aanpassen om dit ook werkend te krijgen voor POST requests. 
}

function showContent($page)
{
    switch ($page) {
        case 'home':
            require('home.php');
            showHomeContent();
            break;
        case 'about':
            require('about.php');
            showAboutContent();
        case 'contact':
            require('contact.php');    
            showContactContent();
        default:
        // Code voor : page NOT found (404?)
    }
}

function showFooter()
{
    echo '<footer class="footers">
    <p>&copy; 2023 Laura Bokkers</p>
    </footer>';
}

//============================================== 


//============================================== 

function showHomeContent()
{
}

function showAboutContent()
{
}

function showContactContent()
{
}

function showPageNotFound()
{
}

//============================================== 


// Dit is de nav-bar voor een GET request (met URLparameter):

// <nav>
//         <ul class="menu">
//             <li><a href="index.php?page=home">HOME</a></li>
//             <li><a href="index.php?page=about">ABOUT</a></li>
//             <li><a href="index.php?page=contact">CONTACT</a></li>
//         </ul>
//     </nav>


?>





