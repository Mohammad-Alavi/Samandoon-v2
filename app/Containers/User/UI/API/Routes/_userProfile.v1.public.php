<?php

/**
 * @apiDefine UserSuccessProfileSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": {
        "user": {
          "object": "User",
          "id": "qmv7dk48x5b690wx",
          "first_name": null,
          "last_name": null,
          "nick_name": null,
          "description": null,
          "email": null,
          "username": null,
          "public_phone": "+989391***907",
          "is_phone_confirmed": true,
          "is_email_confirmed": false,
          "gender": null,
          "birth": null,
          "points": 0,
          "is_subscription_expired": true,
          "subscription_expired_at": {
            "date": "2019-03-22 16:03:23.000000",
            "timezone_type": 3,
            "timezone": "Asia\/Tehran"
          },
          "images": {
            "avatar": "http:\/\/api.samandoon.local\/v1\/storage\/default_images\/avatar.png",
            "avatar_thumb": "http:\/\/api.samandoon.local\/v1\/storage\/default_images\/avatar_thumb.png"
          },
          "stats": {
            "followings_count": 1,
            "followers_count": 0,
            "content_count": 2,
            "followed_by_me": false,
            "following_me": false
          },
          "social_activity_tendency": {
            "subject_count": [
              {
                "subject": "فرهنگی",
                "count": 1
              },
              {
                "subject": "علمی",
                "count": 1
              }
            ]
          },
          "created_at": {
            "date": "2019-03-22 16:03:33.000000",
            "timezone_type": 3,
            "timezone": "Asia\/Tehran"
          },
          "updated_at": {
            "date": "2019-03-22 16:04:45.000000",
            "timezone_type": 3,
            "timezone": "Asia\/Tehran"
          },
          "readable_created_at": "3 hours ago",
          "readable_updated_at": "3 hours ago"
        },
        "private_phone": "+989391079907"
      },
      "meta": {
        "include": [],
        "custom": []
      }
}
*/