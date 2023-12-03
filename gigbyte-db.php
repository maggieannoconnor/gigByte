<?php


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

    $query = 'select distinct band_member.account_id, band_member.name, band_member.instrument from band_member, plays_in, band where plays_in.account_id = band_member.account_id and plays_in.band_id = band.band_id and band.band_id = :band_id;';
    $statement = $db->prepare($query);
    $statement->bindValue(':band_id', $band_id);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function getAllSortedBands()
{
    global $db;
    $query = 'select * from band ORDER BY avg_rating DESC;';
    $statement = $db->prepare($query);
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

function getMemberById( $id )
{
    global $db;
    $query = "select * from band_member where account_id=:id;";
    $statement = $db->prepare($query);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}
function addBandMemberToBand($member_id, $band_id)
{
    global $db;
    $query = "insert into plays_in value (:member_id, :band_id);";
    $statement = $db->prepare($query);
    $statement->bindValue(":member_id", $member_id);
    $statement->bindValue(":band_id", $band_id);
    $statement->execute();
    $results = $statement->fetchAll(); 
    $statement->closeCursor();
    return $results;
}

function removeBandMemberFromBand($member_id, $band_id)
{
    global $db;
    $query = "delete from plays_in where account_id=:member_id and band_id=:band_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":member_id", $member_id);
    $statement->bindValue(":band_id", $band_id);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function addMembersToPlayedWith($member_id1, $member_id2)
{
    global $db;
    $query = "insert into played_with values (:member_id1, :member_id2), (:member_id2, :member_id1)";
    $statement = $db->prepare($query);
    $statement->bindValue(":member_id1", $member_id1);
    $statement->bindValue(":member_id2", $member_id2);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

function getMemberPlayedWithByMemberId($member_id)
{
    global $db;
    $query = "SELECT DISTINCT * FROM played_with, band_member
    WHERE played_with.account_id1 = :member_id AND played_with.account_id2 = band_member.account_id;";
    $statement = $db->prepare($query);
    $statement->bindValue(":member_id", $member_id);
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


function addBandToGig($band_id, $gig_id)
{
    global $db;
    $query = "insert into performs_at(band_id, gig_id) value(:band_id, :gig_id)";
    $statement = $db->prepare($query);
    $statement->bindValue(":band_id", $band_id);
    $statement->bindValue(":gig_id", $gig_id);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function removeBandFromGig($gig_id)
{
    global $db;
    $query = "delete from performs_at where gig_id=:gig_id";
    $statement = $db->prepare($query);
    $statement->bindValue(":gig_id", $gig_id);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function getAllReviews()
{
    global $db;
    $query = "SELECT band.name as bname, Rating, reviews.Comments, gig.name as gname, venue_coordinator.name as vname FROM reviews, venue_coordinator, gig, band WHERE reviews.account_id = venue_coordinator.account_id AND reviews.band_id = band.band_id AND reviews.gig_id = gig.gig_id;";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;

}

function addReview($account_id, $band_id, $gig_id, $rating, $comment)
{
    global $db;
    $query = "insert into reviews value(:account_id, :band_id, :gig_id, :rating, :comment)";
    $statement = $db->prepare($query);
    $statement->bindValue(":account_id", $account_id);
    $statement->bindValue(":band_id", $band_id);
    $statement->bindValue(":gig_id", $gig_id);
    $statement->bindValue(":rating", $rating);
    $statement->bindValue(":comment", $comment);
    $statement->execute();
    $statement->closeCursor();

}

function updateAverageRating($band_id)
{
    global $db;
    $query = "SET @p0=:band_id; CALL `calculateAvgRating`(@p0);";
    $statement = $db->prepare($query);
    $statement->bindValue(":band_id", $band_id);
    $statement->execute();
    $statement->closeCursor();
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

function getAllVenueCoordinators()
{
    global $db;
    $query = 'select * from venue_coordinator';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    return $result;
}

function addVenue($name, $address)
{
    global $db;
    $query = "insert into venue(venue_id, name, address) value (:id, :name , :address) ";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', rand(10,10000));
    $statement->bindValue(':name', $name);
    $statement->bindValue(':address', $address);
    $statement->execute();
    $statement->closeCursor();
}

function updateVenue($venue_id, $name, $address)
{
    global $db;
    $query = "update venue set name=:name, address=:address where venue_id=:venue_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':venue_id', $venue_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':address', $address);
    $statement->execute();
    $statement->closeCursor();
}

function deleteVenue($venue_id)
{
    global $db;
    $query = "delete from venue where venue_id=:venue_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':venue_id', $venue_id);
    $statement->execute();
    $statement->closeCursor();
}



// User Functions
function getUserAttributes($id)
{
    global $db;

    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $success = $statement->execute();

    if (!$success) {
        return false; // Check
    }

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    if (!$user) {
        return false; // No user found
    }

    // Get role attributes
    $roleAttributes = getRoleAttributes($user['role']);

    // Fetch role values from specific tables
    $query = "SELECT * FROM {$user['role']} WHERE account_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $success = $statement->execute();

    if ($success) {
        $roleDetails = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
    } else {
        return false; // Check success
    }

    // Merge the array
    $userAttributes = array_merge($user, $roleDetails);

    return $userAttributes;
}

function getRoleAttributes($role)
{
    $attributes = [];

    switch ($role) {
        case 'band_member':
            $attributes = ['name', 'phoneNumber', 'email', 'instrument'];
            break;
        case 'venue_coordinator':
            $attributes = ['name', 'phoneNumber', 'email', 'title', 'budget'];
            break;
        default:
            // Break if none
            break;
    }

    return $attributes;
}

function updateBandMember($id, $name, $phoneNumber, $email, $instrument)
{
    global $db;

    $query = "UPDATE band_member SET name = :name, phoneNumber = :phoneNumber, email = :email, instrument = :instrument WHERE account_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':instrument', $instrument);
    $statement->execute();
}

function updateVenueCoordinator($id, $name, $phoneNumber, $email, $title, $budget)
{
    global $db;

    $query = "UPDATE venue_coordinator SET name = :name, phoneNumber = :phoneNumber, email = :email, title = :title, budget = :budget WHERE account_id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':budget', $budget);
    $statement->execute();
}


?>