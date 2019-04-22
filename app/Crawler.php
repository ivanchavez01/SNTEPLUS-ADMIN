<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Crawler extends Model
{
    public $domain      = "https://snte.org.mx";
    public $sliderURL   = "https://snte.org.mx/seccion54/";
    public $AsambleasURL= "http://cmapsnte54.com.mx/";
    public $MagazineURL = "magazines.json";
    public $ReportsURL  = "reports.json";
    public $YBclient    = null;
    public $devKey      = "AIzaSyCVPm1q_IKyyhDU5pqQGPUP0yuEqEc5jiw";
    

    public function news() {
        $value = Cache::store('file')->get('news');
        
        if($value == "") {
            $str = $this->requestNews($this->sliderURL);
            $dom = HtmlDomParser::str_get_html($str);
            $data = [];
            foreach($dom->find(".principal .big") as $node) {
                //obteniendo url
                $image = $this->domain.$node->find("a img")[0]->src;
                //binario de la imagen
                $imageData  = @file_get_contents($image);
                //obteniendo nombre de la imagen
                $splits = explode("/", $image);
                $imageName = $splits[count($splits) - 1];
                Storage::disk("local")->put(public_path("images/".$imageName), $imageData);
                //file_put_contents(public_path($imageName), $imageData);

                $data[] = [
                    "title"     => $node->find("a img")[0]->title,
                    "img"       => $imageName,
                    "link"      => $this->domain.$node->find("a")[0]->href
                ];
            }

            Cache::store('file')->put('news', json_encode($data), (60 * 60 * 24));
        } else {
            $data = json_decode($value);
        }

        return $data;
    }

    public function newsNacional() {
        $sliderNacionalURL = "http://www.snte.org.mx/web/";
        $nacionalDomain = "https://www.snte.org.mx";

        $value = Cache::store('file')->get('newsNational');
        
        if($value == "") {
            $str = $this->requestNews($sliderNacionalURL);
            $dom = HtmlDomParser::str_get_html($str);
            $data = [];
            foreach($dom->find(".principal .big") as $node) {
                //obteniendo url
                $image = $this->domain.$node->find("a img")[0]->src;
                //binario de la imagen
                $imageData  = @file_get_contents($image);
                //obteniendo nombre de la imagen
                $splits = explode("/", $image);
                $imageName = $splits[count($splits) - 1];
                
                file_put_contents(public_path("images/".$imageName), $imageData);

                $data[] = [
                    "title"     => $node->find("a img")[0]->title,
                    "img"       => $imageName,
                    "link"      => $nacionalDomain.$node->find("a")[0]->href
                ];
            }

            Cache::store('file')->put('newsNational', json_encode($data), (60 * 60 * 24));
        } else {
            $data = json_decode($value);
        }

        return $data;
    }

    // public function asambleas() {
    //     $data = $this->requestAsambleas($this->AsambleasURL);
    //     $dom = HtmlDomParser::str_get_html($data);
    //     $data = [];
    //     foreach($dom->find("#blog-wrapper .bgrid") as $node):
    //         $created_at = new DateTime;
    //         $data[] = [
    //             "title" => $node->find('h5')[0]->innertext,
    //             "subtitle" => $node->find('h3 a')[0]->innertext,
    //             "url" => $this->AsambleasURL.$node->find('h3 a')[0]->href,
    //             "img" => $this->AsambleasURL.$node->find('a img')[0]->src,
    //             "created_at"=> $created_at
    //          ];
    //    endforeach;
      
    //   return $data;
    // }


    public function reports() {
        $json = file_get_contents(storage_path("private/".$this->ReportsURL));
        $data = [];

        if($json)
            $data = json_decode($json, true);
        
        return $data;
    }

    public function magazines() {
        $json = file_get_contents(storage_path("private/".$this->MagazineURL));
        $data = [];

        if($json)
            $data = json_decode($json, true);

        return $data;
    }

    public function youtube() {
        $value = Cache::store('file')->get('youtube');

        if($value == "") {
            $this->client = new \Google_Client();
            $this->client->setApplicationName("SNTE 54 App");
            $this->client->setDeveloperKey($this->devKey);
            $youtube = new \Google_Service_YouTube($this->client);
            
            
            $result = $youtube->activities->listActivities("id,snippet,contentDetails", ["channelId" => "UCLP7I5UI4GJExfQPBGvQ8-g", "maxResults" => 50]);
            $data = [];

            if(!empty($result)) {
                foreach($result->items as $item){
                    $video = [
                        "title"         => $item->snippet->title,
                        "description"   => $item->snippet->description,
                        "thumb"         => [
                            "default" => $item->snippet->thumbnails["default"],
                            "medium"  => $item->snippet->thumbnails["medium"],
                            "high"    => $item->snippet->thumbnails["high"],
                        ],
                        "videoId"       => $item->contentDetails["upload"]["videoId"],
                        "publishedAt"   => $item->snippet->publishedAt
                    ];

                    $data[] = $video;
                }
            }
            Cache::store('file')->put('youtube', json_encode($data), (60 * 60 * 24));
            return $data;
        }

        return json_decode($value);
    }



    public function requestNews($url) { //broke cloudflare
        
        $curl = curl_init();

        $headers[] = "Upgrade-Insecure-Requests:1";
        $headers[] = "User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12F70 Safari/600.1.";

        $cookie_file_path = storage_path("private/cookie.txt");

        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file_path);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_REFERER, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        curl_getinfo($curl);

        $str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }

    public function requestMagazines($url) {
         $curl = curl_init();
        //$headers[] = "Cookie: __cfduid=d4a6d4b578342fd8c89bd9c8fb39efa811489211465; _gat=1; OX_sd=1; OX_plg=pm; _ga=GA1.2.1377379081.1489211468";
        $headers[] = "Upgrade-Insecure-Requests:1";
        $headers[] = "Content-Type:application/x-www-form-urlencoded; charset=UTF-8";
        $headers[] = "User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 8_3 like Mac OS X) AppleWebKit/600.1.4 (KHTML, like Gecko) Version/8.0 Mobile/12F70 Safari/600.1.";

        $cookie_file_path = "cookie.txt";
       
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(["pagina" => 1, "tipo" => 2]));
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file_path);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_REFERER, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        curl_getinfo($curl);

        $str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }

    public function requestAsambleas($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_REFERER, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_getinfo($curl);
        $str = curl_exec($curl);
        curl_close($curl);
        return $str;
    }
}
