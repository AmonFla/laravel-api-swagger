<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 *  @OA\Info(
 *      version="1.0.0",
 *      title="OpenApi",
 *      description="OpenApi description",
 *      @OA\Contact(
 *          email="test@test.com"
 *      ),
 *      @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 *  )
 * 
 *  @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 *  )
 *
 * @OA\Schema(
 *      schema="Success",
 *      title="Successful operation",
 * 	    @OA\Property(
 * 		    property="success",
 * 		    type="boolean"
 * 	    ),
 * 	    @OA\Property(
 * 		    property="message",
 * 		    type="string"
 * 	    ),
 *      example={"success":true, "message":"User login successfully."}
 * )
 *  @OA\Schema(
 *      schema="Error",
 *      title="General Errors",
 *  	@OA\Property(
 * 		    property="success",
 * 		    type="boolean"
 *      ),
 *  	@OA\Property(
 * 	    	property="message",
 * 		    type="string"
 * 	    ),
 *      @OA\Property(
 * 		    property="data",
 * 		    type="object",
 *          @OA\Property(
 *              property="error",
 *              type="string"
 *          )
 *      ),
 *      example={"success":false, "message":"Error message.", "data":{"error":"Error message"}}
 * )
 * 
 * @OA\Schema(
 *      schema="ValidationError",
 *      title="Validation Errors",
 * 	    @OA\Property(
 * 		    property="success",
 * 		    type="boolean"
 * 	    ),
 * 	    @OA\Property(
 * 		    property="message",
 * 		    type="string"
 * 	    ),
 *      @OA\Property(
 * 		    property="data",
 * 		    type="object",
 *          description="list of fields with errors",
 *          @OA\Property(
 *              property="error",
 *              type="string"
 *          )
 *      ),
 *      example={"success":false, "message":"Validation Error.", "data":{"name":"The name field is required."}}
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
}


