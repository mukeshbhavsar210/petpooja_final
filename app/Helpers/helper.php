<?php

use App\Mail\OrderEmail;
use App\Models\Area;
use App\Models\Category;
use App\Models\Country;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Page;
use App\Models\ProductImage;
use App\Models\Seat;
use App\Models\Seating;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

function getCategories(){
    return Category::orderBy('name','ASC')->with('sub_category')->take(4)->orderBy('id','DESC')->get();
}
    
function getProducts(){
    return Menu::orderBy('name','ASC')->orderBy('id','DESC')->get();
}  

function getSeats(){
    return Seat::orderBy('table_name','ASC')->with('area')->orderBy('id','DESC')->get();
}  

function getProductImage($productId){
    return ProductImage::where('product_id',$productId)->first();
}

function orderEmail($orderId, $userType="customer"){
    $order = Order::where('id',$orderId)->with('items')->first();

    if($userType == 'customer'){
        $subject = 'Thanks for your order';
        $email = $order->email;
    } else {
        $subject = 'You have received an order';
        $email = env('ADMIN_EMAIL');
    }

    $mailData = [
        'subject' => $subject,
        'order' => $order,
        'userType' => $userType,
    ];

    Mail::to($email)->send(new OrderEmail($mailData));
}

function getCountryInfo($id){
    return Country::where('id',$id)->first();
}

function staticPages(){
    $pages = Page::orderBy('name','ASC')->get();
    return $pages;
}
?>
