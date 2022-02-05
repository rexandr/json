<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
    <?php foreach (userContacts() as $value) { ?>
        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg"
               aria-label="Пример .form-control-lg" value="<?= $value ?>">
    <?php } ?>
</div>
</body>
</html>


<?php
function userContacts()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
    }

    $userAccess = [];

    foreach ($jsonArray['contacts'] as $contact) {
        $user = array_search($contact['user'], array_column($jsonArray['users'], 'id'));
        $role = array_search($jsonArray['users'][$user]['role'], array_column($jsonArray['roles'], 'id'));
        $permission = array_search($jsonArray['users'][$user]['permissions'], array_column($jsonArray['permissions'], 'id'));

        $userAccess[] = $jsonArray['users'][$user]['name'] . ', ' . $contact['firstName'] . ' ' . $contact['lastName'] . ', ' .
            $jsonArray['roles'][$role]['roleName'] . ' - ' . $jsonArray['permissions'][$permission]['value'];
    }

    return $userAccess;
}
