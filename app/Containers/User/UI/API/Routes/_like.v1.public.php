<?php

/**
 * @apiDefine LikeSuccessResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "msg": "User (3mjzyg5dp5a0vwp6) liked Content (kjeonp5eordqzvb8).",
    "like_count": 137, // this is the current like count of the liked target e.g. Content
    "is_liked": true // (or false) is current User liked the given Content ID?
} */