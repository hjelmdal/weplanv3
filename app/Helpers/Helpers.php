<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 26/02/2019
 * Time: 01.21
 */

namespace App\Helpers;


class Helpers
{
    static function gitVersion()
    {
        return app()->make(ReadVersion::class);
    }
}