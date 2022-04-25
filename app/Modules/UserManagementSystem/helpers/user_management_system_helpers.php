<?php

if (! function_exists('user')) {
    /**
     * Get the currently logged-in user.
     *
     * @return \Modules\UserManagementSystem\Models\User|null
     */
    function user()
    {
        return auth()->user();
    }
}
