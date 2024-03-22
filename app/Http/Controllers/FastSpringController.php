<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FastSpringService;
use Illuminate\Http\Request;

class FastSpringController extends Controller
{
    public $fs_service;

    public function __construct()
    {
        $this->fs_service = new FastSpringService();
    }


    public function updateAccount(Request $request, $accountId)
    {
        $payload = [
            'contact' => [],
        ];

        foreach ($request->all() as $key => $value) {
            $payload['contact'][$key] = $value ?? '';
        }

        $response_status = $this->fs_service->updateAccount($accountId, $payload);

        if ($response_status === 'success') return response()->json(['message' => 'Account updated successfully']);
        else return response()->json(['message' => 'Account update failed'], 500);
    }


    public function pauseSubscription($subscriptionId)
    {
        $response_status = $this->fs_service->pauseSubscription($subscriptionId);

        if ($response_status === 'success') return response()->json(['message' => 'Subscription paused successfully']);
        else return response()->json(['message' => 'Subscription pause failed'], 500);
    }

    public function resumeSubscription($subscriptionId)
    {
        $response_status = $this->fs_service->resumeSubscription($subscriptionId);

        if ($response_status === 'success') return response()->json(['message' => 'Subscription resumed successfully']);
        else return response()->json(['message' => 'Subscription resume failed'], 500);
    }


    public function accountCreatedWebhook(Request $request)
    {
        $payload = $request->all();

        $eventData = $payload['events'][0]['data'];

        $accountId = $eventData['account'];
        $contact = $eventData['contact'];
        $email = $contact['email'];

        User::where('email', $email)->update([
            'fs_account_id' => $accountId,
        ]);
    }
}
