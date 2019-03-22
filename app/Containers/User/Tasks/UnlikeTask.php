<?php

namespace App\Containers\User\Tasks;

use Apiato\Core\Abstracts\Exceptions\Exception;
use App\Containers\Content\Models\Content;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Facades\DB;

class UnlikeTask extends Task
{
    /**
     * @param User    $user
     * @param Content $content
     *
     * @return Content
     * @throws \Exception
     */
    public function run(User $user, Content $content)
    {
        try {
            DB::beginTransaction();
            $user->unlike($content);
        } catch (Exception $exception) {
            DB::rollBack();
            throw new UpdateResourceFailedException('Failed to unlike the specified resource.');
        }
        DB::commit();

        return $content->refresh();
    }
}
