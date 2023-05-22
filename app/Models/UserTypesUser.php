<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypesUser extends Model
{
    use HasFactory;
    public function users() {
        return $this->belongsTo(User::class);
    }
    public function usertype() {
        return $this->belongsTo(UserType::class,"user_type_id");
    }

    public function usersubscription(){
        return $this->hasOne(UserSubscription::class,"user_types_user_id");
    }
}
