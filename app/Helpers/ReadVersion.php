<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 26/02/2019
 * Time: 01.21
 */

namespace App\Helpers;


class ReadVersion
{
    private $string;
    
    public function __construct() {
        $file = './../deploy_version.txt';
        if(file_exists($file)) {
            $string = file_get_contents($file, FILE_USE_INCLUDE_PATH);
            $this->string = trim($string);
            return $this->getShortVersion();
            
        }
        else {
            return false;
        }
    }
    
    public function getVersion()
    {
        if ($this->string) {
            return $this->string;
        } else {
            return false;
        }
        
    }
    
    public function getShortVersion() {
        if($this->string) {
            return substr($this->string,0,8);
        }
    }
}