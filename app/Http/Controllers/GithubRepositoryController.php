<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\GithubUser;
use App\Models\Githubrepository;
use App\Helpers\IRequestData;
use App\Helpers\IDataBaseHandler;

class GithubRepositoryController extends Controller
{
    protected $requestData;
    protected $databaseHandler;
    //by this point, Laravel knows that IRequestData should be resolved as RequestData, same goes for IDatabaseHandler
    public function __construct(IRequestData $requestData, IDataBaseHandler $databaseHandler)
    {
        $this->requestData = $requestData;
        $this->databaseHandler = $databaseHandler;
    }

    public function search()
    {
        return view('repositories.search');
    }

    //this one is the "fully" implementation that use either database or github api
    public function getRepositoriesForUsername(Request $request)
    {
        /*  Objective:
            Make sure the input is "correct", check if user already is in 
            db, if yes, retrieve info from db, if not, request from Github API
            and create a corresponding user with repositories
        */
        //makes sure that we have to input a username
        $this->validate($request, [
            'username' => 'required',
        ]);
        $username = $request->username; //accessing the username field
        //check if user exists in db with repos
        $checkUsername = $this->databaseHandler->getUser($username);
        if($checkUsername !== null)
        {
            $repos = $this->databaseHandler->getRepositoriesForUserByUsername($checkUsername->username);
            return view('repositories.dbindex', [
                'repos' => $repos->repositories,
                'user' => $checkUsername->username
            ]);
        }
        else 
        {
            $result = $this->requestData->ApiDataRequester($username);
            if($result === null)
                return view('error'); //perhaps make a different error handling, for example laravels build in "abort(404)"
            else
            {
                $datas = $result;
                $user = $this->databaseHandler->createUser($username);
                foreach($datas as $data)
                {
                    $this->databaseHandler->createUserWithRepos($data['name'], $user->id, $data['html_url']);
                }
                return view('repositories.index', compact('datas', 'username')); //compact can be used to pass data between controller and view
            }
        }
    }
    
    // public function createUserWithRepos(string $repositoryname, string $username, string $url)
    // {
    //     //Objective: Create data for user and repositories
    //     //No need to return anything, since we are only creating
    //     Githubrepository::create([
    //         'repositoryname' => $repositoryname,
    //         'username' => $username,
    //         'html_url' => $url
    //     ]); //eloquent
    // }

    // public function getSingleUserByUsernameFromDB(string $username)
    // {
    //     //Objective: Return single user by username
    //     //since we only need 1 "user", we use first(), this returns only one record, which is what we need
    //     return $username = Githubrepository::where('username', $username)->first();
    // }

    // public function getRepositoriesForUserByUsername(string $username)
    // {
    //     //Objective: Return a list a repos where the username is the requested one
    //     //returns all list from db for given username -- is a laravel collection
    //     $repos = Githubrepository::get()->where('username', $username); 
    //     return $repos;
    // }

    //this get directly without database involved -- part 1 of implementation
    // public function getRepositories(Request $request)
    // {
    //     //makes sure that we have to input a username
    //     $this->validate($request, [
    //         'username' => 'required',
    //     ]);
    //     // dd('IN GET REPO NORMAL'); 
    //     $username = $request->username; //accessing the username field
    //     $result = $this->requestData->ApiDataRequester($username);
    //     // $result = $this->ApiDataRequester($username);
    //     $datas = $result;
    //     if($result === null) //if request is null -- ie if the user does not exist -- error handle this when possible
    //         return view('error');
    //     else if(count($result) > 0) //if we get a response with content
    //         return view('repositories.index', compact('datas', 'username')); //compact can be used to pass data between controller and view
    // }

    //move this to a "service" file of its own when possible
    // public function ApiDataRequester(string $username)
    // {
        //     $response = Http::get("https://api.github.com/users/{$username}/repos");
    //     // dd($response);
    //     if(!$response->successful())
    //         return null; //handle error here
    //     $repositories = $response->json();
    //     return $repositories;
    // }
}
