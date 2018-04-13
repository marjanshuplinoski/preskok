<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/css.css">

    <title>Marjan Shuplinoski - Preskok</title>
</head>
<body>


<hr>
<nav class="navbar fixed-top navbar-light bg-light">

    <h2>Preskok Tasks Basic</h2>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Home1</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu1" id="getFolderAndFiles">1.a) Get Folder and Files</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu2" id="checkUploadedToS3">1.b) Check If Uploaded onto S3</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu3" id="checkDownloadedFromS3">1.c) Check If Downloaded from S3</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu20" id="SQLFiles">2) Get all SQL files and apply to db</a></li>
        <li class="nav-item"></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu_p_1" id="parserData">1) Parser for provided data, assoc array</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu_p_2" id="createTable">2) Create Table from data</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu_p_3" id="createTableNames">3 Generate fake name and surname for Buyers</a></li>

    </ul>
</nav>


<div class="form-group">
    &nbsp;
</div>
<div class="form-group">
    &nbsp;
</div>
    <div class="tab-content mx-5 my-5">
        <div id="home" class="tab-pane fade active show">
            <h3>HOME</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
            <div id="getFolderAndFilesResult" class="bg-info col-sm-12 col-md-12 col-lg-12"></div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <div id="checkUploadedToS3Result" class="bg-info col-sm-12 col-md-12 col-lg-12"></div>
        </div>
        <div id="menu3" class="tab-pane fade">
            <div id="checkDownloadedFromS3Result" class="bg-info col-sm-12 col-md-12 col-lg-12"></div>
        </div>
        <div id="menu20" class="tab-pane fade">
            <div id="SQLFilesResult" class="bg-info col-sm-12 col-md-12 col-lg-12"></div>
        </div>
        <div id="menu_p_1" class="tab-pane fade">
            <div id="parserDataResult" class="bg-info col-sm-12 col-md-12 col-lg-12"></div>
        </div>
        <div id="menu_p_2" class="tab-pane fade">
            <div id="createTableResult" class="bg-info col-sm-12 col-md-12 col-lg-12"></div>
        </div>
        <div id="menu_p_3" class="tab-pane fade">
            <div id="createTableNamesResult" class="bg-info col-sm-12 col-md-12 col-lg-12"></div>
        </div>
    </div>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!-- Specific Javascript file for the project requirements -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script src="js/js.js"></script>
</body>
</html>