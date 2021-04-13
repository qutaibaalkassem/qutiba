<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follower extends Model
{
    use HasFactory;

    public function from_user(){

        return $this->BelongsTo(User::class,'from_user_id');
    }

    public function to_user(){

        return $this->BelongsTo(User::class ,'to_user_id');
    }
}
