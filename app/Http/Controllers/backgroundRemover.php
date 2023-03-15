<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class backgroundRemover extends Controller
{

    public function index()
    {
        return view('welcome');
    }
    // Convert Base64 To Image
    function convertBase64ToImage($base64_image, $overlayImagePath){
        $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_image));
        $imageConverted = imagecreatefromstring($image_data);
        imagepng($imageConverted, public_path($overlayImagePath));
        imagedestroy($imageConverted);
        return $overlayImagePath;
    }
    public function result(Request $request){
//            $url = 'https://s3.us-west-2.amazonaws.com/sitescube-docs/910/car/forsale/images/2023/02/pic-69e4623cffd6c91f23244c98f648deb5.jpg';

        $headers = [
            'A4A-CLIENT-APP-ID: sample',
            'Content-Type: multipart/form-data'
        ];
        $data = [
            'url' => $request->oldImage
        ];

        $ch = curl_init('https://demo.api4ai.cloud/img-bg-removal/v1/results');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // Fetch base64Image from response
        $jsonResponse = json_decode($response, true);
        $base64Image = $jsonResponse['results'][0]['entities'][0]['image'];
        $ImageStorePath = 'images/'. time().'.png';

    // Convert base64Image to png

        if($this->convertBase64ToImage($base64Image, $ImageStorePath)){
            return $ImageStorePath;
        }else{
            return "Somethin went wrong!";
        }
    }
}
