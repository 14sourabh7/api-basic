<?php

namespace App\Components;

class Apihelper
{
    public function getSearchResponse($book)
    {
        $url = "https://openlibrary.org/search.json?q=$book&mode=ebooks&has_fulltext=true";
        $response = $this->getresponse($url);
        return $response;
    }

    public function getIsbnresponse($book)
    {
        $url = "https://openlibrary.org/api/books?bibkeys=ISBN:$book&jscmd=details&format=json";
        $response = $this->getresponse($url);
        return $response;
    }

    public function getresponse($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $res =  curl_exec($ch);
        $response = json_decode($res, true);
        return $response;
    }
}
