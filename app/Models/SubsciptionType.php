<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsciptionType extends Model
{
    protected $table = 'subscription_types';
    use HasFactory;

    public function usersubscription(){
        return $this->hasMany(UserSubscription::class,"id");
    }
}
