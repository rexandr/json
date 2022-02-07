<?php
class UserContactsList
{

    public $file = 'test.json';
    public $toString = [];

    function userContacts()
    {
        if (file_exists($this->file)) {
            $json = file_get_contents($this->file);
            $jsonArray = json_decode($json, true);
        }

        if (isset($_POST['role'])) {
            $id = count($jsonArray['roles']) + 1;
            $jsonArray['roles'][] = ['id' => $id, 'roleName' => $_POST['role']];
            $this->putContent($jsonArray);
            unset($_POST);
        }

        if (isset($_POST['permission'])) {
            $id = count($jsonArray['permissions']) + 1;
            $jsonArray['permissions'][] = ['id' => $id, 'value' => $_POST['permission']];
            $this->putContent($jsonArray);
            unset($_POST);
        }

        if (isset($_POST['users'])) {

            $id = count($jsonArray['users']) + 1;
            $jsonArray['users'][] = ['id' => $id, 'name' => $_POST['users'], 'role' => $_POST['roles'], 'permissions' => $_POST['permissions']];
            $this->putContent($jsonArray);
            unset($_POST);
        }

        if (isset($_POST['lastName'])) {

            $jsonArray['contacts'][] = ['user' => $_POST['user'], 'firstName' => $_POST['firstName'], 'lastName' => $_POST['lastName']];
            $this->putContent($jsonArray);
            unset($_POST);
        }

        foreach ($jsonArray['contacts'] as $contact) {
            $user = array_search($contact['user'], array_column($jsonArray['users'], 'id'));
            $role = array_search($jsonArray['users'][$user]['role'], array_column($jsonArray['roles'], 'id'));
            $permission = array_search($jsonArray['users'][$user]['permissions'], array_column($jsonArray['permissions'], 'id'));

            $this->toString[] =  $jsonArray['users'][$user]['name'] . ', ' . $contact['firstName'] . ' ' . $contact['lastName'] . ', ' .
                $jsonArray['roles'][$role]['roleName'] . ' - ' . $jsonArray['permissions'][$permission]['value'] . '<br>';
        }

        return $jsonArray;
    }

    function toString()
    {
        return $this->toString;
    }

    function putContent($content)
    {
        file_put_contents($this->file, json_encode($content));
    }

    function rolesRead($list)
    {

        $roles = $list['roles'];

        return $roles;
    }

    function permissionsRead($list)
    {
        $permissions = $roles = $list['permissions'];

        return $permissions;
    }

    function usersRead($list)
    {
        $users = $list['users'];

        return $users;
    }

    function contactRead($list)
    {
        $contact = $list['contacts'];

        return $contact;
    }

}