<?php
session_start();

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



function beginDocument()
{
    echo "<!doctype html>
    <html class='entirepage'>";
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


function showHeader($page)
{
    echo '<h1 class="headers">' . $page . 'page</h1>';
}

function showMenu()
{
    echo '<nav>
          <ul class="menu">
              <li><a href="index.php?page=home">HOME</a></li>
              <li><a href="index.php?page=about">ABOUT</a></li>
              <li><a href="index.php?page=contact">CONTACT</a></li>';
    if (isset($_SESSION['name'])) {
        echo '<li><a href="index.php?page=logout">LOGOUT ' . $_SESSION['name'] . '</a></li>';
    } else {
        echo '<li><a href="index.php?page=register">REGISTER</a></li>
            <li><a href="index.php?page=login">LOGIN</a></li>';
    }
    echo '</ul>
        </nav>';
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
            break;
        case 'contact':
            require('contact.php');
            showContactContent();
            break;
        case 'register':
            require('register.php');
            showRegisterContent();
            break;
        case 'login':
            require('login.php');
            showLoginContent();
            break;
        case 'logout':
            require('logout.php');
            logout();
            break;

        default:
            showPageNotFound();
    }
}

function showFooter()
{
    echo '<footer class="footers">
    <p>&copy; 2023 Laura Bokkers</p>
    </footer>';
}


//============================================== 


function showPageNotFound()
{
    echo 'Page not found';
}
?>
