<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
