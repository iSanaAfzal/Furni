<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItems;
use App\Models\User;
use Auth;

class FurniController extends Controller
{
   //View About Page
   public function about(){
    return view('Furni Layouts.about');
   }
    //View Blog Page
   public function blog(){
    return view('Furni Layouts.blog');
   }
      //View Services Page
   public function services(){
    return view('Furni Layouts.services');
   }
   //view Shop Page
   public function shop(){
   $approveproduct = Product::where('status', 'approve')->limit(8)->get();
   return view('Furni Layouts.shop',compact('approveproduct'));
   }
    //view contact page
   public function contact(){
    return view('Furni Layouts.contact');
   }
   //Display cart
    public function cart(){
    $cart=Cart::where('user_id',Auth::user()->id)->first();
    if($cart){
         // Calculate subtotal and total
          $cartitems=CartItems::where('cart_id',$cart->id)->with('product')->get();
        $subtotal = $cartitems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $total = $subtotal; // Assuming no additional fees for simplicit

         return view('Furni Layouts.cart',compact('cartitems','subtotal','total'));
}
}
public function update(Request $request, $id)
{
    $cartItem = CartItems::findOrFail($id);
    $action = $request->input('action');

    if ($action == 'increase') {
        $cartItem->quantity += 1;
    } elseif ($action == 'decrease' && $cartItem->quantity > 1) {
        $cartItem->quantity -= 1;
    }

    $cartItem->save();

    return redirect()->route('furni.cartshow')->with('success', 'Cart updated Successfully!');
}
public function productQuantity(Request $request, $id)
{
    $cartItem = CartItems::findOrFail($id);
    $action = $request->input('action');

    if ($action == 'increase') {
        $cartItem->increment('quantity');
    } elseif ($action == 'decrease' && $cartItem->quantity > 1) {
        // $cartItem->quantity -= 1;
        $cartItem->decrement('quantity');
    }

    // $cartItem->save();

    return $cartItem->load('product');
}
//Add To Cart
   public function addTocart($id){
    $cart=Cart::where('user_id',Auth::user()->id)->first();
    if(!$cart)

    {
        $cart=new Cart();
        $cart->user_id=Auth::user()->id;
        $cart->save();
}
$cartitems=new CartItems();
$cartitems->cart_id=$cart->id;
$cartitems->product_id=$id;
$cartitems->quantity=1;
$cartitems->save();
return redirect()->route('furni.cartshow');
}
//Remove cartItems
public function removecart($id){
  $cartItem = CartItems::where('id',$id);
 $cartItem->delete();
        return redirect()->back()->with('success', 'Item removed from cart');
}
//checkout
   public function checkout()
{
    // Get the authenticated user
    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->first();
   if ($cart) {
        $cartItems = CartItems::where('cart_id', $cart->id)->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
 return view('Furni Layouts.checkout', compact('cartItems', 'total'));
}

    //view thankyou
     public function thankyou(){
    return view('Furni Layouts.thankyou');
   }
    //view index
     public function index(){
  $approveproduct = Product::where('status', 'approve')->limit(3)->get();
   if (Auth::check()) {
        $user = Auth::user();
   if ($user->hasRole('admin')) {
            return redirect('/admindashboard');
        } elseif ($user->hasRole('seller')) {
            return redirect('/admindashboard');
        }
        else {
    return view('Furni Layouts.index',compact('approveproduct'));
    }
    } else {
    return view('Furni Layouts.index',compact('approveproduct'));
    }
 }

}