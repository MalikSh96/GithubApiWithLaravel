<?php

namespace App\Helpers;
use App\Models\Githubrepository;

class DataBaseHandler implements IDataBaseHandler
{

	/**
	 *
	 * @param string $repositoryname 
	 * @param string $username 
	 * @param string $url 
	 *
	 * @return mixed
	 */
	function createUserWithRepos(string $repositoryname, string $username, string $url) 
    {
        //Objective: Create data for user and repositories
        //No need to return anything, since we are only creating
        Githubrepository::create([
            'repositoryname' => $repositoryname,
            'username' => $username,
            'html_url' => $url
        ]); //eloquent
	}
	
	/**
	 *
	 * @param string $username 
	 *
	 * @return mixed
	 */
	function getSingleUserByUsernameFromDB(string $username) 
    {
        //Objective: Return single user by username
        //since we only need 1 "user", we use first(), this returns only one record, which is what we need
        return $username = Githubrepository::where('username', $username)->first();
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
        //returns all list from db for given username -- is a laravel collection
        $repos = Githubrepository::get()->where('username', $username); 
        return $repos;
	}
}
?>