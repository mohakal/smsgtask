<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    public function usertypesuser(){
        return $this->belongsTo(UserTypesUser::class,"id");
    }

    public function subscriptiontypes(){
        return $this->belongsTo(SubsciptionType::class,"subsciption_type_id");
    }
}
