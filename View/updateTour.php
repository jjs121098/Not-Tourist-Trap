<?php

//controller includes
include '../Controller/tourController.php';

//session check 
if(!isset($_SESSION))
    session_start();

//get tour ID
$tourID = $_GET['tourID'];

//fetch tour details and images
$tourImages = tourController::fetchTourImages($tourID);
$tourDetails = tourController::fetchTourDetails($tourID);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $tourDetails[0]['Name']?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="./src/bootstrap-input-spinner.js"></script>

    <script>
        // scroll functions
        $(window).scroll(function(e) {

        // add/remove class to navbar when scrolling to hide/show
        var scroll = $(window).scrollTop();
        if (scroll >= 150) {
            $('.navbar').addClass("navbar-hide");
        } else {
            $('.navbar').removeClass("navbar-hide");
        }

        });
    </script>

    <script type="text/javascript">

        function showInput() 
        {
            document.getElementById('inputSize').style.display = "block";
            document.getElementById('buttonGroup2').style.display = "block";
            document.getElementById('buttonGroup1').style.display = "none";
        }

        function closeInput()
        {
            document.getElementById('inputSize').style.display = "none";
            document.getElementById('buttonGroup2').style.display = "none";
            document.getElementById('buttonGroup1').style.display = "block";
        }

    </script>

    <link rel="stylesheet" type="text/css" href="../GeneralStyles.css"/>

    <style>
        .jumbotron 
        {
            background-image : url("../Images/bali.jpg");
            height : 100%;
        }

        .card 
        {
            width : 70rem;
            height : 90rem;
            margin : 0 auto;
            margin-top : 80px;
            margin-bottom : 40px;
        }

        .alert
        {
            width : 70rem;
            margin : 0 auto;
            margin-top : 30px;
            margin-bottom : 30px;
        }
    </style>

</head>
<body>

    <header class="jumbotron jumbotron-fluid">

        <!--navigation bar-->
        <nav class="navbar fixed-top transparent navbar-expand-lg navbar-light">

            <!--toggler for small windows-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--Home hyperlink-->
            <a class="navbar-brand" href="../index.php"><h3 style="color : white;">Not-Tourist-Trap</h3></a>

            <!--nav list-->
            <?php
                if (isset($_SESSION['ufName'])) //display nav bar according to whether the user has been logged in
                {
                    include_once("../constants/loggedNavBar.php");
                }
                else
                {
                    include_once("../constants/generalNavBar.php");
                }
            ?>

        </nav>
        <!--end navigation bar-->
        
        <!-- Success or Fail Alert -->
        <?php if(isset($check)) : ?> 

            <?php if ($check) : ?>

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Tour Successfully Booked!</h4>
                    <hr>
                    <p>You can View "<?php echo $tourName ?>" in Your List of Bookings</p>
                </div>

            <?php else : ?>

                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Failed to Book Tour</h4>
                    <hr>
                    <p></p>
                </div>
            <?php endif;?>

        <?php endif;?>
        <!-- End Alert -->
        
        <!-- Tour Card -->
        <div class="card">
            <div id="carouselImages" class="carousel slide" data-ride="carousel">

                <div class="carousel-inner">

                    <?php for($i=0; $i < count($tourImages); $i++) :?>
                        <?php $src = "../Uploaded_Images/".$tourImages[$i];?>
                        
                        <?php if($i == 0) : $class = "carousel-item active"?>
                            
                        <?php else : $class="carousel-item"?>

                        <?php endif;?>

                        <div class="<?php echo $class ?>">
                            <img src="<?php echo $src?>" class="d-block w-100" alt="..." style="height:700px;width:400px">
                        </div>

                    <?php endfor;?>
                    
                </div>

                <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
            <!-- replaced with tour update details if user click -->
            <div id="tourHeader" class="card-body text-center">
                <h1 class="card-title"><?php echo $tourDetails[0]['Name']?></h1>
                <br><br>
                <p class="card-text"><?php echo $tourDetails[0]['Description'] ?></p>
            </div>

            <div id="touHeader" class="card-body">
                <h5 class="card-text">Dates : <?php echo date_format(date_create($tourDetails[0]['Start_date']), "d M Y") ?> - <?php echo date_format(date_create($tourDetails[0]['End_date']), "d M Y") ?></h5>
                <h5 class="card-text">Price : $<?php echo $tourDetails[0]['Price'] ?></h5>
                <h5 class="card-text">Max Tour Size : <?php echo $tourDetails[0]['Group_Size'] ?> people</h5>
            </div>
            <!-- end div -->

            <div class="card-body">
                <div class="form-group">
                    <label for="inputTourName">Select Tour Name</label>
                    <input name="tourName" type="text" class="form-control" id="inputTourName" placeholder="e.g. Experience the local cuisine of Paris, France!" required>
                </div>

                <div class="form-group">
                    <label for="tourDesc">Describe your Tour for the Tourists to See</label>
                    <textarea class="form-control" id="tourDesc" rows="5" name="tourDescription"></textarea>
                </div>
            </div>

            <div class="card-body text-center">

                <!-- first group of buttons -->
                <div id="buttonGroup1">
                    <button type="button" name="book" class="btn btn-dark" onclick="showInput()">Update Tour</button></a><br><br>
                    <button type="button" class="btn btn-dark">Cancel Tour</button>
                </div>
                <!-- end group 1 -->
                
                <!--second group of buttons-->
                <div id="buttonGroup2" style="display:none;">
                    <a href='' onclick="this.href='<?php echo $_SERVER['REQUEST_URI']?>&tourSize='+document.getElementById('tourSize').value"><button type="button" name="book" class="btn btn-dark">Confirm Cancellation</button></a><br><br>
                    <button type="button" class="btn btn-dark" onclick="closeInput()">Cancel</button>
                </div>
                <!-- end group 2 -->

            </div>
        </div>
        <!-- End Tour Card -->

    </header>

</body>
</html>