<?php
// $sport_images = array(
//     "basketBall" => "../fileUpload/card-images/basketball.avif",
//     "coPlayer" => "./fileUpload/card-images/coPlayer.avif",
//     "football" => "./fileUpload/card-images/football.avif",
//     "sport" => "./fileUpload/card-images/sport.jpg",
//     "cricket" => "../fileUpload/card-images/cricket.jpg",
//     "kho-kho" => "./fileUpload/card-images/kho-kho.jpg",
//     "kabbadi" => "./fileUpload/card-images/download.jpg",
//     "swiming" => "./fileUpload/card-images/swiming.jpg"

// );

// $len = sizeof($sport_images);
$htmlELement = "";
$htmlELement .= "<div class='container mt-2' id='main' style='margin-left:12.4rem; position:relative;'>";
$htmlELement .= "<div class='banner text-center '><h2 class='h2 shadow p-1 mb-1 rounded'>University activities</h2></div>";
$htmlELement .= "<form action='' class='d-flex gap-2 justify-content-center' data-activity='sport' enctype='multipart/form-data' >";
$htmlELement .= "<div class='form-group'>";
$htmlELement .= "<label for='sport-image'>Put Image of sport</label>";
$htmlELement .= "<input class='form-control' type='file' name='sportsFile' id='sport-image'>";
$htmlELement .= "</div>";
$htmlELement .= "<div class='form-group'>";
$htmlELement .= "<label for='sport-heading'>Heading</label>";
$htmlELement .= "<input type='text' class='form-control' name='sport-heading' id='sport-heading'>";
$htmlELement .= "</div>";
$htmlELement .= "<div class='form-group'>";
$htmlELement .= "<label for='sport-text'>Content</label>";
$htmlELement .= "<input type='text' class='form-control' name='sport-content' id='sport-text'>";
$htmlELement .= "</div>";
$htmlELement .= "<input type='submit' class='btn btn-primary' data-activity='sport' value='Submit'>";
$htmlELement .= "</form>";
$htmlELement .= "<div id='card-handle' class='d-flex justify-content-center align-items-center flex-row gap-2 flex-wrap'>";

$htmlELement .= "</div>";
$htmlELement .= "</div>";

echo $htmlELement;

?>


<script>
    $(document).ready(function () {
        function loadCardData() {
            $.ajax({
                url: "../db_operation/sportInsert.php",
                type: "get",
                success: function (response) {
                    var data = JSON.parse(response);
                    console.log(data.file_path);
                    if (data.hasOwnProperty('error')) {
                        alert('Error occurred while fetching data.');
                    } else {
                        // Display the retrieved data on the page
                        // $('#title').text(data.title);
                        // $('#description').text(data.description);
                        // $('.card img').attr('src', data.file_path);
                        $('#card-handle').html(data);

                    }
                }
            });
        }

        loadCardData();


        $('form').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData);

            $.ajax({
                url: "../db_operation/sportInsert.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // var responses = JSON.parse(response);
                    // console.log(response);
                    alert(response);
                    ("form")[0].reset();
                    loadCardData();
                }
            });
        });
    });
</script>