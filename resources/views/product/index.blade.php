<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مدیریت محصولات
        </h2>
    </x-slot>

    <div class="flex justify-end">
        <a href="{{route('product.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"> تعریف محصول جدید </a>
    </div>
    <hr class="my-4">


    <form class="flex flex-wrap justify-center items-center">
        @admin
            <div class="w-1/4 my-3 px-3">
                <label class="block mb-2"> انتخاب فروشگاه </label>
                <select class="select2" name="s">
                    <option value=""> -- انتخاب کنید -- </option>
                    @foreach ($shops as $shop)
                        <option @if(request('s') == $shop->id) selected @endif value="{{$shop->id}}">{{$shop->title}}</option>
                    @endforeach
                </select>
            </div>
        @endadmin
        <div class="w-1/4 my-3 px-3">
            <x-jet-label for="t" value="عنوان" />
            <x-jet-input id="t" class="block mt-3 w-full" type="text" name="t" :value="request('t')" />
        </div>
        <div class="w-1/4 my-3 px-3">
            <label class="block mb-2"> مرتب سازی </label>
            <select class="w-full" name="o">
                <option value="1"> ارزانترین </option>
                <option value="2"> گران ترین </option>
                <option value="3"> جدیدترین </option>
                <option value="4"> قدیمی ترین </option>
            </select>
        </div>
        <div class="w-1/4 my-3 px-3">
            <label>
                <input type="checkbox" name="d" value="1">
                نمایش پاک شده ها
            </label>
        </div>
        <div class="w-1/4 my-3 px-3 text-center">
            <x-jet-button> جستجو </x-jet-button>
        </div>
    </form>


    @if ($products->count())

        <hr class="my-4">
        <table>
            <thead>
                <tr>
                    <th> # </th>
                    @admin
                        <th> فروشگاه </th>
                    @endadmin
                    <th> عنوان </th>
                    <th> قیمت </th>
                    <th> تخفیف </th>
                    <th> قیمت فروش </th>
                    <th> تصویر </th>
                    <th colspan="2"> عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <th> {{$key+1}} </th>
                        @admin
                        <td> {{$product->shop->title ?? '-'}} </td>
                        @endadmin
                        <td> {{$product->title}} </td>
                        <td> {{number_format($product->price)}} </td>
                        <td> {{$product->discount}} </td>
                        <td> {{number_format($product->cost)}} </td>
                        <td>
                            @if ($product->image)
                                <span class="text-green-500"> دارد </span>
                            @else
                                <span class="text-red-500"> ندارد </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('product.edit', $product->id)}}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-900 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                                ویرایش
                            </a>
                        </td>
                        <td>
                            <form action="{{route('product.destroy', $product->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-record inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



    @endif

</x-app-layout>