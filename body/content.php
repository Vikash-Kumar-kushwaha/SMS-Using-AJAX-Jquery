<style>
    .none-div {
        display: none !important;
    }
</style>

<div class="container " id="main" style="margin-left:12.4rem; position:relative;">
    <div class="body-content">
        <div data-addstud="topDiv"
            class="addstud shadow p-3 my-2 bg-white rounded bg-body shadow d-flex align-items-center justify-content-between">
            <div class="input-group" style="width:20rem">
                <input type="text" id="searchInput" class="form-control" placeholder="">
                <span class="input-group-text">Search</span>
            </div>
            <h3 class="student-info text-center text-info" style="cursor:pointer;">Slide Up</h3>
            <!-- <div class="dropdown" style="left:13rem">
                <button class="btn btn-body dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    SetLimit
                </button>
                <ul class="dropdown-menu p-0">
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-limit="5">5</a></li>
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-limit="10">10</a></li>
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-limit="15">15</a></li>
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-limit="20">20</a></li>
                </ul>
            </div> -->
            <select data-limit="limit" class="form-select" aria-label="Default select example"
                style="width:10rem; left:13rem; position:relative;">
                <option selected>Set Limit</option>
                <option value="3">Default</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select>
            <div class="dropdown" style="left:7rem">
                <button class="btn btn-body dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Department
                </button>
                <ul class="dropdown-menu p-0">
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-dept="1">CSE</a></li>
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-dept="3">MECH</a></li>
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-dept="2">IT</a></li>
                    <li class=""><a class="text-dark text-decoration-none fs-6" href="#" data-dept="4">AGRI</a></li>
                </ul>
            </div>
            <!-- <div class="text-center flex-grow-1  fs-4">Student information</div> -->
            <button class="btn btn-info addNewStudent">
                <a class="text-decoration-none text-white" href="javascript:void(0)">Add New
                    Student</a>
            </button>
        </div>

        <div class="tableData">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" data-column="studid">Stud.id
                            <input class=" arrow-btn bg-body border-0 p-0 " type="submit" value="↑" name="idAsc">
                            <input class=" arrow-btn bg-body border-0 p-0 " type="submit" value="↓" name="idDesc">
                        </th>
                        <th scope="col" data-column="StudName">StudName
                            <input class=" arrow-btn bg-body border-0 p-0 " type="submit" value="↑" name="nameAsc">
                            <input class=" arrow-btn bg-body border-0 p-0 " type="submit" value="↓" name="nameDesc">
                        </th>
                        <th class="hide-column" scope="col">fatherName</th>
                        <th class="hide-column" scope="col">Date Of Birth</th>
                        <th class="hide-column" scope="col">Dept</th>
                        <th scope="col">uploadfile</th>
                        <th scope="col">View</th>
                        <th scope="col">Operations</th>
                    </tr>
                </thead>
                <tbody data-table="table-data">
                </tbody>
            </table>
        </div>
        <?php // include('../body/studentCard.php') ?>
        <div data-pagination="pagination">
            <!-- Pagination links will be dynamically generated here -->
        </div>
    </div>
</div>
<!-- 
<script>
    // $(document).ready(function () {
    //     $('.addNewStudent').click(function () {
    //         console.log('clicked');
    //         $('#main').load('../body/registration.php');
    //     });
    // });
</script> -->
<?php
if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
    <!-- <script>
            $("div[data-addstud='topDiv']").addClass("hindiboy");
        </script> -->

    <script>
        $(document).ready(function () {
            // $('.addNewStudent').click(function () {
            //     console.log('clicked');
            //     $('#main').load('../body/registration.php');
            // });
            $("div[data-addstud='topDiv']").addClass("none-div");
            $(".sidebar-btn").addClass("none-div");
        });
    </script>
<?php endif; ?>

<?php
if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
    <!-- <script>
            $("div[data-addstud='topDiv']").addClass("hindiboy");
        </script> -->

    <script>
        $(document).ready(function () {
            // $('.addNewStudent').click(function () {
            //     console.log('clicked');
            //     $('#main').load('../body/registration.php');
            // });
            $("div[data-addstud='topDiv']").show();
        });
    </script>
<?php endif; ?>