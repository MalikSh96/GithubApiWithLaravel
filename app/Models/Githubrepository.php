<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Githubrepository extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'repositoryname',
        'user_id',
        'html_url'
    ];

    //creating an eloquent relationship that ties back to the user model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
