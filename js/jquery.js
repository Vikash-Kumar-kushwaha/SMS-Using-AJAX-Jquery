$('document').ready(function () {
  //load table data from backend

  var currentDepartmentId = null;
  var page = 1;
  var page_limit = 3;
  // Example department ID
  // loadTableData(currentDepartmentId, null);

  //sidebar handler snippet

  $('.sidebar-btn').click(function () {
    $('#sidebar-container').toggle(500);
    $('#main').toggleClass('main-container', 1000);
  });

  //slidetoggle operation

  $('.student-info').click(function () {
    $('.tableData').slideToggle(500);
  });

  // let flag = 0;
  // $('.eye-btn').click(function (event) {
  //     event.preventDefault();
  //     // $(this).closest('tr').find('.hide-column').toggle();
  //     $(this).closest('tr').find('.hide-column').fadeToggle(500);
  //     // $(this).closest('tr').find('.hide-column').animate({
  //     //     width: 'toggle'
  //     // });

  //     if (flag == 0)
  //         // $(this).closest('table').find('thead th.hide-column').toggle();
  //         $(this).closest('table').find('thead th.hide-column').fadeToggle("slow");
  //     flag++;
  // });
  // $('.student-info').css({ "cursor": "pointer" });
  // $('.student-info').click(function () {
  //     $('.tableData').slideToggle("slow")
  // })
  // $('.hide-column').hide();

  //Handler for sorting arrow button

  $('.arrow-btn').click(function (e) {
    e.preventDefault();
    var column = $(this).closest('th').data('column');
    var sort = $(this).attr('name');

    $.ajax({
      url: '../db_operation/sorting.php',
      type: 'GET',
      data: { column: column, sort: sort },
      success: function (data) {
        $('tbody[data-table]').html(data);
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  $(document).on('click', 'a[data-dept]', function (e) {
    e.preventDefault();
    currentDepartmentId = $(this).data('dept');
    page = 1;
    departmentTableData(currentDepartmentId, page, page_limit);
  });

  $(document).on('change', 'select[data-limit]', function (e) {
    e.preventDefault();
    page_limit = $(this).val();
    if (currentDepartmentId !== null) {
      departmentTableData(currentDepartmentId, page, page_limit);
    } else {
      loadTableData(page, page_limit);
    }
  });

  // function loadTableData(departmentId) {
  //   $.ajax({
  //     url: '../db_operation/select.php',
  //     type: 'GET',
  //     data: { dept: departmentId },
  //     success: function (data) {
  //       $('tbody[data-table]').html(data);
  //     },
  //   });
  // }
  function loadTableData(page, page_limit) {
    $.ajax({
      url: '../db_operation/select.php',
      type: 'GET',
      data: { pagination: page, limit: page_limit },
      success: function (response) {
        var data = JSON.parse(response);
        $('tbody[data-table]').html(data.records);
        $("div[data-pagination='pagination']").html(data.pagination_btn);
      },
    });
  }

  function departmentTableData(departmentId, page, page_limit) {
    $.ajax({
      url: '../db_operation/select.php',
      type: 'GET',
      data: { dept: departmentId, pagination: page, limit: page_limit },
      success: function (response) {
        var data = JSON.parse(response);
        $('tbody[data-table]').html(data.records);
        $("div[data-pagination='pagination']").html(data.pagination_btn);
      },
    });
  }

  // $(document).ready(function() {
  // var currentDepartmentId = 1; // Example department ID
  // loadTableData(currentDepartmentId, 1); // Load initial page

  // Handle pagination link click event
  $(document).on(
    'click',
    'div[data-pagination="pagination"] a[data-page]',
    function (e) {
      e.preventDefault();
      page = $(this).data('page');
      console.log(page);

      if (currentDepartmentId !== null) {
        departmentTableData(currentDepartmentId, page, page_limit);
      } else {
        loadTableData(page, page_limit);
      }
    }
  );
  // });
  if (currentDepartmentId !== null) {
    departmentTableData(currentDepartmentId, page, page_limit);
  } else {
    loadTableData(page, page_limit);
  }
  // loadTableData(currentDepartmentId, page, page_limit);

  $('#searchInput').on('keyup', function () {
    console.log('clicked');
    var searchTerm = $(this).val().toLowerCase();
    $('table')
      .find('tbody tr')
      .each(function (index, row) {
        // var rowData = $(row).text().toLocaleLowerCase();
        // var match = rowData.indexOf(searchTerm) > -1;
        // $(row).toggle(match);

        var nameColumn = $(row).find('td:nth-child(2)');
        var rowData = nameColumn.text().toLowerCase();
        var match = rowData.indexOf(searchTerm) > -1;
        $(row).toggle(match);
      });
  });

  //Model handler snippet for update

  $('.tableData').on('click', '#openButton', function (e) {
    e.preventDefault();
    var studentId = $(this).data('student-id');
    console.log('Button clicked for student ID: ' + studentId);

    // GET data for form
    var targetPathTd = $(this).parent();
    var student_id = targetPathTd
      .siblings('td[data-student-id]')
      .data('student-id');
    var student_name = targetPathTd
      .siblings('td[data-stud-name]')
      .data('stud-name');
    var father_name = targetPathTd
      .siblings('td[data-father-name]')
      .data('father-name');
    var mother_name = targetPathTd
      .siblings('td[data-mother-name]')
      .data('mother-name');
    var dob = targetPathTd.siblings('td[data-dob]').data('dob');
    var gender = targetPathTd.siblings('td[data-gender]').data('gender');
    var email = targetPathTd.siblings('td[data-mail]').data('mail');
    var education_lvl = targetPathTd
      .siblings('td[data-education-lvl]')
      .data('education-lvl');
    var mob = targetPathTd.siblings('td[data-mob]').data('mob');
    var dept_id = targetPathTd.siblings('td[data-dept-id]').data('dept-id');
    var addr = targetPathTd.siblings('td[data-addr]').data('addr');
    var user_name = targetPathTd
      .siblings('td[data-user-name]')
      .data('user-name');

    // SET data in form
    var ele = $('#myModal');

    var trg = ele.find('form').children().children('.row').children('.col-6');

    trg.children('input[name=Studid]').val(student_id);
    trg.children('input[name=FullName]').val(student_name);
    trg.children('input[name=fathername]').val(father_name);
    trg.children('input[name=mothername]').val(mother_name);
    trg.children('input[name=dateofbirth]').val(dob);

    if (gender === 'male') {
      $('#m').prop('checked', true);
      $('#f').prop('checked', false);
    } else if (gender === 'female') {
      $('#m').prop('checked', false);
      $('#f').prop('checked', true);
    } else {
      $('#m').prop('checked', false);
      $('#f').prop('checked', false);
    }
    trg.children('input[name=Email]').val(email);
    trg.children('select[name=edulevel]').val(education_lvl);
    var dept = trg.children('select[name=dept]').val(dept_id);
    // console.log(dept);
    trg.children('input[name=mobNumber]').val(mob);
    trg.children().children('textarea[name=add]').val(addr);
    var uname = trg.children('input[name=user_name]').val(user_name);
    // console.log(uname);
    $(".top-nav button[name='logout']").addClass('hiilogout');
    $('#myModal').show();
  });

  $('.close').click(function () {
    $('#myModal').hide();
  });

  //update form send to backend

  $(document).on('submit', 'form[data-update="update"]', function (event) {
    // Prevent form submission
    event.preventDefault();

    // console.log($('form').serialize());

    $.ajax({
      url: '../db_operation/updata.php',
      type: 'POST',
      data: $('form').serialize(),
      success: function (response) {
        // Handle the response from the backend
        var data = JSON.parse(response);
        if (data.status === 'error') {
          alert(data.message);
        } else if (data.status === 'success') {
          alert(data.message);
          // $('.close').click();
          // loadTableData();
          $(".top-nav button[name='logout']").click();
        }
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });

  //Code snnipet for open Student Card by click

  $('.body-content .tableData').on('click', '.eye-btn', function (e) {
    e.preventDefault();
    var studentId = $(this).data('student-id');
    console.log('Button clicked for student ID: ' + studentId);

    //get data for card

    var targetPathTd = $(this).parent();
    var profile_pic = targetPathTd
      .siblings('[data-profile-pic]')
      .data('profile-pic');
    var student_name = targetPathTd
      .siblings('td[data-stud-name]')
      .data('stud-name');
    var father_name = targetPathTd
      .siblings('td[data-father-name]')
      .data('father-name');
    var dept_name = targetPathTd.siblings('td[data-dept-id]').text();
    var mother_name = targetPathTd
      .siblings('td[data-mother-name]')
      .data('mother-name');
    var dob = targetPathTd.siblings('td[data-dob]').data('dob');

    var gender = targetPathTd.siblings('td[data-gender]').data('gender');

    //set data into card

    var ele = $('#myModal2').children().children().children('.info-card');
    ele.children().children('img').attr('src', profile_pic);
    ele
      .children()
      .children()
      .children('#student_name')
      .html('<strong>Name:</strong> ' + student_name);
    ele
      .children()
      .children()
      .children('#father_name')
      .html('<strong> Father Name:</strong> ' + father_name);
    ele
      .children()
      .children()
      .children('#mother_name')
      .html('<strong>Mother Name:</strong> ' + mother_name);
    ele
      .children()
      .children()
      .children('#dob')
      .html('<strong>DOB:</strong> ' + dob);
    ele
      .children()
      .children()
      .children('#dept')
      .html('<strong>Dept:</strong> ' + dept_name);
    ele
      .children()
      .children()
      .children('#gender')
      .html('<strong>Gender:</strong> ' + gender);

    $('#myModal2').show();
  });

  $('.close-2').click(function () {
    $('#myModal2').hide();
  });

  //new student registration page load snnipet

  $(document).on('click', '.addNewStudent', function () {
    // $('.addNewStudent').click(function () {
    console.log('clicked');
    $('#main').load('../body/registration.php');
  });

  //Open Total department page

  $("div[data-allDept='allDept']").click(function () {
    var url = $(this).children().attr('href', 'index.php?page=totalDeptCount');
  });

  //form validation and insert value to backend from frontend snippet

  $(document).on(
    'keydown',
    'input[data-validation="mobNumber"]',
    function (event) {
      var input = $(this);
      var errorSpan = input.next('span');
      var value = input.val().trim();
      var isValid = true;

      // Reset error message
      errorSpan.text('');

      if (value.length >= 10 && event.keyCode !== 8 && event.keyCode !== 9) {
        event.preventDefault(); // Prevent further input
      }

      if (value === '') {
        errorSpan.text('Please enter your mobile number').css('color', 'red');
        isValid = false;
      } else if (isNaN(value) || value.length !== 10) {
        errorSpan
          .text('Please enter a valid 10-digit mobile number')
          .css('color', 'red');
        isValid = false;
      }

      // Set input validity
      input.data('valid', isValid);
    }
  );

  $(document).on('keydown', 'input[data-validation="name"]', function (event) {
    var input = $(this);
    var errorSpan = input.next('span');
    var value = input.val().trim();
    var isValid = true;

    // Reset error message
    errorSpan.text('');

    if (value === '') {
      errorSpan.text('Please enter a name').css('color', 'red');
      isValid = false;
    } else if (/\d/.test(value)) {
      errorSpan
        .text('Name should not contain numeric characters')
        .css('color', 'red');
      isValid = false;
    } else if (!/^[a-zA-Z\s]*$/.test(value)) {
      errorSpan
        .text('Name should not contain special characters')
        .css('color', 'red');
      isValid = false;
    }

    // Set input validity
    input.data('valid', isValid);
  });

  $(document).on(
    'submit',
    'form[data-registration="registration"]',
    function (event) {
      // Prevent form submission
      event.preventDefault();

      // Reset error messages
      $('.error').text('');

      // Validate inputs
      var isValid = true;

      // Validate Date of Birth
      var dob = $('#dob').val();
      if (dob.trim() === '') {
        $('#dobError').text('Please enter your date of birth');
        isValid = false;
      }

      // Validate Gender
      var gender = $("input[name='GenderVal']:checked").val();
      if (!gender) {
        $('#genderError').text('Please select your gender');
        isValid = false;
      }

      // Validate Email
      // var email = $("#mail").val();
      // if (email.trim() === "") {
      //     $("#mailError").text("Please enter your email");
      //     isValid = false;
      // }

      // Validate Level
      var level = $('#lvl').val();
      if (level === 'select school') {
        $('#levelError').text('Please select your level');
        isValid = false;
      }

      // Validate Department
      var department = $("select[name='dept']").val();
      if (department === 'Select Dept.') {
        $('#deptError').text('Please select your department');
        isValid = false;
      }

      // Validate Technical Skills
      var skills = $("input[name='skill[]']:checked").length;
      if (skills === 0) {
        $('#skillsError').text('Please select at least one skill');
        isValid = false;
      }

      // Validate Comments
      var comments = $('#floatingTextarea2').val();
      if (comments.trim() === '') {
        $('#commentsError').text('Please enter your comments');
        isValid = false;
      }

      // Validate File Upload
      var fileUpload = $("input[name='file[]']");
      var fileUploadError = $('#fileUploadError');
      var files = fileUpload[0].files;

      if (files.length === 0) {
        fileUploadError.text('Please upload your documents');
        isValid = false;
      }

      // Validate Profile Picture
      var profilePic = $("input[name='profilepic']");
      var profilePicError = $('#profilePicError');
      var profilePicFile = profilePic[0].files[0];

      if (!profilePicFile) {
        profilePicError.text('Please upload your profile picture');
        isValid = false;
      }

      // If all inputs are valid, submit the form
      if (isValid) {
        var formData = new FormData(this);

        // Submit the form to the backend

        $.ajax({
          url: '../db_operation/insert.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            try {
              var result = JSON.parse(response);
              console.log(result);
              // Handle the response from the backend
              if (result.status === 'success') {
                alert(result.message);
                $('#main').load('../body/content.php .body-content');
                loadTableData();
              } else if (result.status === 'error') {
                var errorMessage = '';
                if (Array.isArray(result.message)) {
                  result.message.forEach(function (error) {
                    errorMessage += error;
                  });
                } else {
                  alert(result.message);
                }
                alert(errorMessage);
                window.location.href = '#';
              }
            } catch (error) {
              console.error(error);
              alert(error);
            }
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            alert('An error occurred during the request.');
          },
        });
      } else {
        $('span[id]').css('color', 'red');
      }
    }
  );

  $(document).on('click', "button[name='deleteuser']", function (e) {
    e.preventDefault();
    var studentId = $(this).data('delete-studid');
    var confirmDelete = confirm(
      'Are you sure you want to delete this student?'
    );
    console.log(studentId);
    if (confirmDelete) {
      $.ajax({
        url: '../db_operation/delete.php',
        type: 'GET',
        data: { id: studentId },
        success: function (response) {
          loadTableData();
        },
      });
    }
  });

  function handleClock() {
    var now = new Date();
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    var seconds = now.getSeconds().toString().padStart(2, '0');
    var timeString = hours + ':' + minutes + ':' + seconds;

    $('.clock').text(timeString);
  }

  setInterval(handleClock, 1000);
});
