<?php
/**
 * Created by PhpStorm.
 * User: GURU
 * Date: 1/7/2016
 * Time: 1:24 PM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\AppApi\PublicApiController;
use App\Jobs\RegisterUser;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Http\Request;
use Eureka\Helpers\Transformers\UserItemTransformer;
use Eureka\Repositories\UserRepository;
use Eureka\Repositories\VerificationCodeRepository;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Mockery\Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthController extends PublicApiController
{
    /**
     * @var VerificationCodeRepository
     */
    private $codeRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @param VerificationCodeRepository $codeRepository
     * @param UserRepository $userRepository
     * @param Manager $fractal
     */
    public function __construct(VerificationCodeRepository $codeRepository,
                                UserRepository $userRepository, Manager $fractal){
        $this->codeRepository = $codeRepository;
        $this->userRepository = $userRepository;
        $this->fractal = $fractal;
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
                return $this->respondForAuth("error", 500, "Invalid Credentials", null, null);
//                return response()->json(['error'=>'Invalid Credentials'], 401);
            }
        } catch(JWTException $e){
            return $this->respondForAuth("error", 500, "Could not create token", null, null);
//            return response()->json(['error'=>'Could not create token'], 500);
        }
        $user = $this->userRepository->getUserByUsername($request->get('username'));
        $user = $this->transform($user);
        return $this->respondForAuth('success', '200', 'login successful', $token, $user);
    }

    public function register(Request $request)
    {
        $rules = $this->getRegistrationRules();
        $payload = $request->only('dial_code', 'phone_number', 'username', 'password');
        try{
            $this->validateData($payload, $rules);
        }catch (StoreResourceFailedException $e){
            return $this->respondForAuth('error', $e->getCode(), $e->getMessage());
//            throw $e;
        }
        $job = new RegisterUser(collect($request->all()));
        try{
            $this->dispatch($job);
        }catch (Exception $e){
//            throw $e;
            return $this->respondForAuth('error', $e->getCode(), $e->getMessage());
        }
        return $this->respondForAuth('success', 200, 'user created');
    }

    public function verifyOtp(Request $request)
    {
        $otp = $request->get("code");
        $code = $this->codeRepository->getCode($otp);
        if( ! $code ){
            return $this->respondForAuth('error', 400, 'Invalid Code');
        }
        $user = $code->user;
        $token = $this->generateToken($code->user);
//        $this->deleteOtp($otp);
//        $this->updateUserStatus($user);
        $user = $this->fractal->createData(new Item($user, new UserItemTransformer, 'user'))->toArray();
        return $this->respondForAuth('success', '200', 'user registered successfully', $token, $user);
    }

    public function validateToken()
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();
            if( ! $user ){
                return response()->json([
                    'status'=>'error',
                    'message'=>'User Not Found',
                    'data'=>null
                ], 404);
            }
        }catch (TokenExpiredException $e){
            return response()->json(['error'=>'Token Expired'], $e->getStatusCode());
        }catch (TokenInvalidException $e){
            return response()->json(['error'=>'Invalid Token'], $e->getStatusCode());
        }catch (JWTException $e){
            return response()->json(['error'=>'Token absent'], $e->getStatusCode());
        }
        return response()->json(['user'=>$user]);
    }

    /**
     * @return array
     */
    private function getRegistrationRules()
    {
        $rules = [
            'dial_code' => ['required'],
            'phone_number' => ['required'],
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'min:10']
        ];
        return $rules;
    }

    /**
     * @param $payload
     * @param $rules
     */
    private function validateData($payload, $rules)
    {
        $validator = app('validator')->make($payload, $rules);
        if ($validator->fails()) {
            throw new StoreResourceFailedException('Invalid Information', $validator->errors());
        }
    }

    /**
     * @param $user
     */
    private function updateUserStatus($user)
    {
        $this->userRepository->updateStatus($user->uuid);
    }

    /**
     * @param $otp
     */
    private function deleteOtp($otp)
    {
        $this->codeRepository->delete($otp);
    }

    /**
     * @param $user
     * @return mixed
     */
    private function generateToken($user)
    {
        $token = JWTAuth::fromUser($user);
        return $token;
    }
    /**
     * @param $user
     * @return array
     */
    private function transform($user)
    {
        return $this->fractal->createData(new Item($user, new UserItemTransformer, 'user'))->toArray();
    }
}