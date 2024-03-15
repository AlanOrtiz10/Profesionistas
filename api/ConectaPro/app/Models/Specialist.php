<?php

namespace App\Models;
use App\Models\Speciality;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'image', 'user_id', 'category_id', 'specialities_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialities(){
        return $this->belongsTo(Speciality::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
