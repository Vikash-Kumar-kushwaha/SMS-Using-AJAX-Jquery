<?php
$conn = mysqli_connect("localhost", "root", "", "studentinfo") or die("connection failed: " . mysqli_connect_error());

$sql = "SELECT department.dept_name, department.dept_id,COUNT(StudName) AS student_count FROM department LEFT JOIN student1 ON department.dept_id = student1.dept_id GROUP BY department.dept_name;";

$result = mysqli_query($conn, $sql);

?>

<div class="container " id="main" style="margin-left:12.4rem; position:relative;">
    <table class="table table-hover">
        <thead>
            <th scope="col">Dept Name</th>
            <th scope="col">Student Count</th>
        </thead>
        <tbody>
            <?php while ($info = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td scope="row">
                        <?php echo "{$info['dept_name']}" ?>
                    </td>
                    <td scope="row">
                        <?php echo "<a class='text-decoration-none' data-deptViaLink='{$info['dept_id']}' href='#'>{$info['student_count']}</a>" ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>