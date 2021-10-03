<?php

namespace App\Helpers;

interface IDataBaseHandler 
{
    public function createUserWithRepos(string $repositoryname, string $username, string $url);
    public function getSingleUserByUsernameFromDB(string $username);
    public function getRepositoriesForUserByUsername(string $username);
}
?>