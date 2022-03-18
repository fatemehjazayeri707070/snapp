<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مدیریت محصولات
        </h2>
    </x-slot>

    @if ($product->image)
        <div class="flex justify-between">
            <h4> تصویر فعلی </h4>
            <img src="{{asset($product->image)}}" width="250px">
        </div>
        <hr class="my-4">
    @endif

    <form enctype="multipart/form-data" action="{{$product->id ? route('product.update', $product->id) : route('product.store')}}" method="POST">
        @csrf
        @if ($product->id)
            @method('PUT')
        @endif

        <div class="grid grid-cols-12 gap-4">

            <div class="col-span-3">
                <x-jet-label for="title" value="عنوان محصول" />
                <x-jet-input id="title" class="block mt-3 w-full" type="text" name="title" :value="$product->title ?? old('title')" required />
            </div>
            <div class="col-span-3">
                <x-jet-label for="price" value="قیمت" />
                <x-jet-input id="price" class="block mt-3 w-full" type="text" name="price" :value="$product->price ?? old('price')" required />
            </div>
            <div class="col-span-3">
                <x-jet-label for="discount" value="تخفیف" />
                <x-jet-input id="discount" class="block mt-3 w-full" type="text" name="discount" :value="$product->discount ?? old('discount')"  />
            </div>
            <div class="col-span-3">
                <x-jet-label for="image" value="تصویر" />
                <input type="file" id="image" class="mt-4" name="image">
            </div>
            <div class="col-span-12">
                <x-jet-label for="description" value="توضیحات" />
                <x-jet-input id="description" class="block mt-3 w-full" type="text" name="description" :value="$product->description ?? old('description')"  />
            </div>

        </div>

        <div class="flex justify-center mt-4">
            <x-jet-button> ذخیره </x-jet-button>
        </div>

    </form>


</x-app-layout>