<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Pos extends Component
{
    public $products, $productName, $productCode, $qty,$price, $productyID, $carts, $title;
    public function render()
    {
        $this->products = Product::all();
        // $this->carts = session()->get('cart');
        $this->carts = \Cart::getContent();
        //  dd($this->carts );
        $this->title='sss';
        return view('livewire.pos');
    }
    public function category($id){
        $this->products = Product::where('category_id',$id)->get();
    }
    public function addCart($id)
    {
        $this->title=$id;
        $product=Product::find($id);
        \Cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'price' => $product->price,
            'quantity' => 1,
            'photo' => $product->photo
        ]);
        $this->carts = \Cart::getContent();
        session()->flash('success', 'Product is Added to Cart Successfully !');
        //$cart=  $this->carts;
        // if(isset($cart[$id])) {
        //     $cart[$id]['quantity']++;
        // }else{        
        //         $cart[$id]= [
        //                     "name" => $product->product_name,
        //                     "quantity" => 1,
        //                     "price" => $product->price,
        //                     "photo" => $product->photo                        
        //         ];
            
        // }
        // session()->put('cart', $cart);        
    }
    public function removeCart($id)
    {
        \Cart::remove($id);
        $this->carts = \Cart::getContent();
        session()->flash('success', 'Item Cart Remove Successfully !');
    }

    public function clearCart()
    {
        \Cart::clear();
        $this->carts = \Cart::getContent();
        session()->flash('success', 'All Item Cart Clear Successfully !');
    }
}
