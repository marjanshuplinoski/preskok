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
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Home</a></li>
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
            <button id="generateFolderWithFiles">Generate Folder with Files</button>
            <div id="homecontent">
                <p>1) Tasks<br>
                a) Get Folder and Files                                                                                                                                                                                                                                                                                                                                                                                                                                                   <br>
                - ajax call to getFolderAndFiles.php                                                                                                                                                                                                                                                                                                                                                                                                                                      <br>
                b) Check that files in directory are uploaded onto AWS S3 * into bucket with same name as a folder, if not upload them                                                                                                                                                                                                                                                                                                                                                    <br>
                - ajax call to checkUploadedToS3.php                                                                                                                                                                                                                                                                                                                                                                                                                                      <br>
                - ajax call to uploadToS3Cloud.php                                                                                                                                                                                                                                                                                                                                                                                                                                        <br>
                1.c) Get all files on amazon (for provided folder) and check that all files are stored locally too, if not download them                                                                                                                                                                                                                                                                                                                                                  <br>
                - ajax call to checkDownloadedFromS3.php                                                                                                                                                                                                                                                                                                                                                                                                                                  <br>
                - ajax call to downloadFromS3Cloud.php                                                                                                                                                                                                                                                                                                                                                                                                                                    <br>
                1.d) Local log to /log every download files and upload directory                                                                                                                                                                                                                                                                                                                                                                                                          <br>
                - inside downloadFromS3Cloud.php & uploadToS3Cloud.php                                                                                                                                                                                                                                                                                                                                                                                                                    <br>
                2) You have a directory with sql files, that are named like “change_20171023_j.sql”, “change_20171024_j.sql”, “change_20171029_j.sql. Write a script, that bundle files into one big sql file based on dates in names and run as SQL query on database. Move all files that were bundled into “applied/[YYYYMMDD]” folder. Script should return success if everything is ok and return exception with a message if error occurred. If error occurred in sql, make rollback<br>
                - ajax call to SQLFiles.php

                <br>
                -- Practical                                                                                                <br>
                1) Write a parser for provided data, so you get a valid associative array of all the rows                   <br>
                - ajax call to parserData.php                                                                               <br>
                2) Create appropriate database table and write all the rows into it, be careful there could be a lot of rows<br>
                - ajax call to createTable.php                                                                              <br>
                3) Generate fake Names and Surnames for all of the Buyers in separated table, one for each buyer.           <br>
                ajax call to createTableNames.php                                                                           <br>
                4) For getting best selling model per client                                                                <br>
                - a) php getBestSellingModel.php or php getBestSellingModel.php BuyerID                                     <br>
                - c) php getBestSellingModelThreeMonths.php -e YYYY-MM-DD -s YYYY-MM-DD                                     <br>
                where e - enddate s - specific date                                                                         <br>
            </p>
            </div>
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