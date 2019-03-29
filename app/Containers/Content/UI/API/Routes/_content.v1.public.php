<?php

/**
 * @apiDefine ContentSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": {
    "object": "Content",
    "id": "qmv7dk48x5b690wx",
    "created_at": {
        "date": "2019-03-30 03:26:24.000000",
      "timezone_type": 3,
      "timezone": "Asia\/Tehran"
    },
    "updated_at": {
        "date": "2019-03-30 03:26:24.000000",
      "timezone_type": 3,
      "timezone": "Asia\/Tehran"
    },
    "add-on": {
        "article": {
            "object": "Article",
        "id": "qmv7dk48x5b690wx",
        "text": "عن #میخورم برات یه #دنیا ولی! #نرینی_برام به مولا!",
        "content_id": "qmv7dk48x5b690wx",
        "created_at": {
                "date": "2019-03-30 03:26:24.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "updated_at": {
                "date": "2019-03-30 03:26:24.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        }
      },
      "repost": {
            "object": "Repost",
        "id": "qnwmkv5704blag6r",
        "content_id": "qmv7dk48x5b690wx",
        "referenced_content_id": "qnwmkv5704blag6r",
        "referenced_content_count": 2,
        "referenced_content_user": {
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
                    "date": "2019-03-30 02:46:23.000000",
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
            "content_count": 3,
            "followed_by_me": false,
            "following_me": false
          },
          "social_activity_tendency": {
                    "subject_count": [
              {
                  "subject": "علمی",
                "count": 3
              }
            ]
          },
          "created_at": {
                    "date": "2019-03-30 02:47:29.000000",
            "timezone_type": 3,
            "timezone": "Asia\/Tehran"
          },
          "updated_at": {
                    "date": "2019-03-30 02:47:52.000000",
            "timezone_type": 3,
            "timezone": "Asia\/Tehran"
          },
          "readable_created_at": "47 minutes ago",
          "readable_updated_at": "47 minutes ago"
        },
        "referenced_content_article_text": "عن #میخورم برات یه #دنیا ولی! #نرینی_برام به مولا!",
        "referenced_content_created_at": {
                "date": "2019-03-30 02:56:30.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "referenced_content_updated_at": {
                "date": "2019-03-30 02:56:30.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        }
      },
      "link": {
            "object": "Link",
        "id": "qmv7dk48x5b690wx",
        "link_url": "https:\/\/stackoverflow.com",
        "content_id": "qmv7dk48x5b690wx",
        "created_at": {
                "date": "2019-03-30 03:26:24.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "updated_at": {
                "date": "2019-03-30 03:26:24.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        }
      },
      "image": {
            "object": "Image",
        "id": "qmv7dk48x5b690wx",
        "image_url": "http:\/\/api.samandoon.local\/v1\/storage\/2\/2613acc76603bff52ce7317197d9f442.jpg",
        "created_at": {
                "date": "2019-03-30 03:26:24.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "updated_at": {
                "date": "2019-03-30 03:26:24.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        }
      },
      "subject": {
            "object": "Subject",
        "id": "qnwmkv5704blag6r",
        "subject": "علمی",
        "color": "#FF0000",
        "created_at": {
                "date": "2019-03-30 02:46:28.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        },
        "updated_at": {
                "date": "2019-03-30 02:46:28.000000",
          "timezone_type": 3,
          "timezone": "Asia\/Tehran"
        }
      }
    },
    "stats": {
        "like_count": 0,
      "comment_count": 0,
      "liked_by_me": false,
      "commented_by_me": false,
      "reposted_by_me": false
    },
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
            "date": "2019-03-30 02:46:23.000000",
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
        "content_count": 3,
        "followed_by_me": false,
        "following_me": false
      },
      "social_activity_tendency": {
            "subject_count": [
          {
              "subject": "علمی",
            "count": 3
          }
        ]
      },
      "created_at": {
            "date": "2019-03-30 02:47:29.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "updated_at": {
            "date": "2019-03-30 02:47:52.000000",
        "timezone_type": 3,
        "timezone": "Asia\/Tehran"
      },
      "readable_created_at": "47 minutes ago",
      "readable_updated_at": "47 minutes ago"
    }
  },
  "meta": {
    "include": [],
    "custom": []
  }
}
*/