<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class FastSpringService
{
  public $client;
  public $baseUrl;

  public function __construct()
  {
    $this->client = Http::baseUrl('https://api.fastspring.com/')
      ->withHeaders([
        'accept' => 'application/json',
        'content-type' => 'application/json',
      ])
      ->withBasicAuth(config('fsportal.fastspring.username'), config('fsportal.fastspring.password'));
  }

  public function getAccount($account_id): array
  {
    $response = $this->client->get("accounts/$account_id", []);

    return $response->json();
  }

  public function getManagementUrl($account_id): string
  {
    $response = $this->client->get("accounts/$account_id/authenticate");

    return Arr::get($response->json()['accounts'][0], 'url');
  }

  public function getSubscription($subscription_id): array
  {
    $response = $this->client->get("subscriptions/$subscription_id");

    return $response->json();
  }

  // public function updateSubscriptionProduct(string $subscription_id, string $product_code): array
  // {
  //   $response = $this->client->post("subscriptions", [
  //     'subscriptions' => [
  //       [
  //         'subscription' => $subscription_id,
  //         'product' => $product_code,
  //         'quantity' => 1,                             // quantity of the new product
  //         'prorate' => true,
  //         'coupons' => ['BETANINJA99'],
  //       ]
  //     ]
  //   ]);

  //   return $response->json();
  // }

  // public function deleteSubscription(string $subscription_id)
  // {
  //   $response = $this->client->delete("subscriptions/$subscription_id");

  //   return [
  //     'success' => Arr::get($response, 'subscriptions.0.result') === 'success',
  //     'response' => $response,
  //   ];
  // }


  // public function getOrder($order_id): array
  // {
  //   $response = $this->client->get("orders/$order_id");

  //   return $response->json();
  // }


  // public function getProduct(string $plan_name)
  // {
  //   $response = $this->client->get("products/$plan_name");

  //   return $response->json();
  // }

  // public function requestEditUrl(string $account_id)
  // {
  //   $response = $this->client->get("accounts/$account_id/authenticate");

  //   return $response->json();
  // }

  public function updateAccount(string $account_id, array $data)
  {
    $response = $this->client->post("accounts/$account_id", $data);

    return $response->json();
  }
}
