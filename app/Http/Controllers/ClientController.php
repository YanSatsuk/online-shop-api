<?php

namespace App\Http\Controllers;

use App\Classes\Responses\ResponseHelper;
use App\Classes\Users\UsersCRUDHelper;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Get clients
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $arrRes = null;
        $clients = UsersCRUDHelper::getAllClients();
        $arrRes = ResponseHelper::init()->getResponseByName(
            ResponseHelper::DEFAULT,
            ResponseHelper::CODE_200,
            $clients
        );
        return response()->json($arrRes);
    }
}
