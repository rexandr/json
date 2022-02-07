<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Json</title>
</head>
<body>

<a href="/">Home</a>

<div class="container">
    <?= userContacts(); ?>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Roles</h1>
            <?php foreach (rolesRead() as $values) { ?>
                <?= $values['roleName'] ?><br>
            <?php } ?>

            <form action="" method="post">
                <h3>Add role</h3>
                <input type="text" name="role">
                <input type="submit" value="Add"><br><br>
            </form>
        </div>
        <div class="col">
            <h1>Permissions</h1>
            <?php foreach (permissionsRead() as $values) { ?>
                <?= $values['value'] ?><br>
            <?php } ?>

            <form action="" method="post">
                <h3>Add permission</h3>
                <input type="text" name="permission">
                <input type="submit" value="Add"><br><br>
            </form>
        </div>
        <div class="col">
            <h1>Users</h1>
            <?php foreach (usersRead() as $values) { ?>
                Name  - <?= $values['name'] ?><br>
            <?php } ?>

            <form action="" method="post">
                <h3>Add user</h3>
                <div>
                    <h6>User's permission</h6>
                    <?php foreach (permissionsRead() as $values) { ?>
                        <input type="radio" id="permission" name="permissions" value="<?= $values['id'] ?>">
                        <label for="permission"><?= $values['value'] ?></label>
                        <br>
                    <?php } ?>
                </div>

                <div>
                    <h6>User's role</h6>
                    <?php foreach (rolesRead() as $values) { ?>
                        <input type="radio" id="role" name="roles" value="<?= $values['id'] ?>">
                        <label for="role"><?= $values['roleName'] ?></label>
                        <br>
                    <?php } ?>
                </div>

                <input type="text" name="users">
                <input type="submit" value="Add"><br><br>
            </form>
        </div>
        <div class="col">
            <h1>Contacts</h1>
            <?php foreach (contactRead() as $values) { ?>
                <?= $values['firstName'] ?> <?= $values['lastName'] ?><br>
            <?php } ?>

            <form action="" method="post">
                <h3>Add contact</h3>
                <div>
                    <h6>Users</h6>
                    <?php foreach (usersRead() as $values) { ?>
                        <input type="radio" id="user" name="user" value="<?= $values['id'] ?>">
                        <label for="role"><?= $values['name'] ?></label>
                        <br>
                    <?php } ?>
                </div>
                FirstName <input type="text" name="firstName">
                LastName <input type="text" name="lastName">
                <input type="submit" value="Add"><br><br>
            </form>
        </div>
    </div>
</div>


</body>
</html>


<?php

$j = '';

function userContacts()
{
    if (file_exists('test.json')) {
        $json = file_get_contents('test.json');
        $jsonArray = json_decode($json, true);
    }

    if (isset($_POST['role'])) {
        $id = count($jsonArray['roles']) + 1;
        $jsonArray['roles'][] = ['id' => $id, 'roleName' => $_POST['role']];
        putContent($jsonArray);
        unset($_POST);
    }

    if (isset($_POST['permission'])) {
        $id = count($jsonArray['permissions']) + 1;
        $jsonArray['permissions'][] = ['id' => $id, 'value' => $_POST['permission']];
        putContent($jsonArray);
        unset($_POST);
    }

    if (isset($_POST['users'])) {

        $id = count($jsonArray['users']) + 1;
        $jsonArray['users'][] = ['id' => $id, 'name' => $_POST['users'], 'role' => $_POST['roles'], 'permissions' => $_POST['permissions']];
        putContent($jsonArray);
        unset($_POST);
    }

    if (isset($_POST['lastName'])) {

        $jsonArray['contacts'][] = ['user' => $_POST['user'], 'firstName' => $_POST['firstName'], 'lastName' => $_POST['lastName']];
        putContent($jsonArray);
        unset($_POST);
    }

    foreach ($jsonArray['contacts'] as $contact) {
        $user = array_search($contact['user'], array_column($jsonArray['users'], 'id'));
        $role = array_search($jsonArray['users'][$user]['role'], array_column($jsonArray['roles'], 'id'));
        $permission = array_search($jsonArray['users'][$user]['permissions'], array_column($jsonArray['permissions'], 'id'));
        echo $jsonArray['users'][$user]['name'] . ', ' . $contact['firstName'] . ' ' . $contact['lastName'] . ', ' .
            $jsonArray['roles'][$role]['roleName'] . ' - ' . $jsonArray['permissions'][$permission]['value'] . '<br>';
    }

    $GLOBALS['j'] = $jsonArray;
}

function putContent($content)
{
    file_put_contents('test.json', json_encode($content));
}

function rolesRead()
{

    $roles = $GLOBALS['j']['roles'];

    return $roles;
}

function permissionsRead()
{
    $permissions = $roles = $GLOBALS['j']['permissions'];

    return $permissions;
}

function usersRead()
{
    $users = $GLOBALS['j']['users'];

    return $users;
}

function contactRead()
{
    $contact = $GLOBALS['j']['contacts'];

    return $contact;
}

