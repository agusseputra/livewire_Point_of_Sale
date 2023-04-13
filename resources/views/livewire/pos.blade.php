<div class = "flex flex-wrap my-5 -mx-2">
  <!-- left section -->
  <div class="w-full lg:w-3/5 min-h-screen shadow-lg">
    <!-- header -->
    <div class="flex flex-row justify-between items-center px-5 mt-5">
      <div class="text-gray-800">
        <div class="font-bold text-xl">Simons's BQQ Team</div>
        <span class="text-xs">Location ID#SIMON123</span>
      </div>
      <div class="flex items-center">
        <div class="text-sm text-center mr-4">
          <div class="font-light text-gray-500">last synced</div>
          <span class="font-semibold">3 mins ago</span>
        </div>
        <div>
            <span
            class="px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded"
            >
            Help
          </div>
        </span>
      </div>
    </div>
    <!-- end header -->
    <!-- categories -->
    <div class="mt-5 flex flex-row px-5">
      <span
        class="px-5 py-1 bg-yellow-500 rounded-2xl text-white text-sm mr-4"
      >
        All items
      </span>
      <button wire:click="category(1)" class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4">
        Makanan
      </button>
      <button wire:click="category(2)" class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4">
        Minuman
      </button>
      <button wire:click="category(3)" class="px-5 py-1 rounded-2xl text-sm font-semibold mr-4">
        Snack
      </button>
    </div>
    <!-- end categories -->
    <!-- products -->
    <div class="grid grid-cols-3 gap-4 px-5 mt-5 overflow-y-auto h-3/4">      
      @foreach ($products as $product)    
      <a href="#" wire:click="addCart({{$product->id}})">
      <div class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between">
        <div>
          <div class="font-bold text-gray-800">{{$product->product_name}}</div>
          <span class="font-light text-sm text-gray-400">{{$product->description}}</span>
        </div>
        <div class="flex flex-row justify-between items-center">
          <span class="self-end font-bold text-lg text-yellow-500">{{$product->price}}</span>
          <img src="https://source.unsplash.com/sc5sTPMrVfk/600x600" class=" h-14 w-14 object-cover rounded-md" alt="">
        </div>
      </div>  
      </a>    
      @endforeach
    </div>
    <!-- end products -->
  </div>
  <!-- end left section -->
  <!-- right section -->
  <div class="w-full lg:w-2/5">
    <!-- header -->
    <div class="flex flex-row items-center justify-between px-5 mt-5">
      <div class="font-bold text-xl">Current Order</div>
      <div class="font-semibold">
       <a href="#" wire:click="clearCart()"> <span class="px-4 py-2 rounded-md bg-red-100 text-red-500" >Clear All</span></a>
        <span class="px-4 py-2 rounded-md bg-gray-100 text-gray-800">Setting</span>
      </div>
    </div>
    <!-- end header -->
    <!-- order list -->
    
    <div class="px-5 py-4 mt-5 overflow-y-auto h-64">
      @php $total=0;$disc=0;$tax=0;@endphp
      @if($carts != null)
      
      @foreach ($carts as $item)      
      @php $total+=$item['price']*$item['quantity'];@endphp
        <div class="flex flex-row justify-between items-center mb-4">
          <div class="flex flex-row items-center w-2/5">
            <img src="https://source.unsplash.com/4u_nRgiLW3M/600x600" class="w-10 h-10 object-cover rounded-md" alt="">
            <span class="ml-4 font-semibold text-sm">{{$item['name']}}</span>
          </div>
          <div class="w-32 flex justify-between">
            <span class="px-3 py-1 rounded-md bg-gray-300 ">-</span>
            <span class="font-semibold mx-4">{{$item['quantity']}}</span>
            <span class="px-3 py-1 rounded-md bg-gray-300 ">+</span>
          </div>
          <div class="font-semibold text-lg w-16 text-center">
            {{number_format($item['price']*$item['quantity'],0)}}
          </div>
        </div>     
        @endforeach    
        @endif  
    </div>
    <!-- end order list -->
    <!-- totalItems -->
    <div class="px-5 mt-5">
      <div class="py-4 rounded-md shadow-lg">
        <div class=" px-4 flex justify-between ">
          <span class="font-semibold text-sm">Subtotal</span>
          <span class="font-bold">{{number_format($total,0)}}</span>
        </div>
        <div class=" px-4 flex justify-between ">
          <span class="font-semibold text-sm">Discount</span>
          <span class="font-bold">- {{number_format($disc,0)}}</span>
        </div>
        <div class=" px-4 flex justify-between ">
          <span class="font-semibold text-sm">Sales Tax</span>
          <span class="font-bold">{{number_format(($total*15)/100,0)}}</span>
        </div>
        <div class="border-t-2 mt-3 py-2 px-4 flex items-center justify-between">
          <span class="font-semibold text-2xl">Total</span>
          <span class="font-bold text-2xl">{{number_format($total+(($total*15)/100),0)}}</span>
        </div>
      </div>
    </div>
    <!-- end total -->
    <!-- cash -->
    <div class="px-5 mt-5">
      <div class="rounded-md shadow-lg px-4 py-4">
        <div class="flex flex-row justify-between items-center">
          <div class="flex flex-col">
            <span class="uppercase text-xs font-semibold">cashless credit</span>
            <span class="text-xl font-bold text-yellow-500">$32.50</span>
            <span class=" text-xs text-gray-400 ">Available</span>
          </div>
          <div class="px-4 py-3 bg-gray-300 text-gray-800 rounded-md font-bold"> Cancel</div>
        </div>
      </div>
    </div>
    <!-- end cash -->
    <!-- button pay-->
    <div class="px-5 mt-5">
      <div class="px-4 py-4 rounded-md shadow-lg text-center bg-yellow-500 text-white font-semibold">
        Pay With Cashless Credit
      </div>
    </div>
    <!-- end button pay -->
  </div>
</div>