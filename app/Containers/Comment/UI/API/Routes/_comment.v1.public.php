<?php

/**
 * @apiDefine CommentSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": {
    "object": "Comment",
        "id": "lo9m8d5jd5e07yvx",
        "body": "این متن یک کامنت هست",
        "content_id": "w6l8b75dy5qkv9ze",
        "parent_id": "qnwmkv5704blag6r",
        "created_at": {
        "date": "2019-02-06 14:08:43.000000",
            "timezone_type": 3,
            "timezone": "Asia/Tehran"
        },
        "updated_at": {
        "date": "2019-02-06 14:08:43.000000",
            "timezone_type": 3,
            "timezone": "Asia/Tehran"
        },
        "user": {
        "object": "User",
            "id": "qmv7dk48x5b690wx",
            "first_name": "Mohammad",
            "last_name": null,
            "nick_name": null,
            "email": null,
            "phone": "+989391079907",
            "is_phone_confirmed": true,
            "is_email_confirmed": false,
            "gender": null,
            "birth": null,
            "points": 0,
            "is_subscription_expired": true,
            "subscription_expired_at": {
            "date": "2019-02-05 15:17:26.000000",
                "timezone_type": 3,
                "timezone": "Asia/Tehran"
            },
            "images": {
            "avatar": "http://api.samandoon.local/v1/storage/1/me2.png",
                "avatar_thumb": "http://api.samandoon.local/v1/storage/1/conversions/me2-thumb.png"
            },
            "created_at": {
            "date": "2019-02-05 15:18:43.000000",
                "timezone_type": 3,
                "timezone": "Asia/Tehran"
            },
            "updated_at": {
            "date": "2019-02-05 15:23:18.000000",
                "timezone_type": 3,
                "timezone": "Asia/Tehran"
            },
            "readable_created_at": "22 hours ago",
            "readable_updated_at": "22 hours ago"
        }
    },
    "meta": {
        "include": [],
            "custom": [],
            "pagination": {
            "total": 6,
                "count": 6,
                "per_page": 15,
                "current_page": 1,
                "total_pages": 1,
                "links": []
            }
}
*/