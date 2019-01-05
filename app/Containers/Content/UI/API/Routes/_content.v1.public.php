<?php

/**
 * @apiDefine ContentSuccessSingleResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "data": {
    "object": "Content",
        "id": "7vmg6q36ak4b8kzr",
        "created_at": {
        "date": "2019-01-04 05:17:42.000000",
            "timezone_type": 3,
            "timezone": "Asia/Tehran"
        },
        "updated_at": {
        "date": "2019-01-04 05:17:42.000000",
            "timezone_type": 3,
            "timezone": "Asia/Tehran"
        },
        "deleted_at": null,
        "add-on": {
        "article": {
            "object": "Article",
                "id": "ojl0865y0j4bgmew",
                "title": "شسیشسی",
                "text": "این متن یک نوشته است",
                "content_id": "7vmg6q36ak4b8kzr",
                "created_at": {
                "date": "2019-01-04 05:17:42.000000",
                    "timezone_type": 3,
                    "timezone": "Asia/Tehran"
                },
                "updated_at": {
                "date": "2019-01-04 05:17:42.000000",
                    "timezone_type": 3,
                    "timezone": "Asia/Tehran"
                }
            },
            "repost": {
            "object": "Repost",
                "id": "kxeml73oyx4d9qbr",
                "content_id": "7vmg6q36ak4b8kzr",
                "referenced_content_id": "reloj65plp4v8ndy",
                "created_at": {
                "date": "2019-01-04 05:17:42.000000",
                    "timezone_type": 3,
                    "timezone": "Asia/Tehran"
                },
                "updated_at": {
                "date": "2019-01-04 05:17:42.000000",
                    "timezone_type": 3,
                    "timezone": "Asia/Tehran"
                }
            },
            "link": {
            "object": "Link",
                "id": "dqb9073ap3ekzgrm",
                "link_url": "https://stackoverflow.com/questions/38726530/replace-snake-case-to-camelcase-in-part-of-a-string",
                "content_id": "7vmg6q36ak4b8kzr",
                "created_at": {
                "date": "2019-01-04 05:17:42.000000",
                    "timezone_type": 3,
                    "timezone": "Asia/Tehran"
                },
                "updated_at": {
                "date": "2019-01-04 05:17:42.000000",
                    "timezone_type": 3,
                    "timezone": "Asia/Tehran"
                }
            }
        }
    },
    "meta": {
    "include": [],
        "custom": []
    }
} */