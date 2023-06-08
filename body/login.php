<form data-admin="admin-form">
    <div class="main-login-body d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="panel-handle-btn">
            <button data-admin-btn="adminBtn" class="btn btn-outline-primary">Admin</button>
            <button data-user-btn="userBtn" class="btn btn-outline-primary">User</button>
        </div>
        <div class="login-body shadow-lg p-3 mb-5 bg-white rounded " style="width:24rem;">
            <h3 class="text-center">Admin Panel</h3>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1Ad">User ID:</label>
                <input type="text" id="form2Example1Ad" name='AdUsername' class="form-control" />
                <span data-pass-error="error" class="text-danger"></span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2Ad">Password:</label>
                <input type="password" id="form2Example2Ad" name='AdPswd' class="form-control" />
                <span data-pass-error="error" class="text-danger"></span>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign in</button>
        </div>
    </div>
</form>

<form data-user="user-form">

    <div class="main-login-body d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="panel-handle-btn">
            <button data-admin-btn="adminBtn" class="btn btn-outline-primary">Admin</button>
            <button data-user-btn="userBtn" class="btn btn-outline-primary">User</button>
        </div>
        <div class="login-body shadow-lg p-3 mb-5 bg-white rounded " style="width:24rem;">
            <h3 class="text-center">User Panel</h3>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1Us">Email/UserName</label>
                <input type="text" id="form2Example1Us" name='username' class="form-control" />
                <span data-name-error="error" class="text-danger"></span>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2Us">Password:</label>
                <input type="password" id="form2Example2Us" name='pswd' class="form-control" />
                <span data-pass-error="error" class="text-danger"></span>
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign in</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("form[data-user='user-form']").hide();
        $("button[data-user-btn='userBtn']").click(function (e) {
            e.preventDefault();
            $("form[data-admin='admin-form']").hide();
            $("form[data-user='user-form']").show();

        });
        $("button[data-admin-btn='adminBtn']").click(function (e) {
            e.preventDefault();
            $("form[data-user='user-form']").hide();
            $("form[data-admin='admin-form']").show();
        });

        $("form[data-admin='admin-form']").submit(function (e) {
            e.preventDefault();
            var id = $("input[name='AdUsername']").val();
            var pass = $("input[name='AdPswd']").val();
            // var loc = window.location.href + "/body/content.php";
            // console.log(loc);
            console.log(id + "this is :-" + pass);

            $.ajax({
                url: "../db_operation/loginHandler.php",
                type: "post",
                data: { "username": id, "pswd": pass, "role": "admin" },
                success: function (response) {
                    try {
                        // console.log(response);
                        var data = JSON.parse(response);
                        // console.log(data);

                        if (data.status === "success") {
                            window.location.href = "index.php";
                        } else if (data.status === "error") {
                            var errorMessage = '';
                            if (Array.isArray(data.message)) {
                                data.message.forEach(function (error) {
                                    errorMessage += error;
                                });
                            } else {
                                alert(data.message);
                            }
                            alert(errorMessage);
                            window.location.href = "#";
                        }
                    } catch (error) {
                        console.error(error);
                    }

                },
            });
        })
        $("form[data-user='user-form']").submit(function (e) {
            e.preventDefault();
            var id = $("input[name='username']").val();
            var pass = $("input[name='pswd']").val();
            // var loc = window.location.href + "/body/content.php";
            // console.log(loc);
            console.log(id + "this is :-" + pass);

            $.ajax({
                url: "../db_operation/loginHandler.php",
                type: "post",
                data: { 'userid': id, 'pass': pass, "role": "user" },
                success: function (response) {
                    console.log(response);
                    var data = JSON.parse(response);
                    console.log(data);

                    if (data.status === "success") {
                        window.location.href = "index.php";
                    } else if (data.status === "error") {
                        var errorMessage = '';
                        if (Array.isArray(data.message)) {
                            data.message.forEach(function (error) {
                                errorMessage += error;
                            });
                        } else {
                            alert(data.message);
                        }
                        alert(errorMessage);
                        window.location.href = "#";
                    }
                },
            });
        })
    });
</script>