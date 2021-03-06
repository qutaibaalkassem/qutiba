<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Follower;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function userPosts(Request $request){

        $posts=POST::where('user_id',auth()->user()->id)->get();
        return view('post_views/user_posts',compact('posts'));
    }

    public function userFriendPosts($id){
       // $is_follower = Follower::where(["from_user_id" =>auth()->user()->id , "to_user_id" =>$id , "accepted" => 1])->get();
        if(policy(Post::class)->show_friend(auth()->user() , $id)){
            $posts=Post::withCount('likes')->where(["user_id"=>$id])->get();
            return view('post_views/friend_posts' , compact('posts'));
        }
        else
            return redirect('home');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::withCount('likes')->
                            whereIn('user_id' , auth()->user()->following()->where('accepted','=',1)
                                ->pluck('to_user_id')
                                )->get();

        return view('home',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post_views/new_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(request()->hasFile('image_path')){
            $path = $request->file('image_path')->store('posts');
           
        }
        $Post = new Post();
        $Post -> body =$request->get('body');
        $Post -> user_id= auth()->user()->id;
        $Post -> image_path=$path;
        $Post -> save();
        return redirect('post/'.$Post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::with('user')->find($id);
        $user = auth()->user();
        if($user->can('show' , $post)){
            $count=Like::where('post_id',$id)->count();
            $userLike=Like::where(['user_id'=>auth()->user()->id , 'post_id'=>$id])->get();
            $post_comment=Post::with('comments','comments.user')->find($id);
            return view('post_views/post_view',compact('post','count','userLike','post_comment'));
        }
            else
                return redirect('not_found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(auth()->user()->can('edit',$post)){
            return view('post_views/edit_post', compact('post'));
        }
        else
            return redirect('not_found');
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
        $post = Post::find($id);
        if(auth()->user()->can('update',$post)){
            $post->body = $request->get('body');
            $post->save();
            return redirect('post/'.$post->id);
        }
        else{
            return redirect('not_found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->can('delete',$post)){
            $post->delete();
            return redirect('user/posts');
        }
        else{
            return redirect('not_found');
        }
    }
}
