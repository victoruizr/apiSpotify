<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;
SecurityScheme::http('bearer', 'JWT');
class AuthControllerUsers extends Controller
{


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @unauthenticated
     *
 */
    public function loginUser(Request $request){

        $fieldsUserLogin = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);



        $fieldsUser = $request->only('email', 'password');

        try{

            if(!$token = JWTAuth::attempt($fieldsUser)){
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Email or Password',
                ]);
            }

            $userAuth = auth()->user();


            return response()->json(compact('token'));



        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @unauthenticated
     */
    public function registerUser(Request $request){

        $fieldsUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string'
        ]);

        $userCreate = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => $request->password
        ]);

        $token = JWTAuth::fromUser($userCreate,[]);


        return response()->json([
            'status' => true,
            'message' => compact('userCreate','token'),
        ]);




    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getUserInfo(Request $request){
        try{
            if(! $infoUser = JWTAuth::parseToken()->authenticate()){
                return response()->json([
                   "status" => false,
                   "message" => "User not found"
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }

        return response()->json([compact('infoUser')]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function userLogout(Request $request){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json([
            'status' => true,
            'message' => 'user logged out'
        ]);
    }


}
