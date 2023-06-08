<?php
// session_start();
include '../dbConnet/databaseConn.php';
?>


<?php
class WebContent
{
    private static $db;


    public static function initDatabase()
    {
        self::$db = new database();

        // self::$db->getConnection();

    }

    static function header()
    {

        return include('../head/header.php');
    }
    static function sidebar()
    {
        return include '../sidebar/sidebar.php';
    }
    static function topbar()
    {
        return include '../sidebar/topbar.php';
    }
    static function footer()
    {
        return include '../foot/footer.php';
    }
    static function bodyContent()
    {
        return include '../body/content.php';
    }
    static function content($page = '', $id = null)
    {
        $conn = self::$db->getConnection();

        //index file content

        //index file content


        if ($page === 'registration') {
            return include '../body/registration.php';
        } else {
            return include '../body/content.php';
        }


    }
    static function login()
    {
        // include 'dbConnet/databaseConn.php';
        $conn = self::$db->getConnection();
        return include '../body/login.php';
    }
    static function update()
    {
        // include 'dbConnet/databaseConn.php';
        $conn = self::$db->getConnection();
        return include '../body/update_modal.php';
    }


    static function executeQuery($query)
    {
        $conn = self::$db->getConnection();
        $result = mysqli_query($conn, $query);
        return $result;
    }


}






?>