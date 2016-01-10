<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/7/2016
 * Time: 1:24 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\User;
use Eureka\Repositories\Country;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Webpatser\Uuid\Uuid;

class ApiAuthController extends Controller
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Country
     */
    private $country;

    public function __construct(User $user, Country $country){
        $this->user = $user;
        $this->country = $country;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        try{
            $token = JWTAuth::attempt($credentials);
            if( ! $token ){
                return;
            }
        } catch(JWTException $e){
            return;
        }
        return response()->json(['token'=>$token]);
    }

    public function join(Request $request)
    {
        $dial_code = $request->code;
        $raw_phone = $request->phone;
        $phone = $dial_code.$raw_phone;
        //We generate the verification code And
        //We send verification to the $phone
        session()->put('phone_number', $raw_phone);
        session()->put('phone_code', $dial_code);
//        session()->put('verification_code', $verification_code);
    }

    public function register(Request $request)
    {
        $verification_code = $request->verification_code;
        //If the verification code sent back does not match the one saved in session
        if( $verification_code != session()->get('verification_code') ){}
        $phone_code = session()->get('phone_code');
        $phone = $phone_code .session()->get('phone_number');
        $country_name = $this->country->getName($phone_code);
        $uuid = Uuid::generate(4);
        $data = $this->AddNecessaryFields($request, $phone, $uuid, $country_name);
        $user = $this->user->create($data);
        $token = JWTAuth::fromUser($user);
        //return the token to client device
    }

    public function validateToken()
    {

    }

    /**
     * @param Request $request
     * @param $phone
     * @param $uuid
     * @param $country_name
     * @return array
     */
    protected function AddNecessaryFields(Request $request, $phone, $uuid, $country_name)
    {
        $data = $request->only('username', 'password');
        $data = array_add($data, 'phone', $phone);
        $data = array_add($data, 'uuid', $uuid);
        $data = array_add($data, 'country', $country_name);
        $data = array_add($data, 'type', 'client');
        return $data;
    }
}