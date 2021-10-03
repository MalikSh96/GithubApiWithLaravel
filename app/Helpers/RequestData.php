<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
class RequestData implements IRequestData
{
	/**
	 *
	 * @param string $username 
	 *
	 * @return mixed
	 */
	public function ApiDataRequester(string $username) 
    {
		//Make request to Github Api for speific user and return contents, if any
        $response = Http::get("https://api.github.com/users/{$username}/repos");
        // dd($response);
        if(!$response->successful())
            return null; //handle error here
        $repositories = $response->json();
        return $repositories;
	}
}
?>