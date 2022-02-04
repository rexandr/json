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
        $key = array_search($user['role'], array_column($jsonArray['roles'], 'id'));
        echo $user['name']. $jsonArray['roles'][$key]['roleName'].'<br>';

    }
}

userContacts();