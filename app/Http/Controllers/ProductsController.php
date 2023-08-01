<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function showproducts(){
        $user = Auth::user();
        $products = Products::all()->random(5);
        $location = Products::all()->unique('Location');

        return view('pickdress',compact('products','location'));
    }

    public function productdetails($id){
        $products = Products::where('id',$id)->first();

        $faker = Faker::create('id_ID');
        $color = array();

        $size = ['Yes', 'No'];

        for($i = 0; $i < $faker->numberBetween(1,5); $i++){
            $color[$i] = $faker->rgbCssColor();
        }

        for($i = 0; $i < $faker->numberBetween(1,5); $i++){
            $sizes[$i] = $size[$faker->numberBetween(0,1)];
        }

        $products['AditionalColor'] = $color;
        $products['AditionalSize'] = $sizes;

        $countColor = count($products->AditionalColor);
        $countSize = count($products->AditionalSize);

        return view('checkout',compact('products','countColor','countSize'));
    }

    public function filtering(Request $request){
        $filtering = $request->all();
        $products = Products::where('Location',$filtering['location'])->where("Prices",">=",$filtering['MinPrice'])->where("Prices",">=",$filtering['MaxPrice'])->take(5)->get();
        $location = Products::all()->unique('Location');

        return view('pickdress',compact('products','location'));
    }

    public function dataecommerce(){
        $user = Auth::user();
        $products = Products::paginate(9);
        return view('Ecommerce',compact('products'));
    }

    public function generateRandomPrice()
    {
        $minPrice = 100000;
        $maxPrice = 300000;
        $randomPrice = number_format(round(rand($minPrice * 100, $maxPrice * 100) / 100, 2));

        return response()->json(['harga' => $randomPrice]);
    }
}
