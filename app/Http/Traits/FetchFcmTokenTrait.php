<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait FetchFcmTokenTrait {
    
    public function fetchFcmTokenByUser($user_id) {
        $user_id = (collect($user_id));

        $query = <<<GQL

        query {
            fcm_table(where: {user_id: {_in: $user_id}}) {
               fcm_token
            }
        }

        GQL;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-hasura-admin-secret' => env('API_GATEWAY_ADMIN_SECRET'),
        ])->post(env('API_GATEWAY_ENDPOINT'), [
            'query' => $query
        ]);
        
        return $response->json();
    }

    public function fetchAllFCM(){
        $query = <<<GQL
        query {
            fcm_table {
                fcm_token
            }
        }
        GQL;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-hasura-admin-secret' => env('API_GATEWAY_ADMIN_SECRET'),
        ])->post(env('API_GATEWAY_ENDPOINT'), [
            'query' => $query
        ]);

        return $response->json();
    }
}