"# Preskok" 

@author Marjan Shuplinoski


1) Tasks 
a) Get Folder and Files
    - ajax call to getFolderAndFiles.php 
b) Check that files in directory are uploaded onto AWS S3 * into bucket with same name as a folder, if not upload them 
    - ajax call to checkUploadedToS3.php 
    - ajax call to uploadToS3Cloud.php 
1.c) Get all files on amazon (for provided folder) and check that all files are stored locally too, if not download them 
    - ajax call to checkDownloadedFromS3.php 
    - ajax call to downloadFromS3Cloud.php 
1.d) Local log to /log every download files and upload directory 
   - inside downloadFromS3Cloud.php & uploadToS3Cloud.php
2) You have a directory with sql files, that are named like “change_20171023_j.sql”, “change_20171024_j.sql”, “change_20171029_j.sql. Write a script, that bundle files into one big sql file based on dates in names and run as SQL query on database. Move all files that were bundled into “applied/[YYYYMMDD]” folder. Script should return success if everything is ok and return exception with a message if error occurred. If error occurred in sql, make rollback 
    - ajax call to SQLFiles.php


-- Practical
1) Write a parser for provided data, so you get a valid associative array of all the rows
    - ajax call to parserData.php
2) Create appropriate database table and write all the rows into it, be careful there could be a lot of rows
    - ajax call to createTable.php
3) Generate fake Names and Surnames for all of the Buyers in separated table, one for each buyer.
    ajax call to createTableNames.php 
4) For getting best selling model per client
    - a) php getBestSellingModel.php or php getBestSellingModel.php BuyerID
    - c) php getBestSellingModelThreeMonths.php -e YYYY-MM-DD -s YYYY-MM-DD 
        where e - enddate s - specific date
        
          