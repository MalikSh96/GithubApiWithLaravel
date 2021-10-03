<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Githubuser extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
    ];

    // //Setting up first Eloquent relationship
    // //you just define it out as a method on the user model (or whichever model needs the relationship)
    // public function repositories()
    // {
    //     //return $this->hasMany(NameOfRelationshipModel::class)
    //     return $this->hasMany(Githubrepository::class);
    // }

}
