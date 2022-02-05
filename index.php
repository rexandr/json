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

    foreach ($jsonArray['contacts'] as $contact) {
        $user = array_search($contact['user'], array_column($jsonArray['users'], 'id'));
        $role = array_search($jsonArray['users'][$user]['role'], array_column($jsonArray['roles'], 'id'));
        $permission = array_search($jsonArray['users'][$user]['permissions'], array_column($jsonArray['permissions'], 'id'));
        echo $jsonArray['users'][$user]['name'] . ', ' . $contact['firstName'] . ' ' . $contact['lastName'] . ', ' .
            $jsonArray['roles'][$role]['roleName'] . ' - ' . $jsonArray['permissions'][$permission]['value']. '<br>';
    }
}

userContacts();