<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration as ModelsRegistration;

class Posts extends Model
{
    public $table = 'posts';

    protected $fillable = [
        'id',
        'user_id',
        'comments',
        'story_id',
    ];

    public function story()
    {
        return $this->belongsTo(Stories::class);
    }

}
