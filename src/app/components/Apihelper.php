<?php
//api helper class for various api operations
namespace App\Components;

class Apihelper
{

    /**
     * getSearchResponse($book)
     * 
     * function setting url to get search response
     *
     * @param [type] $book
     * @return void
     */
    public function getSearchResponse($book)
    {
        $url = "https://openlibrary.org/search.json?q=$book&mode=ebooks&has_fulltext=true";
        $response = $this->getresponse($url);
        return $response;
    }


    /**
     * getIsbnresponse($book)
     * 
     * function setting url to get response using ISBN.
     *
     * @param [type] $book
     * @return void
     */
    public function getIsbnresponse($book)
    {
        $url = "https://openlibrary.org/api/books?bibkeys=ISBN:$book&jscmd=details&format=json";
        $response = $this->getresponse($url);
        return $response;
    }


    /**
     * getresponse($url)
     * 
     * function to get response
     *
     * @param [type] $url
     * @return void
     */
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
