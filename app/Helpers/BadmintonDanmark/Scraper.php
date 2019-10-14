<?php
/**
 * Created by PhpStorm.
 * User: hjelmdal
 * Date: 29/10/2017
 * Time: 20.51
 */

namespace App\Helpers\BadmintonDanmark;

use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;

class Scraper
{
    private $getUrl;
    private $postUrl;
    private $postDomain;
    private $token;
    private $getHeaders;
    private $postOptions = array();
    private $status = true;

    public function __construct()
    {
        $this->getHeaders = array(
            'headers' => array(
                'User-Agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
                'Accept' => 'text/html'
            ),
            'base_uri' => 'http://badmintonplayer.dk/'
        );


        $this->postOptions = array(
            'base_uri' => 'https://www.badmintonplayer.dk/SportsResults/Components/WebService1.asmx'

        );
        $this->getUrl = 'https://badmintonplayer.dk';
        $this->postDomain = 'https://www.badmintonplayer.dk/';
        $this->postUrl = 'SportsResults/Components/WebService1.asmx/';
        $this->initialConnect();
    }

    public function getStatus()
    {
        return $this->status;
    }


    private function initialConnect()
    {

        $client = new \GuzzleHttp\Client($this->getHeaders);
        try {
            $request = $client->get($this->getUrl);
        } catch (RequestException $e) {
            echo "Connection could not be made. Please check your internet connection!";
            $this->status = false;
            return false;
        }
        $response = $request->getBody();

        $result = preg_replace("/((\r?\n)|(\r\n?))/", ',', $response);
        $result = explode(",", $result);
        foreach ($result as $value) {
            if (strpos($value, 'SR_CallbackContext') !== false) {
                $key = $value;
            }
        }
        preg_match("/\'([^\)]*)\'/", $key, $key);
        $this->token = $key[1];
        return true;

    }

    public function getToken()
    {
        return $this->token;
    }

    public function getRankings(int $age = 1, int $cat = 62, int $page = 0, int $season = 2017, string $version = "")
    {
        $client = new GuzzleHttp\Client(['base_uri' => 'http://badmintonpeople.dk/']);
        $response = $client->post('SportsResults/Components/WebService1.asmx/GetRankingListPlayers', [
            'json' => [
                "agegroupid" => $age,
                "birthdatefrom" => "",
                "birthdateto" => "",
                "callbackcontextkey" => $this->getToken(),
                "clubid" => "",
                "gender" => "",
                "getplayer" => true,
                "getversions" => true,
                "pageindex" => $page,
                "playerid" => "",
                "pointsfrom" => "",
                "pointsto" => "",
                "rankinglistagegroupid" => "",
                "rankinglistid" => $cat,
                "rankinglistversiondate" => $version,
                "regionid" => "",
                "searchall" => null,
                "seasonid" => $season,
                "sortfield" => "0"
            ]
        ]);

        $array = json_decode($response->getBody()->getContents(), true);
        return $array["d"]["Html"];


    }

    public function makePost($context, $params)
    {

        $season = 2017;
        $age = 1;
        $region = 1;
        //$params["callbackcontextkey"] = $this->getToken();

        $client = new GuzzleHttp\Client(['base_uri' => $this->postDomain]);
        $response = $client->post($this->postUrl . $context, [
            'json' => $params

        ]);

        $array = json_decode($response->getBody()->getContents(), true);
        if (array_key_exists("d", $array)) {
            $this->status = $response->getStatusCode();
            return $array["d"];
        } else {
            return false;
        }
    }

    public function getPage($context)
    {
        $client = new \GuzzleHttp\Client($this->getHeaders);
        $response = $client->get($context);
        $response = $response->getBody()->__toString();
        return $response;
    }


}
