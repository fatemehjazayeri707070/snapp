<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مدیریت محصولات
        </h2>
    </x-slot>

    <form class="grid grid-cols-3 gap-4" action="{{$product->id ? route('product.update', $product->id) : route('product.store')}}" method="POST">
        @csrf
        @if ($product->id)
            @method('PUT')
        @endif


        <div class="col-start-2 col-end-3">
            <div class="flex justify-center">
                <x-jet-button> ذخیره </x-jet-button>
            </div>
        </div>

    </form>


</x-app-layout>