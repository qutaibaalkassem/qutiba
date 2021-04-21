<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{       

        public function user_info(Request $request){
            $user = User::find($request['id']);
            $posts = Post::where(["user_id"=>$request['id']])->limit(3)->get();
            $posts_counts = Post::where(["user_id" => $request['id']])->count();
            $likes_count = Like::whereIn('post_id' , Post::where(["user_id"=>$request['id']])->get()->pluck('id'))->count();
            $is_follower = Follower::where(["from_user_id"=>auth()->user()->id , "to_user_id"=>$request['id']])->get();
            
           return view('user/user_info' , compact('user' , 'posts' , 'posts_counts','likes_count','is_follower')) ;
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('id','!=',auth()->user()->id)->get();
        $requests=Follower::with('to_user')->where(["from_user_id"=>auth()->user()->id ,"accepted"=>0])->get();
        return view('follow_view/users',compact('users','requests'));
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
