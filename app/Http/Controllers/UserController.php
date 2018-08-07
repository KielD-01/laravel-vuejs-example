<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{

    /**
     * UserController constructor.
     * @param JWTAuth $JWTAuth
     */
    public function __construct(JWTAuth $JWTAuth)
    {
        parent::__construct($JWTAuth);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $token = JWTAuth::attempt($request->only(['email', 'password'], true));
            return $this->json(compact('token'));
        } catch (Exception $exception) {
            return $this->json([], [], 401);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        try {
            $user = Auth::user();
            return $this->json(compact('user'));
        } catch (Exception $e) {
            return $this->json([], [], 401);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $users = User::paginate(10);
        return $this->json(compact('users'));
    }
}
