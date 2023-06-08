<?php
$conn = mysqli_connect("localhost", "root", "", "studentinfo") or die("connection failed: " . mysqli_connect_error());

$column = $_GET['column'];
$sort = $_GET['sort'];

$sql = "SELECT * FROM student1, department WHERE student1.dept_id = department.dept_id ORDER BY ";

if ($column === 'studid') {
    $sql .= "student1.studid ";
} else if ($column === 'StudName') {
    $sql .= "student1.StudName ";
}

if ($sort === 'idAsc' || $sort === 'nameAsc') {
    $sql .= "ASC";
} else if ($sort === 'idDesc' || $sort === 'nameDesc') {
    $sql .= "DESC";
}

$result = mysqli_query($conn, $sql);

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
    $rows .= '<td data-dept-name="' . $info['dept_id'] . '">' . $info['dept_name'] . '</td>';
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
    $rows .= '<td><button type="button" class="eye-btn border-0 bg-body"
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
mysqli_close($conn);
if ($rows !== '') {
    echo $rows;
} else {
    echo "<h2>no record found</h2>";
}
?>