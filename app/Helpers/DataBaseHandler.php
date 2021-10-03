<?php

namespace App\Helpers;
use App\Models\Githubrepository;
use App\Models\Githubuser;
use App\Models\User;

class DataBaseHandler implements IDataBaseHandler
{
	/**
	 *
	 * @param string $username 
	 *
	 * @return mixed
	 */
	public function createUser(string $username)
	{
		//Objective: Create a user
		$user = User::create([
			'username' => $username
		]);
		return $user;
	}

	/**
	 *
	 * @param string $username 
	 *
	 * @return mixed
	 */
	public function getUser(string $username)
	{
		//Objective: Return single user by username
        //since we only need 1 "user", we use first(), this returns only one record, which is what we need
        return $username = User::where('username', $username)->first();
	}

	/**
	 *
	 * @param string $repositoryname 
	 * @param string $username 
	 * @param string $url 
	 *
	 * @return mixed
	 */
	function createUserWithRepos(string $repositoryname, int $user_id, string $url) 
    {
        //Objective: Create data for user and repositories
        //No need to return anything, since we are only creating
        Githubrepository::create([
            'repositoryname' => $repositoryname,
            'user_id' => $user_id, //this needs to refer to a user tables user id
            'html_url' => $url
        ]); //eloquent
	}
	
	/**
	 *
	 * @param string $username 
	 *
	 * @return mixed
	 */
	function getRepositoriesForUserByUsername(string $username) 
    {
        //Objective: Return a list a repos where the username is the requested one
        //returns all list from db for given username
		//By using ::with we are doing eager loading and avoiding "many" sql queries
        $repos = User::with('repositories')->where('username', $username)->first();
        return $repos;
	}
}
?>