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

// all functions pertaining to BANDS
function getAllBands()
{
    global $db;

    $query = "select * from band;";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); 
    $statement->closeCursor();
    return $results;
}


function addBand($bandname, $genre, $phone, $instagram)
{
    
    global $db;
    


    $query = "insert into band(band_id, name, genre, phoneNumber, instagram) value (:id, :bandname , :genre, :phone, :instagram) ";
    $statement = $db->prepare($query);
    
    $statement->bindValue(':id', rand(10,10000));
    $statement->bindValue(':bandname', $bandname);
    $statement->bindValue(':genre', $genre);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':instagram', $instagram);


    $statement->execute();

    $statement->closeCursor();

}

function deleteBand($band_id)
{

    global $db;

    $query = "delete from band where band.band_id = :band_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':band_id', $band_id);
    $statement->execute();
    $statement->closeCursor();

}

function updateBandByID($bandname, $genre, $phone, $instagram)
{
    global $db;
    $query = "update band set genre=:genre, phoneNumber=:phone, instagram=:instagram where band.name=:bandname";
    $statement = $db->prepare($query);
    //echo($bandname);
    $statement->bindValue(':bandname', $bandname);
    $statement->bindValue(':genre', $genre);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':instagram', $instagram);

    $statement->execute();
    $statement->closeCursor();
}

function performBandSearch($string)
{
    
    global $db;
    $query = "SELECT * FROM band WHERE name LIKE :bandname OR phoneNumber LIKE :phone OR genre LIKE :genre OR instagram LIKE :instagram";

    $statement = $db->prepare($query);
    
    $statement->bindValue(':bandname', '%' . $string . '%');
    $statement->bindValue(':genre', '%' . $string . '%');
    $statement->bindValue(':phone', '%' . $string . '%');
    $statement->bindValue(':instagram', '%' . $string . '%');


    $statement->execute();
    $results = $statement->fetchAll(); 
    $statement->closeCursor();
    return $results;
}

function getMembersByBandID($band_id)
{
    global $db;

    $query = 'select distinct band_member.name, band_member.instrument from band_member, plays_in, band where plays_in.account_id = band_member.account_id and plays_in.band_id = band.band_id and band.band_id = :band_id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':band_id', $band_id);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}



// Band Member Functions
function getAllBandMembers()
{
    global $db;

    $query = "select * from band_member;";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); 
    $statement->closeCursor();
    return $results;
}


// Gig Functions

function getAllGigsInfo()
{
    global $db;
    $query = "select gig.gig_id, gig.name, start_time, venue.name as vname, address from gig, venue where gig.venue_id = venue.venue_id;";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function searchGigsByName($searchTerm) {


    global $db;
    $query = "select gig.name, start_time, venue.name as vname, address from gig, venue where gig.venue_id = venue.venue_id and (gig.name LIKE :searchTerm OR venue.name LIKE :searchTerm OR address LIKE :searchTerm);";
    //$query = "SELECT * FROM gig WHERE name LIKE :searchTerm";
    $statement = $db->prepare($query);
    $statement->bindValue(':searchTerm', "%$searchTerm%", PDO::PARAM_STR);
    $statement->execute();


    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement->closeCursor();
    return $result;
}

function getVenuesByCoordinatorId($coordinator_id)
{
    global $db;
    $query = "SELECT venue.venue_id, venue.name FROM venue, coordinates, venue_coordinator where venue.venue_id = coordinates.venue_id and coordinates.account_id = venue_coordinator.account_id and venue_coordinator.account_id = :coordinator_id;";
    $statement = $db->prepare($query);
    $statement->bindValue(':coordinator_id', $coordinator_id);
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function addGig($name, $start_time, $end_time, $venue_id)
{

    global $db;
    try {
        $query = 'INSERT INTO gig VALUES (:id, :name, :start_time, :end_time, :venue_id)';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', rand(10, 10000));
        $statement->bindValue(':name', $name);
        $statement->bindValue(':start_time', $start_time);
        $statement->bindValue(':end_time', $end_time);
        $statement->bindValue(':venue_id', $venue_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

}

function deleteGig($gigIdToDelete)
{
    global $db;
    $query = "delete from gig where gig_id = :gig_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":gig_id", $gigIdToDelete);
    $statement->execute();
    $statement->closeCursor();
}


function getAllOpenGigs()
{
    global $db;
    $query = "SELECT gig_id, gig_info.name, start_time, venue.venue_id, venue.name as vname, venue.address FROM ( SELECT gig.gig_id, gig.name, gig.start_time, gig.venue_id FROM gig LEFT JOIN performs_at ON gig.gig_id = performs_at.gig_id WHERE performs_at.gig_id IS NULL ) AS gig_info JOIN venue ON venue.venue_id = gig_info.venue_id;";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function getAllFilledGigs()
{
    global $db;
    $query = "select gig.gig_id, gig.name as gname, gig.start_time, band.band_id, band.name as bname, venue.name as vname, venue.venue_id, venue.address from gig, performs_at, band, venue where gig.gig_id = performs_at.gig_id and performs_at.band_id = band.band_id and gig.venue_id = venue.venue_id;";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}


// Venues Functions
function getAllVenues()
{
    global $db;
    $query = 'select * from venue';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

?>