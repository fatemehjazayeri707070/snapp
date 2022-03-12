<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    salam4
    <div class="flex justify-end">
        <a href="{{route('shop.create')}}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            تعریف فروشنده جدید </a>
    </div>

    @if ($shops->count())

    <hr class="my-4">

    <table>
        <thead>
            <tr>
                <th> # </th>
                <th> عنوان </th>
                <th> نام شخص </th>
                <th> تلفن </th>
                <th> ایمیل </th>
                    <th> نام کاربری </th>
                    <th> تاریخ شروع فعالیت </th>
                    <th colspan="2"> عملیات </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shops as $key => $shop)
                    <tr>
                        <th> {{$key+1}} </th>
                        <td> {{$shop->title}} </td>
                        <td> {{$shop->full_name}} </td>
                        <td> {{$shop->telephone}} </td>
                        <td> {{$shop->user->email ?? '-'}} </td>
                        <td> {{$shop->user->name ?? '-'}} </td>
                        <td> {{persianDate($shop->created_at)}} </td>
                        <td>
                            <a href="{{route('shop.edit', $shop->id)}}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-900 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                                ویرایش
                            </a>
                        </td>
                        <td>
                            <form action="{{route('shop.destroy', $shop->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
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