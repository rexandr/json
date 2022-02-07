<?php

include_once 'UserContactsList.php';

$object = new UserContactsList();
$list = $object->userContacts();


?>


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
    <?php foreach ($object->toString as $values) { ?>
        <?= $values ?>
    <?php } ?>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Roles</h1>
            <?php foreach ($object->rolesRead($list) as $values) { ?>
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
            <?php foreach ($object->permissionsRead($list) as $values) { ?>
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
            <?php foreach ($object->usersRead($list) as $values) { ?>
                Name  - <?= $values['name'] ?><br>
            <?php } ?>

            <form action="" method="post">
                <h3>Add user</h3>
                <div>
                    <h6>User's permission</h6>
                    <?php foreach ($object->permissionsRead($list) as $values) { ?>
                        <input type="radio" id="permission" name="permissions" value="<?= $values['id'] ?>">
                        <label for="permission"><?= $values['value'] ?></label>
                        <br>
                    <?php } ?>
                </div>

                <div>
                    <h6>User's role</h6>
                    <?php foreach ($object->rolesRead($list) as $values) { ?>
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
            <?php foreach ($object->contactRead($list) as $values) { ?>
                <?= $values['firstName'] ?> <?= $values['lastName'] ?><br>
            <?php } ?>

            <form action="" method="post">
                <h3>Add contact</h3>
                <div>
                    <h6>Users</h6>
                    <?php foreach ($object->usersRead($list) as $values) { ?>
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


