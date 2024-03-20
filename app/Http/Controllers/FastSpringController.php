<?php

namespace App\Http\Controllers;

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

        $this->fs_service->updateAccount($accountId, $payload);
    }
}
