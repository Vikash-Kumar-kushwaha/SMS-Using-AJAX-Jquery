<?php
session_start();
$response = array();
$errors = array();

$role = "";

$conn = mysqli_connect("localhost", "root", "", "studentinfo") or die("connection failed: " . mysqli_connect_error());





$flag = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['role']) && $_POST['role'] === 'admin' && isset($_POST["username"])) {
    $userNameAd = "";
    $passwordAd = "";
    $sql = "SELECT * FROM admin where role='admin'";
    // echo "in admin";
    $query = mysqli_query($conn, $sql);
    $info = mysqli_fetch_assoc($query);
    $role = $_POST['role'];
    if (!$query) {
        $errors[] = "failed connection";
    }
    if (empty($_POST["username"])) {
        $errors[] = "*Username is Required";
        $flag = 1;
    } else {
        $userNameAd = test_input($_POST["username"]);
    }

    if (empty($_POST["pswd"])) {
        $errors[] = "*Password is Required";
        $flag = 1;
    } else {
        $passwordAd = test_input($_POST["pswd"]);
    }

    if ($flag == 0) {
        $check1 = 0;
        if ($userNameAd == $info['username'] && $role == $info['role']) {

            $check1 += 1;
        } else {
            $errors[] = "*Wrong Username";
        }

        if ($passwordAd == $info['password'] && $role == $info['role']) {

            $check1 += 1;
        } else {
            $errors[] = "*Wrong Password";
        }

        if ($check1 === 2) {
            $_SESSION['id'] = $userNameAd;
            $_SESSION['role'] = $role;
            $_SESSION['pass'] = $passwordAd;
        }

        // $bool = 0;
        // if ($userNameAd == $info['username']) {
        //     $bool += 1;
        // } else {
        //     $errors[] = "Wrong Username";
        // }
        // if ($passwordAd == $info['password']) {
        //     $bool += 1;
        // } else {
        //     $errors[] = "Wrong Password";
        // }

        // if ($bool == 2) {
        //     // header('Location:content.php');
        //     $bool = 0;
        // }

    }
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['role']) && $_POST['role'] === 'user') {
    $userName = "";
    $password = "";
    $role = $_POST['role'];
    $flag = 0;
    $check = 0;
    if (empty($_POST["userid"])) {
        $errors[] = "*Username is Required";
        $flag = 1;
    } else {
        $userName = test_input($_POST["userid"]);
    }

    if (empty($_POST["pass"])) {
        $errors[] = "*Password is Required";
        $flag = 1;
    } else {
        $password = test_input($_POST["pass"]);
    }
    // echo $userName;
    // echo $password;

    if (strpos($userName, '@') !== false) {
        // echo "in email if condition";
        // echo $userName;
        // User input is an email
        $sql = "SELECT * FROM student1 WHERE mail='$userName'";
    } else {
        // echo "in username if condition";
        // echo $userName;
        // User input is a username
        $sql = "SELECT * FROM student1 WHERE user='$userName'";
    }
    $query = mysqli_query($conn, $sql);
    // $info = mysqli_fetch_assoc($query);
    if (!$query) {
        $error = mysqli_error($conn);
        // echo "SQL Query Error: " . $error;
        $errors[] = $error;
    }
    if ($flag == 0) {
        if (mysqli_num_rows($query) > 0) {
            while ($info = mysqli_fetch_assoc($query)) {
                if ($userName === $info['mail'] || $userName === $info['user']) {
                    $check++;
                    // echo "success username";
                } else {
                    // echo "success username else part";
                    $errors[] = "*Wrong Username";
                }
                if ($password === $info['mob']) {
                    $check++;
                    // echo "success pass";
                } else {
                    $errors[] = "*Wrong Password";
                }

                if ($check === 2) {
                    // echo "success check-2";
                    $_SESSION['id'] = $userName;
                    $_SESSION['pass'] = $password;
                    $_SESSION['role'] = $role;
                    break;
                }
            }

        } else {
            $errors[] = "No matching records found";
        }
    }
    mysqli_close($conn);
} else {
    $errors[] = "server request method failed";
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
        "message" => "Operation successfully"
    );
}

echo json_encode($response);


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

exit;
?>