<?php

/**
 * @apiGroup           Link
 * @apiName            getLinkOGData
 *
 * @api                {GET} /v1/content/link/og Get Link OG Data
 * @apiDescription     Get the given link open graph data
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {string} url http://www.samandoon.ir this should be a complete url with http/s
 * @apiParam           {boolean} get_all_meta_data 0 or 1 | 0 = false and 1 = true
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "type": "article",
    "url": "https:\/\/www.isna.ir\/news\/98012812505\/حقوق-پارسالی-نگیرید",
    "title": "حقوق پارسالی نگیرید!",
    "description": "با اعلام صریح رییس سازمان برنامه و بودجه، درباره تامین و تخصیص منابع برای پرداخت حقوق کارکنان و بازنشستگان، تمامی آن‌ها از افزایش ۴۰۰ هزار تومانی در فروردین‌ماه برخوردار می‌شوند.",
    "image": "https:\/\/cdn.isna.ir\/d\/2018\/10\/30\/4\/57771868.jpg",
    "site_name": "ایسنا",
    "locale": "fa_IR"
}
 */

/** @var Route $router */
$router->get('content/link/og', [
    'as' => 'api_link_get_link_o_g_data',
    'uses'  => 'Controller@getLinkOGData',
//    'middleware' => [
//      'auth:api',
//    ],
]);
