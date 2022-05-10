<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use OpenApi\Annotations as OA;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     * 
     * @OA\Tag(
     *     name="Login",
     *     description="API Endpoints for User login and register"
     * ) 
     * 
     * @OA\Post(
     *      path="/register",
     *      operationId="register",
     *      tags={"Login"},
     *      summary="User Registration",
     *      description="Returns a user token",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"name","email","password"},
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="email", type="string"),
     *                  @OA\Property(property="password", type="string"),
     *                  example={"name":"Test User","email":"test@test.com", "password":"qwerty123"}
     *              ),
     *          ),
     *          
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Token")
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Validation Error.",
     *          @OA\JsonContent(ref="#/components/schemas/ValidationError")
     *       )
     * )
     *  
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponseWithPayload($success, 'User register successfully.');
    }


    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Login"},
     *      summary="User login",
     *      description="Returns user token",
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"email","password"},
     *                  @OA\Property(property="email", type="string"),
     *                  @OA\Property(property="password", type="string"),
     *                  example={"email":"test@test.com", "password":"qwerty123"}
     *              ),
     *          ),
     *          
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Token")
     *       ),
     *       @OA\Response(
     *          response=404,
     *          description="Unauthorised",
     *          @OA\JsonContent(ref="#/components/schemas/Error")
     *       )
     * )
     * 
     * @OA\Schema(
     *      schema="Token",
     *      title="Successful login",
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
     *          @OA\Property(
     *              property="token",
     *              type="string"
     *          ),    
     *          @OA\Property(
     *              property="name",
     *              type="string"
     *          )
     *      ),
     *      example={"success":true, "message":"User login successfully.", "data":{"token":"6|Nyoxys8IVdwBp19p2TutiPNUcrNKuaiXjpJY7dI6","name":"Test User"}}
     * )
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['name'] =  $user->name;
            return $this->sendResponseWithPayload($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
}