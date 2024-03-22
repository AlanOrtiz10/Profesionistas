<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'phone', 
        'email', 
        'additional_details', 
        'service_id', 
        'specialist_id', 
        'user_id', 
        'order_status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
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
