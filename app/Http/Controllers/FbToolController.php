<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook;
class FbToolController extends Controller
{
    public function index() {

      
        $fb = new \Facebook\Facebook([
            'app_id' => '468826893884303',           //Replace {your-app-id} with your app ID
            'app_secret' => 'e4c7e05848fc07fb3aff81aadcb3cf4b',   //Replace {your-app-secret} with your app secret
            'graph_api_version' => 'v5.0',
          ]);
          
       
          
          try {
             
          // Get your UserNode object, replace {access-token} with your token
            $response = $fb->get('/me', 'EAAGqZAUR4m48BAPgTDlUWTiHRQKcFyviXp0Fs6ZAZAjPGnlulpPFuokZByVfxdeZBndKDRkyAkrkHVSfAIM4bATsqRgfu595ZBZBuFTOav7YODCh1LauLEMOaDm3fJZCesKuS5SdPETJ1utVriTXpLCuhtQAGVZA2N7hZBQ30ziWE3fg1EwGZBzW5M9kR2SbIACC49KHhoBx9CbriIVYYE2UZApy0qqDIFZCW81EZD');
          
          } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                  // Returns Graph API errors when they occur
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                  // Returns SDK errors when validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          
          $me = $response->getGraphUser();
          dd($me);
          
                 //All that is returned in the response
          echo 'All the data returned from the Facebook server: ' . $me;
          
                 //Print out my name
          echo 'My name is ' . $me->getName();
          
          

        return view('home');
    }
    public function webhook() {
        $dir = '../public/file';
        dd(__DIR__);
        // // fwrite($handle,'hahaha');
        // // fclose($handle);
        // dd('die');
      if (isset($_GET['hub_mode']) && isset($_GET['hub_challenge']) && isset($_GET['hub_verify_token'])) {
        if ($_GET['hub_verify_token'] == 'my_verify_token')
        echo $_GET['hub_challenge'];
    } else {
      $feedData = file_get_contents('php://input');
      $data = json_decode($feedData);
      $handle = fopen($dir.'/data.txt','w');
      // $handle = fopen($dir.'/test.txt','w');
        fwrite($handle,$data);
        fclose($handle);
      echo $data;
    }
    http_response_code(200);
  }
   
}
