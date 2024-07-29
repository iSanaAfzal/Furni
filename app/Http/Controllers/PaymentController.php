<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\Order;
use App\Models\Orders_detail;
use App\Models\Cart;
use App\Models\CartItems;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    //
public function process(Request $request)
{
    // Log the entire request for debugging
    // Validate the request data
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'state_country' => 'required|string|max:255',
        'postal_zip' => 'required|string|max:255',
        'email_address' => 'required|email|max:255',
        'phone_no' => 'required|string|max:255',
        'paymentMethodId' => 'required|string',
        'total_bill' => 'required|numeric'
    ]);
        //Save the form data
        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->address = $request->address;
        $order->state_country = $request->state_country;
        $order->postal_zip = $request->postal_zip;
        $order->email_address = $request->email_address;
        $order->phone_no = $request->phone_no;
        $order->total_bill = $request->total_bill;
        $order->payment_status = 'Paid';
        $order->user_id = Auth::id();
        $order->save();
        $cart=Cart::where('user_id',Auth::user()->id)->first();
        $cartitems=CartItems::where('cart_id',$cart->id)->get();
        foreach ($cartitems as $item) {
        $orderdetail = new Orders_detail();
        $orderdetail->order_id = $order->id;
        $orderdetail->product_id = $item->product_id;
        $orderdetail->Quantity = $item->quantity;
        $orderdetail->save();
        $item->delete();
    }
        $bill = $request->total_bill;
         $request->user()->charge(
            intval($bill),
            $request->paymentMethodId,
            ['return_url' => route('furni.thankyou')]
        );
         $customerEmail='sanaafzal.0985@gmail.com';
         Mail::to($customerEmail)->send(new ThankYouMail($customerEmail));
        return redirect()->route('furni.thankyou');
        return $request;

    }
}