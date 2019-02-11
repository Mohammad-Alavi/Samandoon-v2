<?php

/**
 * @apiDefine FollowSuccessResponse
 * @apiSuccessExample {json} Success-Response:
HTTP/1.1 200 OK
{
    "followers_count": 53, // the followers count of the followed User
    "is_following": true // (or false) is the authenticated User following the given User? (user of the given ID)
}
} */