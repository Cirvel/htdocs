<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "category_id", // foreign key
        "description",
        "quantity",
        "price",
    ] ;
    public function categoryFK() { // Allow category name to be found using the category_id in a row
        return $this->belongsTo(Categories::class,"category_id"); // SELECT * FROM category WHERE category.id = items.category_id
    }
}
