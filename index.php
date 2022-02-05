<?php
function userContacts()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
    }

    echo '<pre>';
    print_r($jsonArray);
    echo '</pre>';

    foreach ($jsonArray['users'] as $user) {
        $role = array_search($user['role'], array_column($jsonArray['roles'], 'id'));
        $contact = array_search($user['id'], array_column($jsonArray['contacts'], 'user'));  //repeating check

        echo $user['name']. $jsonArray['roles'][$role]['roleName'].$jsonArray['contacts'][$role]['firstName'].
            $jsonArray['contacts'][$role]['lastName'].'<br>';

    }
}

userContacts();