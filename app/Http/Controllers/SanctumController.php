<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Nette\ArgumentOutOfRangeException;
use App\Modules\Core\HTTPResponseCodes;
use App\Modules\Sanctum\SanctumService;
use App\Http\Requests\StoreSanctumRequest;
use Illuminate\Support\Facades\Redis;

class SanctumController extends Controller
{
    private SanctumService $service;

    public function __construct(SanctumService $service)
    {
        $this->service = $service;
    }

    
    /**
     * Issue a new token for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    
    public function issueToken(Request $request):JsonResponse
    {
       
        try{
            // throw new ArgumentOutOfRangeException("test");
            $dataArray = ($request->toArray()!==[])
                 ?$request->toArray()
                 :$request->all();
           
            return response()->json(
                $this->service->issueToken($dataArray),
                HTTPResponseCodes::Success['code']
            );

        }catch(\Exception $e){
            return response()->json([
                'exception' => get_class($e),
                'error' => $e->getMessage()
            ],
            HTTPResponseCodes::BadRequest['code']);
        } 
    }
    // public function revokeToken(Request $request)
    // {
    //     // Revoke the token
    //     $request->user()->currentAccessToken()->delete();

    //     return response()->json(['message' => 'Token revoked']);
    // }
    // public function testSanctum(Request $request)
    // {
    //     return response()->json(['message' => 'Sanctum is working!']);
    // }
}
