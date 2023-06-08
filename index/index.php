<?php
session_start();
require_once '../ExceptionHandling/error_handler.php';
include '../oopsLogic/WebContent.php';

WebContent::header();

WebContent::initDatabase();

if (isset($_SESSION['id']) && isset($_SESSION['pass']) && $_SESSION['role'] === 'admin') {
    WebContent::topbar();
    WebContent::sidebar();
    if (isset($_GET["page"])) {
        switch ($_GET['page']) {
            case 'registration':
                WebContent::content($_GET["page"]);
                break;
            case 'totalDeptCount':
                include '../body/totalDept.php';
                break;
            case 'aboutUs':
                include '../body/aboutUs.php';
                break;
        }

    } else {
        WebContent::Content();
    }
    WebContent::update();

} elseif (isset($_SESSION['id']) && isset($_SESSION['pass']) && $_SESSION['role'] === 'user') {
    WebContent::topbar();
    WebContent::Content();
    WebContent::update();
    WebContent::footer();
} else {
    WebContent::login();
}

WebContent::footer();


?>