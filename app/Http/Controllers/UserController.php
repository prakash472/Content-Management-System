<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Hash;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class UserController extends Controller
{
    public function my_posts(){
        return view('users.my_posts');
    }

    public function update_password(Request $request){
        if (!(Hash::check($request->input('current_password'), auth()->user()->password))) {
            // The passwords doesn't matches
            Session::flash('password error', "Current Password is not valid!!!! Failed to Update Password");
            return redirect()->back();
        }
        if (strcmp($request->input('new_password'), $request->get('confirm_new_password')) != 0) {
            //Current password and new password are same
            Session::flash("same password error", "Two passwords must be same");
            return redirect()->back();
        }
        if (strcmp($request->input('current_password'), $request->get('confirm_new_password')) == 0) {
            //Current password and new password are same
            Session::flash("old and new password same", "old and new password same");
            return redirect()->back();
        }
        $user=auth()->user();
        $user->password = bcrypt($request->input('new_password'));
        $user->name=$request->input('update_user_name');
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully");
        
    }
       public function  update_profile_pics(Request $request){
        $user=auth()->user();
        $originalImage = $request->file('update_profile_pics');
        $imageName = time() . $request->file('update_profile_pics')->getClientOriginalName();
        $originalImage = Image::make($originalImage)->resize(200,200);
        $originalPath = public_path() . '/uploads/profile_pics/';
        //dd($originalPath);
        $originalImage->save($originalPath . $imageName);
        $user->profile_pic=$imageName;
      //  }
       $user->save(); 

       return back();

    }

    public function admin_dashboard(){
        return view('admin_dashboard');
        }

    public function delete_user($id){
        $user=User::find($id);
       

       $posts=Post::where('user_id',$id)->get();
       foreach($posts as $post){
        $post->delete();
       }
       $user->delete(); 

        return view('admin_dashboard');
    }

    public function view_users_post($id){
        return view('view_users_posts')->with('user_id',$id);
    }

    public function delete_post($id){
        $post=Post::find($id);
        $post->delete();
    
        return redirect()->route('admin.dashboard');
       
    }

    

}
