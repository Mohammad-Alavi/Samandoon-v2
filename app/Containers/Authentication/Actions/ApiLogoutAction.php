<?php

namespace App\Containers\Authentication\Actions;

use App\Containers\FCM\Models\FCMToken;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Exceptions\Exception;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Lcobucci\JWT\Parser;

/**
 * Class ApiLogoutAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ApiLogoutAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  bool
     */
    public function run(DataTransporter $data): bool
    {
        $id = App::make(Parser::class)->parse($data->bearerToken)->getHeader('jti');

        DB::table('oauth_access_tokens')->where('id', '=', $id)->update(['revoked' => true]);

        try {
            if (array_key_exists('device_type', $data) && $data['device_type'] == 'ios') {
                FCMToken::where([
                    'apns_id' => $data['token'],
                ])->delete();
            }
            else {
                FCMToken::where([
                    'android_fcm_token' => $data['token'],
                ])->delete();
            }

        } catch (Exception $exception) {
            throw new CreateResourceFailedException('Failed to store new Token with error: ' . $exception->getMessage());
        }

        return true;
    }
}
