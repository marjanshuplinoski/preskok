<?php
/**
 * Created by PhpStorm.
 * User: Marjan
 * Date: 4/12/2018
 * Time: 8:49 PM
 */


function createTableNames()
{
    include_once 'db.php';
    include_once 'parserData.php';
    $data = parserData(21);
    $db = getDbConnection();
    $getTable = mysqli_query($db, "SHOW TABLES LIKE 'practical_data_buyers'");


    if (mysqli_num_rows($getTable) > 0) {
        //do nothing
    } else {

        $table = "CREATE TABLE practical_data_buyers ( id INT(5) NOT NULL , firstname VARCHAR(255) NOT NULL , lastname VARCHAR(255) NOT NULL );";
        if ($db->query($table) === TRUE) {
            echo "Table practical_data_buyers created successfully";
        } else {
            echo "Error creating table practical_data_buyers: " . $db->error;
        }
    }
    foreach ($data as $h) {
        $uniqueBuyerIDList[] = $h['BuyerID'];
    }
    $uniqueBuyerID = array_unique($uniqueBuyerIDList);

    array_chunk($uniqueBuyerID, 100, true);
//
    foreach ($uniqueBuyerID as $unique) {
        if (!checkIfExists($db, $unique)) {
            $firstName = randNames();
            $lastName = randNames(2);
            $insert = "INSERT INTO practical_data_buyers (ID,FIRSTNAME,LASTNAME) VALUES ($unique,'{$firstName}','{$lastName}')";
            if (!beginTransaction($insert, null, null, 33)) {
                break;
            }
        } else
            echo 'Already exists in db with ID: ' . $unique . '<br>';
    }
    $db->close();
}

function checkIfExists($db, $id)
{

    $query = "SELECT * from practical_data_buyers where id ='$id'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;

}

function randNames($name = 1)
{
    if ($name == 1) {
        $names = $a = array('Noah', 'Liam', 'Mason', 'Jacob', 'William', 'Ethan', 'James', 'Alexander', 'Michael', 'Benjamin', 'Elijah', 'Daniel', 'Aiden', 'Logan', 'Matthew', 'Lucas', 'Jackson', 'David', 'Oliver', 'Jayden', 'Joseph', 'Gabriel', 'Samuel', 'Carter', 'Anthony', 'John', 'Dylan', 'Luke', 'Henry', 'Andrew', 'Isaac', 'Christopher', 'Joshua', 'Wyatt', 'Sebastian', 'Owen', 'Caleb', 'Nathan', 'Ryan', 'Jack', 'Hunter', 'Levi', 'Christian', 'Jaxon', 'Julian', 'Landon', 'Grayson', 'Jonathan', 'Isaiah', 'Charles', 'Thomas', 'Aaron', 'Eli', 'Connor', 'Jeremiah', 'Cameron', 'Josiah', 'Adrian', 'Colton', 'Jordan', 'Brayden', 'Nicholas', 'Robert', 'Angel', 'Hudson', 'Lincoln', 'Evan', 'Dominic', 'Austin', 'Gavin', 'Nolan', 'Parker', 'Adam', 'Chase', 'Jace', 'Ian', 'Cooper', 'Easton', 'Kevin', 'Jose', 'Tyler', 'Brandon', 'Asher', 'Jaxson', 'Mateo', 'Jason', 'Ayden', 'Zachary', 'Carson', 'Xavier', 'Leo', 'Ezra', 'Bentley', 'Sawyer', 'Kayden', 'Blake', 'Nathaniel', 'Ryder', 'Theodore', 'Elias');
        $name = array_rand($names);
        return $names[$name];
    } else {
        $surnames = array('Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor', 'Anderson', 'Thomas', 'Jackson', 'White', 'Harris', 'Martin', 'Thompson', 'Garcia', 'Martinez', 'Robinson', 'Clark', 'Rodriguez', 'Lewis', 'Lee', 'Walker', 'Hall', 'Allen', 'Young', 'Hernandez', 'King', 'Wright', 'Lopez', 'Hill', 'Scott', 'Green', 'Adams');
        $lastName = array_rand($surnames);
        return $surnames[$lastName];
    }
}
