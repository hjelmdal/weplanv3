<?php
/**
 * Created by PhpStorm.
 * User: impact
 * Date: 2019-03-20
 * Time: 00:46
 */

namespace App\Helpers;


class Elapsed
{
    private $now;
    public function __construct()
    {
        $this->now = microtime(true);
    }

    public function elapsed() {
        return microtime(true) - $this->now;
    }
}
