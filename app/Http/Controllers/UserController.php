<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FastSpringService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me()
    {
        $user = User::find(1);
        $fs_service = new FastSpringService();
        $fastspring_account = $fs_service->getAccount($user->fs_account_id);
        $management_url = $fs_service->getManagementUrl($user->fs_account_id);
        $subscription = $fs_service->getSubscription('nvXALr7mSQqpBQcqqqFAcQ');


        return response()->json([
            'user' => $user,
            'fastspring_account' => $fastspring_account,
            'management_url' => $management_url,
            'subscription' => $subscription
        ]);
    }
}