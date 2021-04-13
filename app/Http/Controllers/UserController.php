<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user=User::find(auth()->user()->id);
        return view('user.profile',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $userId = auth()->user()->id;
            $data = request()->validate([
                'name' => ['required' , 'min:3'],
                'first_name' => ['required' , 'min:3'],
                'last_name' => ['required' , 'min:3'],
                'email' => ['required' , 'email'],
                'password' => ['nullable' , 'confirmed' , 'min:8'],
                'avatar' =>['mimes:jpeg,jpg,png']
            ]);

            if (request()->has('password')){
                $data['password'] = Hash::make(request('password'));

            }

            if(request()->hasFile('avatar')){
                $path = request('avatar')->store('users');
                $data['avatar']=$path;

            }

            User::findOrFail($userId)->update($data);

            return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
