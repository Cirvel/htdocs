<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struk extends Model
{
    use HasFactory;
    protected $fillable = [
        "customer_name",
        "item_id",
        "amount",
    ] ;

    public function usersFK() {
        return $this->belongsTo(User::class,"users_id");
    }
    public function itemsFK() {
        return $this->belongsTo(Items::class,"items_id");
    }
    public function registersFK() {
        return $this->belongsTo(Registers::class,"registers_id");
    }
}
