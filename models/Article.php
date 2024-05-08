<?php

class Article
{

    function getArticle($size)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://newsapi.org/v2/top-headlines?country=id&category=health&pageSize=$size&apiKey=7735aaca160040e7a265b83222cae677",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_USERAGENT => "Hospital",
            CURLOPT_POSTFIELDS => "",
        ));


        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Error fetching data from the API: ' . curl_error($curl);
        } else {
            $data = json_decode($response, true);
            return $data;
        }

        curl_close($curl);
    }
}
