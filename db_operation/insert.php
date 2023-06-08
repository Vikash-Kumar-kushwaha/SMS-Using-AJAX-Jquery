<?php
$response = array();
$errors = array();
require_once "../ExceptionHandling/error_handler.php";
require_once "../dbConnet/databaseConn.php";

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
try {
    // $dbConnect = new database();
    // $dbConnect->getConnection();



    $conn = mysqli_connect("localhost", "root", "", "studentinfo") or die("connection failed: " . mysqli_connect_error());



    $fName = $_POST["FullName"];
    $fatherName = $_POST["fathername"];
    $motherName = $_POST["mothername"];
    $DOB = $_POST["dateofbirth"];
    $gender = $_POST["GenderVal"];
    $mail = $_POST["Email"];
    $mob = $_POST["mobNumber"];
    $address = $_POST["add"];
    $Skills = null;
    $skill = null;
    $educationlvl = $_POST["edulevel"];
    $dept = $_POST["dept"];
    $folderLocation = null;
    $target_file = null;
    foreach ($_POST["skill"] as $value) {
        $skill .= $value . ",";
        $Skills = $skill;
    }
    // File handling snippet
    $fileName = $_FILES["file"]["name"];
    $allowed_types = array("pdf");
    $profileFile = $_FILES["profilepic"]["name"];
    $profileFileTemp = $_FILES["profilepic"]["tmp_name"];
    $userMail = "";



    //backend form validation---------------
    $flag = 0;
    if (empty($_POST["FullName"])) {
        $errors[] = "* Student Full Name Required";
        $flag = 1;
    } else {
        $fName = test_input($_POST["FullName"]);
    }

    if (empty($_POST["fathername"])) {
        $errors[] = "* Father Name Required";

        $flag = 1;
    } else {
        $fatherName = test_input($_POST["fathername"]);
    }

    if (empty($_POST["mothername"])) {
        $errors[] = "* Mother Name Required";
        $flag = 1;
    } else {
        $motherName = test_input($_POST["mothername"]);

    }

    if (empty($_POST["dateofbirth"])) {
        $errors[] = "* Date of Birth Required";
        $flag = 1;
    } else {
        $DOB = test_input($_POST["dateofbirth"]);

    }

    if (empty($_POST["GenderVal"])) {
        $errors[] = "* Gender is Required";
        $flag = 1;
    } else {
        $gender = test_input($_POST["GenderVal"]);

    }

    if (empty($_POST["Email"])) {
        $errors[] = "* Mail is Required";
        $flag = 1;
    } else {
        $mail = test_input($_POST["Email"]);
        $userMail = strstr($mail, '@gmail.com', true);

    }

    if (empty($_POST["edulevel"])) {
        $errors[] = "* Education LEVEL is Required";
        $flag = 1;
    } else {
        $educationlvl = test_input($_POST["edulevel"]);

    }

    if (empty($_POST["dept"])) {
        $errors[] = "* Dept is Required";
        $flag = 1;
    } else {
        $dept = test_input($_POST["dept"]);

    }

    if (empty($_POST["mobNumber"])) {
        $errors[] = "* Mobile Number is Required";
        $flag = 1;
    } else {
        $mob = test_input($_POST["mobNumber"]);

    }

    if (empty($_POST["add"])) {
        $errors[] = "* Address is Required";
        $flag = 1;
    } else {
        $address = test_input($_POST["add"]);

    }

    if (empty($_POST["skill"])) {
        $errors[] = "* One Skill is Required";
        $flag = 1;
    } else {
        foreach ($_POST["skill"] as $value) {
            $skill .= $value . ",";
            $Skills = test_input($skill);
        }
    }


    // Get the current year
    $year = date("Y");
    $fileExtension = "";
    $profilePicExt = "." . strtolower(pathinfo($_FILES["profilepic"]["name"], PATHINFO_EXTENSION));

    foreach ($_FILES["file"]["name"] as $key => $name) {
        $fileExtension = "." . strtolower(pathinfo($name, PATHINFO_EXTENSION));
    }

    if ($profilePicExt === ".jpg" || $profilePicExt === ".png" || $profilePicExt === ".jpeg") {
        // // Directory where the file will be uploaded
        $profilePicDIr = "../dynamic_folders/" . $year . "-profile-pic" . "/";

        // Create the target directory if it doesn"t exist
        if (!is_dir($profilePicDIr)) {
            mkdir($profilePicDIr, 0777, true);
        }
    }
    if ($fileExtension === ".pdf") {
        // // Directory where the file will be uploaded
        $targetDirectory = "../dynamic_folders/" . $year . "-documents" . "/";
        // Create the target directory if it doesn"t exist
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
    } else {
        $targetDirectory = "../dynamic_folders/" . $year . "/";
        // Create the target directory if it doesn"t exist
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
    }

    // File handling snippet

    if (!empty($fileName)) {
        $list = array();

        foreach ($_FILES["file"]["name"] as $key => $name) {
            $fileTemp = $_FILES["file"]["tmp_name"][$key];
            $extension = pathinfo($name, PATHINFO_EXTENSION);

            if (in_array($extension, $allowed_types)) {
                $uniqueName = time() . "_" . rand(1000, 9999) . "." . $extension;
                $localLocat = $targetDirectory . $uniqueName;
                $list[] = $localLocat;
                $folderLocation = implode(",", $list);
                move_uploaded_file($fileTemp, $localLocat);
            }
        }
    }

    if (!empty($profileFile)) {
        $target_file = $profilePicDIr . basename($profileFile);
        move_uploaded_file($profileFileTemp, $target_file);
    }

    if ($flag == 0) {
        $sql = "INSERT INTO STUDENT1 (StudName,fatherName,motherName,dob,gender,mail,educationlvl,dept_id,mob,addr,skills,uploadfile,profilePic,user) 
    VALUES('$fName','$fatherName','$motherName','$DOB','$gender','$mail','$educationlvl','$dept','$mob','$address','$Skills','$folderLocation','$target_file','$userMail')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $errors[] = "Error occur while querying";
        }
    }






} catch (Exception $e) {
    $errors[] = $e->getMessage();
    exceptionHandler($e);
}

if (!empty($errors)) {
    $response = array(
        "status" => "error",
        "message" => $errors,
        "error_code" => 500
    );
} else {
    $response = array(
        "status" => "success",
        "message" => "data successfully inserted"
    );
}
echo json_encode($response);


// Close the database connection
mysqli_close($conn);
?>