<?php
function addFriend($friendname, $major, $year)
{
    // global - look for variable outside of this file
    // db - variable name we made for database in connect-db
    global $db;
    // insert data into table
    // $query = "insert into friends value ('" . $friendname . "','" . $major . "'," . $year . ") "; //friend name and major have to be in quotes because they are strings
    // $db->query($query);  // compile and exequite querey immediately // bad for SQL injection

    // good way
    $query = "insert into friends value (:friendname , :major, :year) ";
    // prepare:
    // 1. prepare (compile)
    // 2. bindValue and execute
    
    // prepare 
    $statement = $db->prepare($query);
    // bindValue
    $statement->bindValue(':friendname', $friendname);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':year', $year);
    // execute
    $statement->execute();

    // release hold so other people can make use of traffic
    $statement->closeCursor();
}

function getAllFriends()
{
    global $db;

    $query = "select * from friends;";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); 
    $statement->closeCursor();
    return $results;
}

function updateFriendByName($name, $major, $year)
{
    global $db;
    $query = "update friends set major=:major, year=:year where name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':major', $major);
    $statement->bindValue(':year', $year);
    $statement->execute();
    $statement->closeCursor();
}

function deleteFriend($name)
{
    global $db;
    $query = "delete from friends where name=:name";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();
}

?>