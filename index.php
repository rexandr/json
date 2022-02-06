<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="/">Home</a>

<h1>Roles</h1>
<?php foreach (rolesRead() as $values) { ?>
    <?= $values['roleName'] ?><br>
<?php } ?>

<form action="" method="post">
    <h3>Add role</h3>
    <input type="text" name="role">
    <input type="submit" value="Add"><br><br>
</form>

<h1>Permissions</h1>
<?php foreach (permissionsRead() as $values) { ?>
    <?= $values['value'] ?><br>
<?php } ?>

<form action="" method="post">
    <h3>Add role</h3>
    <input type="text" name="permission">
    <input type="submit" value="Add"><br><br>
</form>
</body>
</html>

<?php

userContacts();

function userContacts()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
    }

    if (isset($_POST['role']))
    {
        $id = count($jsonArray['roles'])+1;
        $jsonArray['roles'][]=['id'=>$id, 'roleName'=>$_POST['role']];
        file_put_contents('test.json', json_encode($jsonArray));
        unset($_POST);
    }

    if (isset($_POST['permission']))
    {
        $id = count($jsonArray['permissions'])+1;
        $jsonArray['permissions'][]=['id'=>$id, 'value'=>$_POST['permission']];
        file_put_contents('test.json', json_encode($jsonArray));
        unset($_POST);
    }

    foreach ($jsonArray['contacts'] as $contact) {
        $user = array_search($contact['user'], array_column($jsonArray['users'], 'id'));
        $role = array_search($jsonArray['users'][$user]['role'], array_column($jsonArray['roles'], 'id'));
        $permission = array_search($jsonArray['users'][$user]['permissions'], array_column($jsonArray['permissions'], 'id'));
        echo $jsonArray['users'][$user]['name'] . ', ' . $contact['firstName'] . ' ' . $contact['lastName'] . ', ' .
            $jsonArray['roles'][$role]['roleName'] . ' - ' . $jsonArray['permissions'][$permission]['value']. '<br>';
    }
}

function rolesRead()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
        $roles=$jsonArray['roles'];
    }
    $roles=$jsonArray['roles'];

    return $roles;
}

function permissionsRead()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
        $permissions=$jsonArray['permissions'];
    }

    return $permissions;
}

