<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\UserProducts;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->role == 'admin'){
            //Get count of verified user
            $data['verifiedUsers'] = User::verified()->count();

            //Count of active and verified users who have attached active products.
            $data['verifiedUsersActiveProducts'] = User::verified()
                            ->whereHas('userProducts.activeProduct')->count();

            //Count of all active products (just from products table).
            $data['activeProducts'] = Product::where('status','active')->count();

            // Count of active products which don't belong to any user.
            $data['activeProductsNoUserBelongs'] = Product::whereHas('userProduct')
                                                        ->where('status','active')
                                                        ->count();

            //Amount of all active attached products //Summarized price of all active attached products //Summarized prices of all active products per user
            $data['activeAttachedProductCount'] = $this->getactiveAttachedProductPriceCount();

            //The exchange rates for USD and RON based on Euro
            $data['fetchExchangeRateAPI'] = $this->fetchExchangeRateAPI();

    
            return view('dashboard',compact('data'));
        
        }else{
            //list all products
            $products = Product::all();

            //fetch loggedin user added products with quantity and prices
            $userproducts = UserProducts::with(['product'])->where('user_id',Auth::user()->id)->get();

            //pass data to view
            return view('user_dashboard',compact('products','userproducts'));
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveUserProduct(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        
        $checkExist = UserProducts::where(['user_id' => Auth::user()->id , 'product_id'=>$request->product_id])
                            ->first();

        if($checkExist){
            //add id in request and update in DB
            $entry = UserProducts::updateEntry(array_merge($request->all(), ['id' => $checkExist->id]));
            $message = 'User Product updated successfully.';
        }else{
            //add user_id in request and save in DB
            $entry = UserProducts::createEntry(array_merge($request->all(), ['user_id' => Auth::user()->id]));
            $message = 'User Product added successfully.';
        }

        return redirect()->route('home')
                        ->with('success',$message);
    }


     //Amount of all active attached products //Summarized price of all active attached products //Summarized prices of all active products per user
    public function getactiveAttachedProductPriceCount()
    {
        $count = 0 ; $price = 0; $userArray = [];
        $result = User::verified()
                    ->with('userProducts.activeProduct')
                    ->whereHas('userProducts.activeProduct');   
                    
        if($result->count()>0){
            foreach ($result->get() as $key => $res) {
                $userPrice = 0;
                foreach ($res->userProducts as $key => $pro) {
                   
                   if($pro->activeProduct){
                        $count += $pro->quantity;
                        $price += $pro->quantity * $pro->price;
                        $userPrice += $pro->quantity * $pro->price;
                   }
                }
                $userArray[$res->name] = $userPrice;
            }

        }
        $arr['price'] = $price;
        $arr['count'] = $count;
        $arr['priceProductsPerUser'] = $userArray;
       
        return $arr;
    }

    //exchange rates for USD and RON based on Euro using https://exchangeratesapi.io/ .
    public function fetchExchangeRateAPI()
    {
        $accesKey = '939c546d6314336ef1f89c3c6bb5a830';//access key  which works only 250 times in a day
        $url = 'http://api.exchangeratesapi.io/v1/latest?access_key='.$accesKey.'& symbols=USD,RON';
        $response = file_get_contents($url);
        $response = json_decode($response);
        if($response->success){
            return $response->rates;
        }else{
            return array() ;  
        }
    }
}
