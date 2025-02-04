<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;   
    
    public function seat(){
        return $this->belongsTo(Order::class, 'id');
    }

    public function area(){
        return $this->belongsTo(Area::class, 'id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'id');
    }

    public function assigned_seat(){
        return $this->hasMany(Order::class);
    }


    // public function assigned_seat(){
    //     return $this->belongsTo(Order::class, 'seat_id');
    // }
    
    // public function assigned_seat(){
    //     return $this->belongsTo(Order::class, 'seat_id', );
    // }

    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
