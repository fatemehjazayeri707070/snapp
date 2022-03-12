<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مدیریت فروشنده ها
        </h2>
    </x-slot>

    <form class="grid grid-cols-3 gap-4" action="{{$shop->id ? route('shop.update', $shop->id) : route('shop.store')}}" method="POST">
        @csrf

        @if ($shop->id)
            @method('PUT')
        @endif
        <div>
            <x-jet-label for="title" value="عنوان فروشگاه" />
            <x-jet-input id="title" class="block mt-3 w-full" type="text" name="title" :value="$shop->title ?? old('title')" required autofocus />
        </div>
        <div>
            <x-jet-label for="first_name" value="نام" />
            <x-jet-input id="first_name" class="block mt-3 w-full" type="text" name="first_name" :value="$shop->first_name ?? old('first_name')" required />
        </div>
        <div>
            <x-jet-label for="last_name" value="نام خانوادگی" />
            <x-jet-input id="last_name" class="block mt-3 w-full" type="text" name="last_name" :value="$shop->last_name ?? old('last_name')" required />
        </div>
        <div>
            <x-jet-label for="telephone" value="شماره تماس" />
            <x-jet-input id="telephone" class="block mt-3 w-full" type="text" name="telephone" :value="$shop->telephone ?? old('telephone')" required />
        </div>
        @unless($shop->id)
            <div>
                <x-jet-label for="email" value="ایمیل" />
                <x-jet-input id="email" class="block mt-3 w-full" type="text" name="email" :value="$shop->email ?? old('email')" required />
            </div>
            <div>
                <x-jet-label for="username" value="نام کاربری" />
                <x-jet-input id="username" class="block mt-3 w-full" type="text" name="username" :value="$shop->username ?? old('username')" required />
            </div>
        @endunless
        <div class="col-span-3">
            <x-jet-label for="address" value="آدرس" />
            <x-jet-input id="address" class="block mt-3 w-full" type="text" name="address" :value="$shop->address ?? old('address')" />
        </div>


        <div class="col-start-2 col-end-3">
            <div class="flex justify-center">
                <x-jet-button> ذخیره </x-jet-button>
            </div>
        </div>

    </form>


</x-app-layout>