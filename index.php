<?php
function userContacts()
{
    if (file_exists('test.json')){
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
    }
    
    echo '<pre>';
    print_r($jsonArray);
    echo '</pre>';

    foreach ($jsonArray['users'] as $user)
    {
        echo $user['name'].'<br>';
    }

}

userContacts();