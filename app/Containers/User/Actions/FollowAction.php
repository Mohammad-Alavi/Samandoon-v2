<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\FCM\Models\FCMToken;
use App\Containers\User\Models\User;
use App\Containers\User\Notifications\UserFollowedNotification;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Validation\UnauthorizedException;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

class FollowAction extends Action
{
    /**
     * @param DataTransporter $dataTransporter
     *
     * @return mixed
     * @throws \Throwable
     */
    public function run(DataTransporter $dataTransporter)
    {
        /** @var User $AuthenticatedUser */
        $AuthenticatedUser = Apiato::call('Authentication@GetAuthenticatedUserTask');
        /** @var User $targetUser */
        $targetUser = Apiato::call('User@FindUserByIdTask', [$dataTransporter->id]);

        // throw if user is trying to follow itself
        throw_if($targetUser->id == $AuthenticatedUser->id, UnauthorizedException::class, 'User cannot follow itself');

        $result = Apiato::call('User@FollowTask', [$AuthenticatedUser, $targetUser]);

        // send notification
        $targetUser->notifyNow(new UserFollowedNotification($AuthenticatedUser), ['database']);

        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder('سمندون');
        $notificationBuilder->setBody('[' . $AuthenticatedUser->nick_name . ']' . ' شما را دنبال کرد')
            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $tokens = FCMToken::where('user_id', $targetUser->id)->pluck('android_fcm_token')->toArray();
        if (!empty($tokens)) {

            $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

            $downstreamResponse->numberSuccess();
            $downstreamResponse->numberFailure();
            $downstreamResponse->numberModification();

            //return Array - you must remove all this tokens in your database
            $downstreamResponse->tokensToDelete();

            //return Array (key : oldToken, value : new token - you must change the token in your database )
            $downstreamResponse->tokensToModify();

            //return Array - you should try to resend the message to the tokens in the array
            $downstreamResponse->tokensToRetry();

            // return Array (key:token, value:errror) - in production you should remove from your database the tokens
        }


        return $result;
    }
}
