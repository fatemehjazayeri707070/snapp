<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use App\Notifications\NewShop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        
        $shops = Shop::all();
        return view('shop.index', compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = new Shop;
        return view('shop.form', compact('shop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
           // validate request
           $data = $request->validate([
            'title' => 'required|string|between:3,100|unique:shops,title',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'telephone' => 'required|string|size:11',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,name',
            'address' => 'nullable',
        ]);

        // create user in db
        $randomPass = rand(1000, 9999);
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'role' => 'shop',
            'email_verified_at' => now(),
            'password' => bcrypt($randomPass),
        ]);

        // create shop in db
        Shop::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'telephone' => $request->telephone,
            'address' => $request->address,
        ]);
        //notify user
        $user->notify(new NewShop($user->email,$randomPass));

        // redirect
        return redirect()->route('shop.index')->withMessage( __('SUCCESS') );
    }


    public function edit(Shop $shop)
    {
        return view('shop.form', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $data = $request->validate([
            'title' => 'required|string|between:3,100|unique:shops,title,'.$shop->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'telephone' => 'required|string|size:11',
            'address' => 'nullable',
        ]);
        $shop->update($data);
        return redirect()->route('shop.index')->withMessage( __('SUCCESS') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        User::where('id', $shop->user_id)->delete();
        $shop->delete();
        return redirect()->route('shop.index')->withMessage( __('DELETED') );
    }
}
