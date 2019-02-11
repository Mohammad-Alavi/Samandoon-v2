<?php

/**
 * @apiDefine UserSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": {
    "object": "User",
    "id": "bml0wd39b5pkznag",
    "first_name": null,
    "last_name": null,
    "nick_name": null,
    "email": null,
    "phone": "+989169302582",
    "is_phone_confirmed": true,
    "is_email_confirmed": false,
    "gender": null,
    "birth": null,
    "points": 0,
    "is_subscription_expired": true,
    "subscription_expired_at": {
        "date": "2019-02-11 00:50:29.000000",
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
      "followed_by_current_user": true, // when you are in another users profile it show if you are following that user
      "content_count": 4
    },
    "created_at": {
        "date": "2019-02-11 03:14:09.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
    },
    "updated_at": {
        "date": "2019-02-11 03:14:30.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
    },
    "readable_created_at": "12 hours ago",
    "readable_updated_at": "12 hours ago"
  },
  "meta": {
    "include": [
        "roles"
    ],
    "custom": []
  }
}
 */