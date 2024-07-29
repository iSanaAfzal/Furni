<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Orders_detail;
use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    //dashboard view
    public function dashboard(){
        $user=User::count();
        $products=Product::where('status','approve')->count();
        return view('Admin.dashboard',compact('user','products'));
    }
    //Users View
    public function users(){
      $users = User::where('email', '!=', 'admin@gmail.com')->get();

     return view('Admin.Users',compact('users'));
    }
    //Auth Logout
     public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Successfully logged out');
    }
    //View Product Page
    public function Product(){
        $Products=Product::all();
        return view('Admin.Products',compact('Products'));
    }
    //Productform view
    public function productform(){
        $categories=Category::all();
        return view('Admin.productform',compact('categories'));
    }
    //Store Product
    public function productstore(Request $request){

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);



        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Create a new product
        $product = new Product();
        $product->name = $request->name;
        $product->image = $imagePath;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        // Redirect back with success message
        return redirect()->route('admin.product')->with('success', 'Product added successfully');
    }
//Approve Product
public function approve(Product $id){
    $id->status = 'approve';
    $id->save();
    return redirect()->back()->with('Sucess','Product Approved Successfully');
}
//Reject Product
public function reject(Product $id){
    $id->status = 'reject';
    $id->save();
    return redirect()->back()->with('Sucess','Product Rejected Successfully');
}

public function destroy($id){
$deleteproduct=Product::where('id',$id)->first();
$deleteproduct->delete();
return redirect()->route('admin.product',compact('deleteproduct'))->with('success', 'Product deleted successfully');

}
//Edit Function
public function editproduct($id){
$product=Product::where('id',$id)->first();
$category=Category::all();
return view('Admin.Edit',compact('product','category'));
}
//Update Products
// Update Product
public function productUpdate(Request $request, $id){
    // Validate the incoming request data

    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
    ]);


    // Find the existing product
    $product = Product::findOrFail($id);


    // Handle the image upload
    if ($request->hasFile('image')) {
        // Optionally delete the old image if you want to
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Store the new image
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    // Update the product with new data
    $product->name = $request->name;
    $product->price = $request->price;
    $product->category_id = $request->category_id;
    $product->save();

    // Redirect back with success message
    return redirect()->route('admin.product')->with('success', 'Product updated successfully');
}
//OrderDetails
public function orderdetails(){
    $orderdetails=Orders_detail::all();
    return view('Admin.OrderDetails',compact('orderdetails'));
}

}