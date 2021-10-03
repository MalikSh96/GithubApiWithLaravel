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
        'username',
        'html_url'
    ];

    //creating a relationship that ties back to the githubuser model
    public function githubuser()
    {
        return $this->belongsTo(Githubuser::class);
    }
}
