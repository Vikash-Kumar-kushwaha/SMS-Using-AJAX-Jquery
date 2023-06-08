<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "<script>window.location.href='index.php'</script>";
    exit();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <button class="sidebar-btn btn btn-success"><i class="fas fa-bars"></i></button>
        <h2 class="text-center flex-grow-1">Student Management System</h2>
        <div class="clock shadow rounded  text-success fw-bold"
            style="position:relative; right:1.5rem; padding: 0.1rem 1rem 0.1rem 1rem">
        </div>
        <form data-logout="logout" action="" method="post">
            <div class="top-nav">
                <button type="submit" class="btn btn-danger" name="logout">Logout</button>
            </div>
        </form>
    </div>
</nav>