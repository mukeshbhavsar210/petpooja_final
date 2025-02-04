<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function sub_category(){
        return $this->hasMany(Menu::class);
    }

    public function menus(){
        return $this->hasMany(Menu::class);
    }

    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }
}
