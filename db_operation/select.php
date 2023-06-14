<?php
session_start();

$result = null;
$limit = 3;
if (isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    // echo $_GET['limit'];
}

// $response = array();
$totalRows = $initial_page = $totalPage = $page_number = $pagination_btn = null;

$conn = mysqli_connect("localhost", "root", "", "studentinfo") or die("connection failed: " . mysqli_connect_error());
$simpleQuery = "";
$departmentId = isset($_GET['dept']) ? $_GET['dept'] : '';

if (isset($_SESSION['id']) && $_SESSION['role'] === 'admin') {
    $flag_option = 0;
    if (!empty($departmentId)) {
        $simpleQuery1 = "SELECT * FROM student1,department where student1.dept_id='$departmentId' AND department.dept_id=student1.dept_id";
        $resultNonPage = mysqli_query($conn, $simpleQuery1);
        $totalRows = mysqli_num_rows($resultNonPage);
        $flag_option = 1;
        // $result = WebContent::executeQuery($simpleQuery);
    } else {
        $simpleQuery2 = "SELECT * FROM student1, department WHERE student1.dept_id = department.dept_id";
        $resultNonPage = mysqli_query($conn, $simpleQuery2);
        $totalRows = mysqli_num_rows($resultNonPage);

        // $result = WebContent::executeQuery($simpleQuery);
    }

    //pagination snnipet code start---------->
    $totalPage = ceil($totalRows / $limit);

    if (!isset($_GET['pagination'])) {
        $page_number = 1;
    } else {
        $page_number = $_GET['pagination'];
    }

    $initial_page = ($page_number - 1) * $limit;

    if ($flag_option === 1) {
        $simpleQuery = "SELECT * FROM student1,department where student1.dept_id='$departmentId' AND department.dept_id=student1.dept_id LIMIT " . $initial_page . ',' . $limit;
    } else if ($flag_option === 0) {
        $simpleQuery = "SELECT * FROM student1,department where student1.dept_id=department.dept_id LIMIT " . $initial_page . ',' . $limit;
    }

    //     if (isset($_GET['dept'])) {
//         $dept_get_id = $_GET['dept'];
//         $simpleQuery = "SELECT * FROM student1,department where student1.dept_id='$dept_get_id' AND department.dept_id=student1.dept_id LIMIT " . $initial_page . ',' . $limit;
//         $result = WebContent::executeQuery($simpleQuery);
//     }else {
//     $simpleQuery = "SELECT * FROM student1,department where student1.dept_id=department.dept_id LIMIT " . $initial_page . ',' . $limit;

    //     $result = WebContent::executeQuery($simpleQuery);
// }

    $result = mysqli_query($conn, $simpleQuery);


    // Generate HTML table rows
    $rows = '';

    while ($info = mysqli_fetch_assoc($result)) {
        $rows .= '<tr>';
        $rows .= '<td data-student-id="' . $info['studid'] . '">' . $info['studid'] . '</td>';
        $rows .= '<td data-stud-name="' . $info['StudName'] . '">' . $info['StudName'] . '</td>';
        $rows .= '<td data-father-name="' . $info['fatherName'] . '">' . $info['fatherName'] . '</td>';
        $rows .= '<td style="display: none;" data-mother-name="' . $info['motherName'] . '"></td>';
        $rows .= '<td style="display: none;" data-gender="' . $info['gender'] . '"></td>';
        $rows .= '<td style="display: none;" data-mail="' . $info['mail'] . '"></td>';
        $rows .= '<td style="display: none;" data-education-lvl="' . $info['educationlvl'] . '"></td>';
        $rows .= '<td data-dob="' . $info['dob'] . '">' . $info['dob'] . '</td>';
        $rows .= '<td data-dept-id="' . $info['dept_id'] . '">' . $info['dept_name'] . '</td>';
        $rows .= '<td style="display: none;" data-mob="' . $info['mob'] . '"></td>';
        $rows .= '<td style="display: none;" data-addr="' . $info['addr'] . '"></td>';
        $rows .= '<td style="display: none;" data-profile-pic="' . $info['profilePic'] . '"></td> ';
        //file upload 
        $rows .= '<td scope="row">';
        if (!empty($info['uploadfile'])) {
            $arrFile = explode(",", $info['uploadfile']);
            foreach ($arrFile as $key => $value) {
                $file_name = basename($value);
                $rows .= '<a class="btn btn-success py-1 px-1" title="Download file" href="' . $value . '" download="' . $file_name . '">';
                $rows .= '<img class="text-white" src="../fileUpload/file-earmark-arrow-down.svg" alt="svg image">';
                // $rows .= $file_name;
                $rows .= '</a>';
            }
        } else {
            $rows .= 'No file available';
        }
        $rows .= '</td>';

        // buttons
        $rows .= '<td><button type="submit" class="eye-btn border-0 bg-body"
    data-student-id="' . $info['studid'] . '"><i class="fas fa-eye"></i></button></td>';
        $rows .= '<td scope="row">';
        $rows .= '<button data-delete-studid="' . $info['studid'] . '" class="btn btn-danger btn-sm" type="submit" name="deleteuser" value="deleteuser"><i
        class="fas fa-trash"></i></button>';
        $rows .= '<button type="submit" id="openButton" data-student-id="' . $info['studid'] . '"
    class="btn dialogbtn btn-sm btn-success"><i class="fas fa-edit"></i></button>';
        $rows .= '</td>';
        // Add more table cells as needed
        $rows .= '</tr>';
    }
} elseif (isset($_SESSION['id']) && $_SESSION['role'] === 'user') {
    $mail = $_SESSION['id'];
    if (strpos($mail, '@') !== false) {
        $simpleQuery = "SELECT * FROM student1, department WHERE student1.dept_id = department.dept_id AND student1.mail = '$mail'";
    } else {
        $simpleQuery = "SELECT * FROM student1, department WHERE student1.dept_id = department.dept_id AND student1.user = '$mail'";
    }

    $result = mysqli_query($conn, $simpleQuery);

    // Generate HTML table rows
    $rows = '';

    while ($info = mysqli_fetch_assoc($result)) {
        $rows .= '<tr>';
        $rows .= '<td data-student-id="' . $info['studid'] . '">' . $info['studid'] . '</td>';
        $rows .= '<td data-stud-name="' . $info['StudName'] . '">' . $info['StudName'] . '</td>';
        $rows .= '<td data-father-name="' . $info['fatherName'] . '">' . $info['fatherName'] . '</td>';
        $rows .= '<td style="display: none;" data-mother-name="' . $info['motherName'] . '"></td>';
        $rows .= '<td style="display: none;" data-gender="' . $info['gender'] . '"></td>';
        $rows .= '<td style="display: none;" data-mail="' . $info['mail'] . '"></td>';
        $rows .= '<td style="display: none;" data-education-lvl="' . $info['educationlvl'] . '"></td>';
        $rows .= '<td data-dob="' . $info['dob'] . '">' . $info['dob'] . '</td>';
        $rows .= '<td data-dept-id="' . $info['dept_id'] . '">' . $info['dept_name'] . '</td>';
        $rows .= '<td style="display: none;" data-mob="' . $info['mob'] . '"></td>';
        $rows .= '<td style="display: none;" data-addr="' . $info['addr'] . '"></td>';
        $rows .= '<td style="display: none;" data-profile-pic="' . $info['profilePic'] . '"></td> ';
        $rows .= '<td style="display: none;" data-user-name="' . $info['user'] . '"></td> ';
        //file upload 
        $rows .= '<td scope="row">';
        if (!empty($info['uploadfile'])) {
            $arrFile = explode(",", $info['uploadfile']);
            foreach ($arrFile as $key => $value) {
                $file_name = basename($value);
                $rows .= '<a class="btn btn-success py-1 px-1" title="Download file" href="' . $value . '" download="' . $file_name . '">';
                $rows .= '<img class="text-white" src="../fileUpload/file-earmark-arrow-down.svg" alt="svg image">';
                // $rows .= $file_name;
                $rows .= '</a>';
            }
        } else {
            $rows .= 'No file available';
        }
        $rows .= '</td>';

        // buttons
        $rows .= '<td><button type="submit" class="eye-btn border-0 bg-body"
    data-student-id="' . $info['studid'] . '"><i class="fas fa-eye"></i></button></td>';
        $rows .= '<td scope="row">';
        // $rows .= '<button data-delete-studid="' . $info['studid'] . '" class="btn btn-danger btn-sm" type="submit" name="deleteuser" value="deleteuser"><i
        //     class="fas fa-trash"></i></button>';
        $rows .= '<button type="submit" id="openButton" data-student-id="' . $info['studid'] . '"
    class="btn dialogbtn btn-sm btn-success"><i class="fas fa-edit"></i></button>';
        $rows .= '</td>';
        // Add more table cells as needed
        $rows .= '</tr>';
    }
}

for ($page_number = 1; $page_number <= $totalPage; $page_number++) {
    if (!empty($departmentId)) {
        $pagination_btn .= "<a data-page=" . $page_number . " data-dept=" . $departmentId . " class='btn btn-sm btn-info mx-1'>$page_number</a>";
    } else {
        $pagination_btn .= "<a data-page=" . $page_number . " class='btn btn-sm btn-info mx-1'>$page_number</a>";

    }
}

mysqli_close($conn);
if ($rows !== '') {
    // Prepare response data
    $response = array(
        'status' => 'success',
        'records' => $rows,
        'pagination_btn' => $pagination_btn
    );
    echo json_encode($response);
    // echo $rows;
} else {
    // echo "<h2>no record found</h2>";
    $response = array(
        'status' => 'error',
        'records' => "<h2>no record found</h2>",
        // 'pagination_btn' => $pagination_btn
    );
    echo json_encode($response);
}



?>