<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{

    public function __construct(JWTAuth $JWTAuth)
    {
        parent::__construct($JWTAuth);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('welcome');
    }
}
