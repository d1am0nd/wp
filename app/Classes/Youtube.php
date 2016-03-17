<?php

namespace App\Classes;

class Youtube
{

    /**
     * @var string
     */
    protected $youtube_key; // from the config file

    /**
     * @var array
     */
    public $page_info = array();

    /**
     * @var array
     */
    public $APIs = array(
        'videos.list' => 'https://www.googleapis.com/youtube/v3/videos',
        'search.list' => 'https://www.googleapis.com/youtube/v3/search',
        'channels.list' => 'https://www.googleapis.com/youtube/v3/channels',
        'playlists.list' => 'https://www.googleapis.com/youtube/v3/playlists',
        'playlistItems.list' => 'https://www.googleapis.com/youtube/v3/playlistItems',
        'activities' => 'https://www.googleapis.com/youtube/v3/activities',
    );

    /**
     * Constructor
     * $youtube = new Youtube(array('key' => 'KEY HERE'))
     *
     * @param array $params
     * @throws \Exception
     */
    public function __construct()
    {
        $this->youtube_key = env('YOUTUBE_API_KEY');
    }

    /**
     * @param $single
     * @return \StdClass
     * @throws \Exception
     */
    public function getVideoInfo($vId, $part = ['id', 'snippet', 'contentDetails', 'player', 'statistics', 'status'])
    {
        $API_URL = $this->getApi('videos.list');
        $params = array(
            'id' => is_array($vId) ? implode(',', $vId) : $vId,
            'key' => $this->youtube_key,
            'part' => implode(', ', $part),
        );

        $apiData = $this->api_get($API_URL, $params);

        return $this->decodeSingle($apiData);
    }

    /**
     * Decode the response from youtube, extract the single resource object.
     * (Don't use this to decode the response containing list of objects)
     *
     * @param  string $apiData the api response from youtube
     * @throws \Exception
     * @return \StdClass  an Youtube resource object
     */
    public function decodeSingle(&$apiData)
    {
        $resObj = json_decode($apiData);
        if (isset($resObj->error)) {
            $msg = "Error " . $resObj->error->code . " " . $resObj->error->message;
            if (isset($resObj->error->errors[0])) {
                $msg .= " : " . $resObj->error->errors[0]->reason;
            }

            throw new \Exception($msg);
        } else {
            $itemsArray = $resObj->items;
            if (!is_array($itemsArray) || count($itemsArray) == 0) {
                return false;
            } else {
                return $itemsArray[0];
            }
        }
    }

    public function getApi($name)
    {
        return $this->APIs[$name];
    }

    /**
     * Using CURL to issue a GET request
     *
     * @param $url
     * @param $params
     * @return mixed
     * @throws \Exception
     */
    public function api_get($url, $params)
    {
        //set the youtube key
        $params['key'] = $this->youtube_key;

        //boilerplates for CURL
        $tuCurl = curl_init();
        if(!env('VERIFY_SSL', false))
            curl_setopt($tuCurl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($tuCurl, CURLOPT_URL, $url . (strpos($url, '?') === false ? '?' : '') . http_build_query($params));
        if (strpos($url, 'https') === false) {
            curl_setopt($tuCurl, CURLOPT_PORT, 80);
        } else {
            curl_setopt($tuCurl, CURLOPT_PORT, 443);
        }

        curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
        $tuData = curl_exec($tuCurl);
        if (curl_errno($tuCurl)) {
            throw new \Exception('Curl Error : ' . curl_error($tuCurl));
        }

        return $tuData;
    }
}
