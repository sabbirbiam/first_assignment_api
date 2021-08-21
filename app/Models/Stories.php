<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Registration as ModelsRegistration;

class Stories extends Model
{
    public $table = 'stories';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'story',
        'tags',  
        'section',  
        'storyimage',  
        'storycaption',  
        'blocked',  
    ];

    public function user()
    {
        return $this->belongsTo(ModelsRegistration::class);
    }

    public function comment()
    {
        return $this->hasMany(Posts::class, "story_id");
    }
}
