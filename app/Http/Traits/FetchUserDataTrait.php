<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

trait FetchUserDataTrait {
    
    public function fetchUserData($user_id) {
        $user_id = (collect($user_id));
        
        $query = <<<GQL
        query  {
            user(where: {id: {_in: $user_id}}) {
              id
              phoneNumber
              email
              name
              language
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

    public function fetchUserDataForAll(){
        $query = <<<GQL
        query {
            user {
                id
                phoneNumber
                email
                name
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