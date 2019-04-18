<?php

/**
 * @apiGroup           NotificationCenter
 * @apiName            getNotifications
 *
 * @api                {GET} /v1/user/notifications Get User Notifications
 * @apiDescription     Get the current user notifications
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": [
    {
        "id": "507e3f86-b0ee-40b2-b6b2-6d9be648429a",
      "type": "App\\Containers\\Content\\Notifications\\RepostNotification",
      "user": {
        "object": "User",
        "id": "qmv7dk48x5b690wx",
        "first_name": null,
        "last_name": null,
        "nick_name": "محمد علوی ایرانسل",
        "description": "من یه گوگول مگول ام",
        "email": null,
        "username": null,
        "public_phone": "+989391***907",
        "is_phone_confirmed": true,
        "is_email_confirmed": false,
        "gender": "male",
        "birth": {
            "date": "2014-10-20 00:00:00.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "points": 0,
        "is_subscription_expired": true,
        "subscription_expired_at": {
            "date": "2019-04-18 04:25:41.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "images": {
            "avatar": "http:\/\/api.samandoon.local\/v1\/storage\/2\/2bc7be5602b3719147ad7f4f2c0ee587.png",
          "avatar_thumb": "http:\/\/api.samandoon.local\/v1\/storage\/2\/conversions\/2bc7be5602b3719147ad7f4f2c0ee587-thumb.png"
        },
        "stats": {
            "followings_count": 1,
          "followers_count": 0,
          "content_count": 12,
          "followed_by_me": false,
          "following_me": true
        },
        "social_activity_tendency": {
            "subject_count": [
            {
                "subject": "علمی",
              "count": 12,
              "color": "#FF0000"
            }
          ]
        },
        "created_at": {
            "date": "2019-04-18 04:26:06.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "updated_at": {
            "date": "2019-04-18 04:36:30.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "readable_created_at": "47 minutes ago",
        "readable_updated_at": "37 minutes ago"
      },
      "object_id": "qmv7dk48x5b690wx",
      "object_text": "عن #میخورم برات یه #دنیا ولی! #نرینی_برام به مولا!",
      "read_at": {
        "date": "2019-04-18 04:53:57.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "created_at": {
        "date": "2019-04-18 04:53:53.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "updated_at": {
        "date": "2019-04-18 04:53:57.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      }
    },
    {
        "id": "911da676-aad4-412b-82ca-ec8ccbad128a",
      "type": "App\\Containers\\Content\\Notifications\\RepostNotification",
      "user": {
        "object": "User",
        "id": "qmv7dk48x5b690wx",
        "first_name": null,
        "last_name": null,
        "nick_name": "محمد علوی ایرانسل",
        "description": "من یه گوگول مگول ام",
        "email": null,
        "username": null,
        "public_phone": "+989391***907",
        "is_phone_confirmed": true,
        "is_email_confirmed": false,
        "gender": "male",
        "birth": {
            "date": "2014-10-20 00:00:00.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "points": 0,
        "is_subscription_expired": true,
        "subscription_expired_at": {
            "date": "2019-04-18 04:25:41.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "images": {
            "avatar": "http:\/\/api.samandoon.local\/v1\/storage\/2\/2bc7be5602b3719147ad7f4f2c0ee587.png",
          "avatar_thumb": "http:\/\/api.samandoon.local\/v1\/storage\/2\/conversions\/2bc7be5602b3719147ad7f4f2c0ee587-thumb.png"
        },
        "stats": {
            "followings_count": 1,
          "followers_count": 0,
          "content_count": 12,
          "followed_by_me": false,
          "following_me": true
        },
        "social_activity_tendency": {
            "subject_count": [
            {
                "subject": "علمی",
              "count": 12,
              "color": "#FF0000"
            }
          ]
        },
        "created_at": {
            "date": "2019-04-18 04:26:06.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "updated_at": {
            "date": "2019-04-18 04:36:30.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "readable_created_at": "47 minutes ago",
        "readable_updated_at": "37 minutes ago"
      },
      "object_id": "qmv7dk48x5b690wx",
      "object_text": "عن #میخورم برات یه #دنیا ولی! #نرینی_برام به مولا!",
      "read_at": {
        "date": "2019-04-18 04:51:20.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "created_at": {
        "date": "2019-04-18 04:50:41.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "updated_at": {
        "date": "2019-04-18 04:51:20.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      }
    }
  ],
  "meta": {
    "pagination": {
      "total": 2,
      "per_page": 100,
      "current_page": 1,
      "total_pages": 1,
      "links": []
    }
  }
}
*/

/** @var Route $router */
$router->get('user/notifications', [
    'as' => 'api_notificationcenter_get_notifications',
    'uses'  => 'Controller@getNotifications',
    'middleware' => [
        'auth:api',
    ],
]);