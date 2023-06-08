<div class="modal" id="myModal" style="background-color: rgba(0, 0, 0, 0.5) !important; z-index:99">
    <div class="d-flex justify-content-center my-2">

        <form data-update="update" method="post" class="w-50" id="update-modal">
            <div class="table-data shadow-lg p-3 mb-5 bg-white rounded modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close close" aria-label="Close" style="font-size:12px;"></button>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="idnumber">Student Id:</label>
                        <input class="form-control" type="text" name="Studid" value="" id="idnumber"
                            placeholder="Student id" />

                    </div>
                    <div class="col-6">
                        <label class="form-label" for="fname">Full Name:</label>
                        <input data-validation="name" class="form-control" type="text" name="FullName" value=""
                            id="fname" placeholder="first name" />
                        <span id="fnameError">

                        </span>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="father">Father Name:</label>
                        <input data-validation="name" class="form-control" type="text" name="fathername" value=""
                            id="father" placeholder="Father Name" />
                        <span id="fatherError">

                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="mother">Mother Name:</label>
                        <input data-validation="name" class="form-control" type="text" name="mothername" value=""
                            id="mother" placeholder="Mother Name" />
                        <span id="motherError">

                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="dob">Date Of Birth: </label>
                        <input class="form-control" type="date" id="dob" name="dateofbirth" value="" />
                        <span id="dobError">

                        </span>
                    </div>
                    <div class="col-6" id="gender_update">
                        <label class="form-check-label" for="gender">Gender: </label>
                        <div class="form-check">
                            <label class="form-check-label" for="m">Male</label>
                            <input class="form-check-input" type="radio" name="GenderVal" value="male" id="m"
                                required />
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" for="f">Female</label>
                            <input class="form-check-input" type="radio" name="GenderVal" value="female" id="f" />
                        </div>
                        <span id="genderError">

                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="mail">E-mail:</label>
                        <input class="form-control" type="email" name="Email" value="" id="mail"
                            placeholder="xyz@gmail.com" />
                        <span id="mailError">

                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="lvl">Level:</label>
                        <select class="form-select" name="edulevel" id="lvl">
                            <option selected>select school</option>
                            <option value="highschool">High School</option>
                            <option value="secondaryschool">Secondary School</option>
                            <option value="bachelors">Bachelors</option>
                            <option value="masters">Masters</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="">Department: </label>
                        <select class="form-select" name="dept" id="dept">
                            <option selected>Select Dept.</option>
                            <option value="1">CSE</option>
                            <option value="3">MECH</option>
                            <option value="2">IT</option>
                            <option value="4">AGRI</option>
                        </select>
                    </div>
                    <!-- <div class="col-6 py-3">
                        <label class="form-check-label" for="">Skills:</label>
                        Technical Skills <input class="form-check-input" type="checkbox" name="skill[]"
                            value="Technical skills" id="ts" />
                        Analytical Skills<input class="form-check-input" type="checkbox" name="skill[]"
                            value="Analytical skill" id="as" />
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="">Tel/Mob:</label>
                        <input data-validation="mobNumber" id="mob" class="form-control" type="number" name="mobNumber"
                            value="" placeholder="xxxxxxxxxxx" />
                    </div>
                    <div class="col-6">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                                name="add" style="height: 70px"></textarea>
                            <label for="floatingTextarea2">Comments</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="uname">user name:</label>
                        <input type="text" name="user_name" class="form-control" id="uname">
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-6">
                        <input class="btn btn-success w-100" type="submit" value="Update" name="update">
                    </div>
                    <div class="col-6">
                        <input class="btn btn-info w-100" type="reset" value="reset">
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

<div class="modal" id="myModal2" style="background-color: rgba(0, 0, 0, 0.5) !important; z-index:99">
    <div id="card-model" class="modal-content w-50 p-0">
        <?php include('../body/studentCard.php') ?>
    </div>
</div>