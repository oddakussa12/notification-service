<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Jobs\JobRelated\SendJobCreatedSMSJob;

use Illuminate\Support\Facades\Log;

class JobNotificationController extends Controller
{

    public function sendJobPreferenceNotification(Request $request)
    {
        $tags = $request->tags;
        $tags = (collect($tags));
        
        $query = <<<GQL
        query MyQuery {
            job_market_preference(where: {tags: {_contained_in: $tags }}) {
              categories
              tags
              created_by
            }
          }
        GQL;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-hasura-admin-secret' => env('API_GATEWAY_ADMIN_SECRET'),
        ])->post(env('API_GATEWAY_ENDPOINT'), [
            'query' => $query
        ]);


        // send notification for the users
        $users = $response->json();

        $users_id = [];

        foreach($users['data']['job_market_preference'] as $user) {
          $users_id = $user['created_by'];
        }

        SendJobCreatedSMSJob::dispatch($users_id, $request->tags);

        return $response->json();
    }
}
