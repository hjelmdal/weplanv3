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

    static function elapsedTime()
    {
        return app()->make(Elapsed::class);
    }

    static function codeGen() {
        return app()->make(CodeGenerator::class);
    }
}
