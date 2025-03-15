<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

require_once __DIR__.'/../../functions.php';

/**
 *
 * @groups Artists
 *
 */
class artists extends Controller
{
    /**
     * Display info of artist by id of spotify
     *
     *
     * @method GET
     *
     * @param id string
     * @response {success:true}
     * @response {success:false,message:"Invalid base62 id"}
     *
     *
     */
    public function showArtists($id='0TnOYISbd1XYRBk9myaseg'):JsonResponse
    {


        if(empty($id)){
            return response()->json([
                'status' => 'error',
                'message' => 'No se ha recibido ningun id del artista' ,
            ]);
        }

        $token = json_decode(getApiTokenSpotify());

        if(isset($token->error)){
            return response()->json([
                'success' => false,
                'message' => $token->error_description ,

            ]);
        }

        $urlArtists = "https://api.spotify.com/v1/artists/".$id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlArtists);
        curl_setopt($ch, CURLOPT_POST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array(
            'Authorization: Bearer '.$token->access_token,
            'content-type: application/json',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        $responseArtist = json_decode(curl_exec($ch));





        if(isset($responseArtists->error) && $responseArtists->error->status == 400){
            return response()->json([
                'success' => false,
                'message' => $responseArtist->message,

            ]);
        }


        return response()->json([
            'success' => true,
            'message' => $responseArtist,

        ]);










    }


}
