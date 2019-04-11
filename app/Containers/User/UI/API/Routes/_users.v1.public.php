<?php

/**
 * @apiDefine UserSuccessPaginatedResponse
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
      "email": null,
      "username": null,
      "public_phone": "+989391***907",
      "is_phone_confirmed": true,
      "is_email_confirmed": false,
      "gender": null,
      "birth": null,
      "points": 0,
      "unread_notification_count": 2,
      "is_subscription_expired": true,
      "subscription_expired_at": {
            "date": "2019-02-20 09:42:31.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "images": {
            "avatar": "http:\/\/api.samandoon.local\/v1\/storage\/default_images\/avatar.png",
        "avatar_thumb": "http:\/\/api.samandoon.local\/v1\/storage\/default_images\/avatar_thumb.png"
      },
      "stats": {
            "followings_count": 0,
        "followers_count": 0,
        "followed_by_current_user": false
      },
      "social_activity_tendency": {
            "subject_count": {
                "علمی": 1,
          "فرهنگی": 2,
          "هنری": 22,
          "محیط زیست": 1
        }
      },
      "created_at": {
            "date": "2019-02-20 09:43:09.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "updated_at": {
            "date": "2019-02-20 09:43:48.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "readable_created_at": "4 days ago",
      "readable_updated_at": "4 days ago"
    },
    "private_phone": "+989391079907"
  },
  "meta": {
    "include": [
        "roles"
    ],
    "custom": [],
    "pagination": {
        "total": 1,
      "count": 1,
      "per_page": 10,
      "current_page": 1,
      "total_pages": 1,
      "links": []
    }
  }
}
 */