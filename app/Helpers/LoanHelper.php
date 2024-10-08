<?php
if (!function_exists('getLocationName')) {
    function getLocationName($locationId)
    {
        $location = App\Models\Branch::find($locationId); // Adjust the model namespace and name as per your application
        if ($location) {
            return $location->branch_name; // Assuming 'name' is the attribute in your 'Location' model
        }
        return null; // Return null if location with the given ID is not found
    }
}


if (!function_exists('getRoleName')) {
    function getRoleName($roleId)
    {
        $role = App\Models\Roles::find($roleId); // Adjust the model namespace and name as per your application
        if ($role) {
            return $role->role_name; // Assuming 'name' is the attribute in your 'Location' model
        }
        return null; // Return null if location with the given ID is not found
    }
}

if (!function_exists('getUserName')) {
    function getUserName($userId)
    {
        $user = App\Models\User::find($userId); // Adjust the model namespace and name as per your application
        if ($user) {
            return $user->initial . ' ' . $user->first_name . ' ' . $user->last_name; // Assuming 'name' is the attribute in your 'Location' model
        }
        return null; // Return null if location with the given ID is not found
    }
}
