<?php

namespace App\Helpers;

interface IDataBaseHandler 
{
    public function createUser(string $username);
    public function getUser(string $username);
    public function createUserWithRepos(string $repositoryname, int $user_id, string $url);
    public function getRepositoriesForUserByUsername(string $username);
}
?>