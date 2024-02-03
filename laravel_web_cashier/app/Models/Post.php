<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "body",
        "user_id",
    ] ;

    public function userFK() {
        return $this->belongsTo(User::class,"user_id");
        // return $this->belongsTo(User::class,"user_id","id")->where("user_id", $user_id)->first();
    }
}
