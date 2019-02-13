<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Intervention\Image\ImageManagerStatic as Image;

class PostContoller extends Controller
{
    public function add_posts(Request $request){
        $post=new Post();
        $post->user_id=$request->input('user_id');
        $post->status=$request->input('post_status');
     
        
        $originalImage = $request->file('post_pics');
        $imageName = time() . $request->file('post_pics')->getClientOriginalName();
        $originalImage = Image::make($originalImage)->resize(500,400);
        $originalPath = public_path() . '/uploads/posts/';
        //dd($originalPath);
        $originalImage->save($originalPath . $imageName);
        $post->thumbnail=$imageName;
      //  }
       $post->save(); 

       return back();

    }

    public function edit_user_post($id){
        $post=Post::find($id);
        return view('users.edit_user_post',compact('post'));
    }

    public function update_user_post(Request $request,$id){
        $post=Post::find($id);
        $post->status=$request->input('edit_post_status');
       if($request->hasfile('edit_post_image')){
        $originalImage = $request->file('edit_post_image');
        $imageName = time() . $request->file('edit_post_image')->getClientOriginalName();
        $originalImage = Image::make($originalImage)->resize(500,400);
        $originalPath = public_path() . '/uploads/posts/';
        //dd($originalPath);
        $originalImage->save($originalPath . $imageName);
        $post->thumbnail=$imageName;
       }
        $post->save();
        return redirect()->route('home');   
     }

    public function delete_post($id){
        $post=Post::find($id);
        $post->delete();
        return redirect()->route('my_posts');
        
    }
}
