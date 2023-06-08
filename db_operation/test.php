<?php
if (isset($_POST['heading']) && isset($_POST['text-content']) && isset($_FILES["file"]["name"])) {
    $response = array();
    $heading = "";
    $text_content = "";
    if (!empty($_POST['heading']) && !empty($_POST['text-content'])) {
        $heading .= $_POST['heading'];
        $text_content .= $_POST['text-content'];
    } else {
        $response['error'] = "Heading and text occur error";
        echo json_encode($response);
        exit;
    }


    $year = date('Y-m-d');
    $extension = '.' . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    if ($extension === '.jpg' || $extension === '.png' || $extension === '.jpeg') {
        // // Directory where the file will be uploaded
        $targetDirectory = '../dynamic_folders/' . $year . '-profile-pic' . '/';


        // Create the target directory if it doesn't exist
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
    } else {
        // // Directory where the file will be uploaded
        $targetDirectory = '../dynamic_folders/' . $year . '-documents' . '/';

        // Create the target directory if it doesn't exist
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
    }
    // Upload the file
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $response['heading'] = $heading;
        $response['text_content'] = $text_content;
        $response['img_path'] = $targetFile;
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response['error'] = "SOrry,there was a error uploading your error";
        echo json_encode($response);
    }
    exit;

}
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data">
        Drop one file: <input type="file" name="file" id="" style="border: 2px solid black;"> <br>
        Put Some Heading: <input type="text" name="heading" id=""> <br>
        Put some text: <input type="text" name="text-content" id="">
        <input type="submit" value="Submit">
    </form>
    <img src="" alt="img" srcset="" height="200" width="200">
    <h1></h1>
    <p></p>

    <div class="clock"></div>

    <script>
        $(document).ready(function () {
            $('form').submit(function () {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "test.php",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        try {
                            if (response.hasOwnProperty('error')) {
                                alert(responses.error);
                            } else {
                                $('h1').text(response.heading);
                                $('p').text(response.text_content);
                                $('img').attr('src', response.img_path);
                            }
                            $('form')[0].reset();
                        }
                        catch (error) {
                            console.error(error);
                            alert("error");
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        alert("An error occurred during the request.");
                    }
                });

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

    </script>
</body>
</html>