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
            "date": "2019-04-11 18:28:35.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "images": {
            "avatar": "http:\/\/api.samandoon.local\/v1\/storage\/default_images\/avatar.png",
        "avatar_thumb": "http:\/\/api.samandoon.local\/v1\/storage\/default_images\/avatar_thumb.png"
      },
      "stats": {
            "followings_count": 0,
        "followers_count": 1,
        "content_count": 0,
        "followed_by_me": false,
        "following_me": false
      },
      "social_activity_tendency": {
            "subject_count": []
      },
      "created_at": {
            "date": "2019-04-11 18:29:05.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "updated_at": {
            "date": "2019-04-12 01:42:46.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "readable_created_at": "8 hours ago",
      "readable_updated_at": "1 hour ago"
    },
    "private_phone": "+989391079907",
    "unread_notification_count": 0
  },
  "meta": {
    "include": [],
    "custom": []
  }
}
*/