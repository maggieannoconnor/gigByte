<?php

function getRoleAttributes($role)
{
    // Define role-specific attributes
    $attributes = [];

    switch ($role) {
        case 'band_member':
            $attributes = ['name', 'phoneNumber', 'email', 'instrument'];
            break;
        case 'venue_coordinator':
            $attributes = ['name', 'phoneNumber', 'email', 'title', 'budget'];
            break;
        // Add more cases for other roles as needed
        default:
            // Handle the default case or unknown roles
            break;
    }

    return $attributes;
}

?>
