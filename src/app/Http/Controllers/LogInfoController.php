<?php

namespace App\Http\Controllers;

use App\Models\LogInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogInfoController extends Controller
{

    public function registerActivity($serviceName, $bodyReq, $httpResp, Request $request): void{


        $userId = Auth::user()->getAuthIdentifier();

        // Registering a new activity

        try {
            $logInfo = new LogInfo();
            $logInfo->user_id = $userId;
            $logInfo->service = $serviceName;
            $logInfo->body_req = $bodyReq;
            $logInfo->http_response = $httpResp;
            $logInfo->ip_address = $request->ip();
            $logInfo->user_agent = $request->header('User-Agent');
            $logInfo->url = $request->url();
            $logInfo->description = '';
            $logInfo->save();

        } catch (\Exception $e){
            // Add error handling
        }

    }

}
