<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'category_id', 'image', 'availability', 'specialist_id', 'user_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function specialist()
    {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
