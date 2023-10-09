
<?php



// Dit heb ik gekopieerd uit de opdracht://
//stap 1

// ===================================
// MAIN APP
// ===================================
$page = getRequestedPage();

//stap 2
showResponsePage($page);


// ===================================
// FUNCTIONS
// ===================================

function getRequestedPage()
{
    $requestType = $_SERVER['REQUEST_METHOD'];

    if ($requestType == "POST"){
        $requestedPage = getPageFromPost();
    } else{
        $requestedPage = getPageFromGet();
    }
    return $requestedPage;

}

function showResponsePage(){

};


function getPageFromPost(){

};

function getPageFromGet(){
//query parameters//
};



// getPageFromPost
// getPageFromGet









function beginDocument(){
    echo "<!doctype html>
    <html>";
}





// Dit is de nav-bar voor een GET request (met URLparameter):

// <nav>
//         <ul class="menu">
//             <li><a href="index.php?page=home">HOME</a></li>
//             <li><a href="index.php?page=about">ABOUT</a></li>
//             <li><a href="index.php?page=contact">CONTACT</a></li>
//         </ul>
//     </nav>


?>





