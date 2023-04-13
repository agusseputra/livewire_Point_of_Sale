<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Product as ProductModel;
use Livewire\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;
    public $products,$categorys, $product_name, $product_code, $category_id,$description,$price,$image, $update = false, $add = false;
    protected $listeners = [
        'deleteProductListner'=>'deleteProduct'
    ];
    protected $rules = [
        'product_name' => 'required',
        'product_code' => 'required',        
        'description' => 'required',
        'image' => 'image|max:1024'
    ];
    public function render()
    {
        $this->products = ProductModel::all();
        $this->categorys = Category::all();
        return view('livewire.product');
    }
    public function addPost()
    {
        $this->resetFields();
        $this->add = true;
        $this->update = false;
    }
     /**
      * store the user inputted post data in the posts table
      * @return void
      */
      
    public function storeProduct()
    {
        //dd($this->category_id);
        $this->validate();
        try {
            // $fileName = time().$request->file('feature_img')->getClientOriginalName();
            // //menggunakan fungsi storeAS untuk upload dan mengambil path upload
            // $path = $request->file('feature_img')->storeAs('photos',$fileName);
            $path=$this->image->store('images');
            ProductModel::create([
                'product_name' => $this->product_name,
                'product_code' => $this->product_code,
                'category_id' => $this->category_id,
                'description' => $this->description,
                'price' => $this->price,
                'image' => $path
            ]);
            session()->flash('success','Product Created Successfully!!');
            $this->resetFields();
            $this->products = ProductModel::all();
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
    }
    public function resetFields(){
        $this->product_name = '';
        $this->product_code = '';
        $this->category_id = '';
        $this->description = '';
        $this->price = '';
        $this->image = '';
    }
}
