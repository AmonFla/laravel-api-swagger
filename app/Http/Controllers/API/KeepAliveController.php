<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use OpenApi\Annotations as OA;


class KeepAliveController extends BaseController
{
    /**
     * KeepAlive api
     *
     * @return \Illuminate\Http\Response
     * 
     * @OA\Tag(
     *     name="Misc",
     *     description="API Endpoints for miscellaneous"
     * ) 
     * 
     * @OA\Get(
     *      path="/keepalive",
     *      operationId="keepalive",
     *      tags={"Misc"},
     *      summary="Keepalive",
     *      description="Returns ok",
     *      security={{"sanctum":{}}}, 
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Success")
     *       ) 
     * )
     *  
     */
    public function keepalive(Request $request)
    { 

        return $this->sendResponse('Keepalive');       
         
    }

}