<?php

namespace App\Containers\NotificationCenter\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;

class GetNotificationsTask extends Task
{
    public function run($limit, User $user)
    {
        $unreadNotifications = $user->unreadNotifications()->paginate($limit ? $limit : 20);
        $user->notifications->markAsRead();
        return $unreadNotifications;
    }
}
