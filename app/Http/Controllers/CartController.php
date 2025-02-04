<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Country;
use App\Models\Order;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\ShippingCharge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::with('product_images')->find($request->id);

        if ($product == null) {
            return response()->json([
                "status"=> false,
                "message"=> "Product not found"
            ]);
        }

        if (Cart::count() > 0) {
            //echo "Product already in cart";
            //Product found in cart
            //Check if this product already in the cart
            //Return a message that product already added in your cart
            //if product not found in the cart, then add product in cart

            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }

            if($productAlreadyExist == false){
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '' ]);
                $status = true;
                $message = '<strong>'.$product->title.'</strong> added in your cart successfully.';
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = $product->title.' already added in cart';
            }

        } else {
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '' ]);
            $status = true;
            $message = '<strong>'.$product->title.'</strong> added in your cart successfully.';
            session()->flash('success', $message);
        }

        return response()->json([
            "status"=> $status,
            "message"=> $message
        ]);
    }

    public function cart(){
        $cartContent = Cart::content();
        $data['cartContent'] = $cartContent;

        return view('front.cart.index',$data);
    }

    public function updateCart(Request $request){
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);

        //check qty available in stock
        if($product->track_qty == "Yes"){
            if($qty <= $product->qty ){
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully';
                $state = true;
                session()->flash('success',$message);
            } else {
                $message = 'Requested qty('.$qty.') not available in stock.';
                $state = false;
                session()->flash('error',$message);
            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully';
            $state = true;
            session()->flash('success',$message);
        }

        return response()->json([
            "status"=> $state,
            "message"=> $message
        ]);
    }

    public function deleteItem(Request $request){

        $rowId = $request->rowId;
        $itemInfo = Cart::get($rowId);

        if($itemInfo == null ){
            $errorMessage = 'Item not found in cart.';
            session()->flash('error',$errorMessage);
            return response()->json([
                "status"=> false,
                "message"=> $errorMessage,
            ]);
        }

        Cart::remove($request->rowId);

        $success = 'Item removed from cart successfully.';
        session()->flash('success',$success);
        return response()->json([
            "status"=> true,
            "message"=> $success,
        ]);
    }

    public function checkout(){
        $discount = 0;

        //if cart is empty redirect to cart page
        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        //if user is not logged in then redirect to login page
        // if (Auth::check() == false) {
        //     if (!session()->has('url.intended')) {
        //         session(['url.intended' => url()->current()]);
        //     }
        //     return redirect()->route('user.home');
        // }

        //$customerAddress = CustomerAddress::find(Auth::user()->id);

        session()->forget('url.intended');

        $countries = Country::orderBy('name','ASC')->get();

        //Calcuting shipping charges
        // if($customerAddress != '' ){
        //     $userCountry = $customerAddress->country_id;
        //     $shippingInfo = ShippingCharge::where('country_id', $userCountry)->first();

        //     //echo $shippingInfo->amount;
        //     $totalQty = 0;
        //     $totalShiipingCharge = 0;
        //     $grandTotal = 0;
        //     foreach (Cart::content() as $item){
        //         $totalQty += $item->qty;
        //     }

        //     $totalShiipingCharge = $totalQty*$shippingInfo->amount;
        //     $grandTotal = Cart::subtotal(2,'.','')+$totalShiipingCharge;

        // } else {
        //     $grandTotal = Cart::subtotal(2,'.','');
        //     $totalShiipingCharge = 0;
        // }

        return view('front.checkout.index',[
            'countries' => $countries,
            //'customerAddress' => $customerAddress,
            //'totalShiipingCharge' => $totalShiipingCharge,
            'discount' => $discount,
            //'grandTotal' => $grandTotal
        ]);
    }


    public function thankyou($id){
        return view('front.checkout.thanks',[
            'id' => $id,
        ]);
    }

    public function getOrderSummary(Request $request){

        $subTotal = Cart::subtotal(2,'.','');
        $discount = 0;
        $discountString = '';

        //Appy Discount start here
        if (session()->has('code')) {
            $code = session()->get('code');

            if($code->type == 'percent'){
                $discount = ($code->discount_amount/100)*$subTotal;
            } else {
                $discount = $code->discount_amount;
            }

            $discountString = '<div class="mt-4" id="discount-response">
                <strong>'.session()->get('code')->code.'</strong>
                <a class="btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
            </div>';
        }
        //Appy Discount end here


        if($request->country_id > 0){

            $shippingInfo = ShippingCharge::where('country_id', $request->country_id)->first();

            $totalQty = 0;
            foreach (Cart::content() as $item){
                $totalQty += $item->qty;
            }

            if ($shippingInfo != null) {

                $shippingCharge = $totalQty*$shippingInfo->amount;
                $grandTotal = ($subTotal-$discount)+$shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2),
                ]);
            } else {

                $shippingInfo = ShippingCharge::where('country_id','rest_of_world')->first();
                $shippingCharge = $totalQty*$shippingInfo->amount;
                $grandTotal = ($subTotal-$discount)+$shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2),
                ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'grandTotal' => number_format(($subTotal-$discount),2),
                'discount' => number_format($discount,2),
                'discountString' => $discountString,
                'shippingCharge' => number_format(0,2),
            ]);
        }
    }

    public function applyDiscount(Request $request){
        $code = DiscountCoupon::where('code', $request->code)->first();

        if($code == null){
            return response()->json([
                'status' => false,
                'message' => 'Invalid discount coupon',
            ]);
        }

        //Check if coupon start date is valid or not
        $now = Carbon::now();

        if($code->starts_at != ""){
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s',$code->starts_at);

            if($now->lt($startDate)){
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon',
                ]);
            }
        }

        if($code->expires_at != ""){
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s',$code->expires_at);

            if($now->gt($endDate)){
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon',
                ]);
            }
        }

        //Max uses check start here
        if($code->max_uses > 0){
            $couponUsed = Order::where('coupon_code_id', $code->id)->count();

            if($couponUsed >= $code->max_uses){
                return response()->json([
                    'status' => false,
                    'message' => 'Discount code expired.',
                ]);
            }
        }

        //Max uses user check start here
        if($code->max_uses_user > 0){
            $couponUsedByUser = Order::where(['coupon_code_id' => $code->id, 'user_id' => Auth::user()->id ])->count();

            if($couponUsedByUser >= $code->max_uses_user){
                return response()->json([
                    'status' => false,
                    'message' => 'You already used this coupon!',
                ]);
            }
        }

        $subTotal = Cart::subtotal(2,'.','');

        //Min amount condition check
        if($code->min_amount > 0){
            if($subTotal < $code->min_amount){
                return response()->json([
                    'status' => false,
                    'message' => 'Your min amount must be ₹ '.$code->min_amount.'.00',
                ]);
            }
        }


        session()->put('code',$code);

        return $this->getOrderSummary($request);
    }

    public function removeCoupon(Request $request){
        session()->forget('code');
        return $this->getOrderSummary($request);
    }






    //Razorpay
    public function razorpayPayment(Request $request){
        if(isset($request->razorpay_payment_id) && $request->razorpay_payment_id != ''){

            $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            $response = $payment->capture(array('amount'=>$payment->amount));

            $payment = new Payment();
            $payment->payment_id = $response['id'];
            $payment->product_name = $response['notes']['product_name'];
            $payment->quantity = $response['notes']['quantity'];
            $payment->amount = $response['amount']/1000;
            $payment->currency = $response['currency'];
            $payment->customer_name = $response['notes']['customer_name'];
            $payment->customer_email = $response['notes']['customer_email'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = 'Razorpay';
            $payment->save();

            return redirect()->route('checkout.success');

        } else {
            return redirect()->route('checkout.failed');
        }
    }

    public function razorpaySuccess(){
        return view("front.checkout.success");
    }

    public function razorpayFailed(){
        return view("front.checkout.failed");
    }
}
