<?php
require_once "model/user.php";
require "access.php";


// security



function getAccess(string $action) {
    global $accessList;

    if (!isset($accessList[$action])) {
        return false;
    }

    $requiredRoles = $accessList[$action];

    // accès libre si tableau vide
    if (empty($requiredRoles)) return true;

    if (isset($_SESSION['user']) && in_array($_SESSION['user']->getStatus(), $requiredRoles)) {
        return true;
    }

    return false;
}


?>