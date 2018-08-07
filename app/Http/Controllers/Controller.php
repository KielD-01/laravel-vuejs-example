<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var JWTAuth
     */
    protected $_jwt;

    /**
     * Controller constructor.
     * @param JWTAuth $JWTAuth
     */
    public function __construct(JWTAuth $JWTAuth)
    {
        $this->_jwt = $JWTAuth;
    }

    /**
     * Return JSON response
     *
     * @param array $data
     * @param array $errors
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function json($data = [], $errors = [], $code = 200)
    {
        return response()
            ->json(compact('data', 'errors', 'code'))
            ->setStatusCode($code);
    }

}
