<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Specialist;
class Recommendation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'specialist_id', 'comment', 'rating', 'service_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
    

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

}
