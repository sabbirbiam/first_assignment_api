<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    public $table = 'registration';

    protected $fillable = [
        'id',
        'name',
        'email',
        'dob',
        'password',
        'gender',
        'phone',
        'deleted_by',
        'created_by',
        'updated_by',
    ];

    public function stories()
    {
        return $this->hasMany(Stories::class, "user_id");
    }

}
