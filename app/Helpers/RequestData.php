<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

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
		try
		{
			//Make request to Github Api for specific user and return contents, if any
			$response = Http::get("https://api.github.com/users/{$username}/repos");
		} 
		catch (RequestException $ex) 
		{
			//Handle 3rd Party API Errors by Catching Their Exceptions
			abort(404, 'Github Repository not found');	
		}
		finally 
		{
			$repositories = $response->json();
        	return $repositories;
		}
	}
}
?>