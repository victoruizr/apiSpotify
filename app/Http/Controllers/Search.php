<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;


require_once __DIR__.'/../../functions.php';


/**
 *
 * @groups Search
 *
 */
class Search extends Controller
{
    /**
     * Search info in spotify
     *
     *
     * @method GET
     *
     * @param string q
     * @param type string
     * @param market string
     * @param limit string
     * @param ofset string
     * @param include_external string
     *
     * @response {success:true,message:""}
     * @response {success:false,message:""}
     *
     *
     */
    public function searchInSpotify(Request $request):JsonResponse
    {

        $request->validate([
            'q' => 'required|string',
            'type' => 'required|string',
            'market' => 'required|string',
            'limit' => 'required|integer',
            'offset' => 'required|integer',
            'include_external' => 'required|string',

        ]);


        $token = json_decode(getApiTokenSpotify());

        if(isset($token->error)){
            return response()->json([
                'success' => false,
                'message' => $token->error_description ,

            ]);
        }

        $types = ["album", "artist","playback", "track","show","episode","audiobook"];

        if(!in_array($request->type, $types) ){
            return response()->json([
                'success' => false,
                'message' => "El tipo que has de introducir es (album,artist,playback,track,show,episode,audiobook)",
            ]);
        }

        $include_external = ["audio"];
        if(!in_array($request->include_external, $include_external) ){
            return response()->json([
                'success' => false,
                'message' => "El tipo que has de introducir es audio",
            ]);
        }

        $params = [
            'q' => $request->q,
            'type' => $request->type,
            'market' => $request->market,
            'limit' => $request->limit,
            'offset' => $request->offset,
            'include_external' => $request->include_external,
        ];


        $urlArtists = "https://api.spotify.com/v1/search?".http_build_query($params,'','&');

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





        if(isset($responseArtist->error) && $responseArtist->error->status == 400){
            return response()->json([
                'success' => false,
                'message' => $responseArtist->error->message,

            ]);
        }



        return response()->json([
            'status' => true,
            'message' => $responseArtist->artists,
        ]);



    }

}
