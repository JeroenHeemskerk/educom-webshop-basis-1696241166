<?php
include('session-manager.php');
session_start();


// ===================================
// MAIN APP
// ===================================
$pageTitle = getRequestedPage();
// Voer business logic uit en krijg juiste data voor pagina terug
$pageData = processRequest($pageTitle);
showResponsePage($pageData);

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

function processRequest($page)
{
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
    echo '<h1 class="headers">' . $page . ' page</h1>';
}

function showMenu()
{
    echo '<nav>
          <ul class="menu">';
    showMenuItem('home', 'HOME');
    showMenuItem('about', 'ABOUT');
    showMenuItem('contact', 'CONTACT');
    if (isUserLoggedIn()) {
        showMenuItem('logout', 'LOGOUT' . getLoggedInUserName());
    } else {
        showMenuItem('login', 'LOGIN');
        showMenuItem('register', 'REGISTER');
    }
    echo '</ul>
        </nav>';
}

function showMenuItem($linkName, $buttonText)
{
    echo '<li><a href="index.php?page=' . $linkName . '">' . $buttonText . '</a></li>';
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
