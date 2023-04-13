<div class = "flex flex-wrap my-5 -mx-2">
    <div class="w-full lg:w-2/5 min-h-screen shadow-lg px-8 ">
        <form>
            <div class="space-y-12">
              <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Product Detail</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
          
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Product Name</label>
                        <div class="mt-2">
                          <input type="text" name="product_name" wire:model="product_name" id="product_name" class="@error('product_name') ring-red-300 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          @error('product_name')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
              
                      <div class="sm:col-span-3">
                        <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Product Code</label>
                        <div class="mt-2">
                          <input type="text" name="product_code" wire:model="product_code" id="product_code" class=" @error('product_code') ring-red-300 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          @error('product_code')
                          <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      </div>
          
                  <div class="col-span-full">
                    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                      <textarea id="description" name="description" wire:model="description" rows="3" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"></textarea>
                    </div>
                    <p class="mt-3 text-sm leading-6 text-gray-600">Write a sentences about product.</p>
                  </div>
                  <div class="sm:col-span-3">
                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                    <div class="mt-2">
                      <select wire:model="category_id" id="category_id" name="category_id"  class="@error('category_id') ring-red-300 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option value="">Select</option>
                        @foreach ($categorys as $val)                       
                        <option value="{{$val->id}}">{{$val->category}}</option>
                        @endforeach
                      </select>
                      @error('category_id')
                          <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>
                  <div class="sm:col-span-3">
                    <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                    <div class="mt-2">
                      <input type="number" wire:model="price" id="price" name="price" class="@error('price') ring-red-300 @enderror block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                      @error('price')
                      <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>
                  <div class="col-span-full">
                    <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                        <input id="image" wire:model="image" name="image" type="file" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @if ($image)
                            Photo Preview:
                            <img src="{{ $image->temporaryUrl() }}">
                        @endif
                    <p class="mt-3 text-sm leading-6 text-gray-600">Write a sentences about product.</p>
                  </div>
                  
                </div>
              </div>
            </div>
          
            <div class="mt-6 flex items-center justify-end gap-x-6">
              <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
              <button  wire:click.prevent="storeProduct()" type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
          </form>
    </div>
    <div class="w-full lg:w-3/5 px-8 ">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Product List</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed publicly so be careful what you share.</p>
          <div class="mt-14 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach ($products as $item )
            <div class="group relative">
              <div class="min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                <img src="{{$item->image}}" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
              </div>
              <div class="mt-4 flex justify-between">
                <div>
                  <h3 class="text-sm text-gray-700">
                    <a href="#">
                      <span aria-hidden="true" class="absolute inset-0"></span>
                      {{$item->product_name}}
                    </a>
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">{{$item->product_code}}</p>
                </div>
                <p class="text-sm font-medium text-gray-900">{{$item->price}}</p>
              </div>
            </div>
            @endforeach
            <!-- More products... -->
          </div>
    </div>    
</div>
