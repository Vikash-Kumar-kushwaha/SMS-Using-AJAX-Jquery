<?php
$conn = mysqli_connect("localhost", "root", "", "studentinfo") or die("connection failed: " . mysqli_connect_error());

if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $sql = "delete from student1 where studid = " . $_GET["id"];
    $deleteDone = mysqli_query($conn, $sql);

    if ($deleteDone) {
        echo "data deleted successfully";
        die;
    }

}

mysqli_close($conn);
?>