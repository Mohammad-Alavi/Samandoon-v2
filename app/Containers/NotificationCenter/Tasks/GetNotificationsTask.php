<?php

namespace App\Containers\NotificationCenter\Tasks;

use App\Containers\User\Models\User;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetNotificationsTask extends Task
{
    /**
     * @param User $user
     *
     * @return LengthAwarePaginator
     */
    public function run(User $user)
    {
        $unreadNotifications = $user->notifications()->paginate(100);
        $user->notifications->markAsRead();
        return $unreadNotifications;
    }
}
