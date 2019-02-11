<?php

/**
 * @apiDefine UserSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": {
    "user": {
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
      "readable_created_at": "9 hours ago",
      "readable_updated_at": "9 hours ago"
    }
  },
  "meta": {
    "include": [],
    "custom": []
  }
}
*/