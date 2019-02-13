@extends('master')
@section('content')
@foreach(App\Post::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get() as $post)
<?php
$post_id=$post->id;
$post_user_id=$post->user_id;
$post_status=$post->status;
$post_image=$post->thumbnail;
$post_created_at=$post->created_at;
?>

<div class="tweetEntry-tweetHolder">
        
        <!-- Entry with Media turned on. -->
      
        <div class="tweetEntry">
        <span><a href="{{route('edit_users_post',$post_id)}}"><i class="fa fa-pen" style="float:right;color:blue"></i></a></span>
                   
        <a href="{{route('user.delete.post',$post_id)}}" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" style="float:right;padding-right:20px; color:red"></i></a>
            </span>  
          
          <div class="tweetEntry-content">
            
            <a class="tweetEntry-account-group" href="[accountURL]">
              
              <img class="tweetEntry-avatar" src="{{asset('uploads/profile_pics/'.auth()->user()->profile_pic)}}">
              
              <strong class="tweetEntry-fullname">
                    <?php
                    $user_name=App\User::find($post_user_id);
                   ?> {{$user_name->name}}
              </strong>
              
              <span class="tweetEntry-username">
                    <b>{{$user_name->email}}</b>
              </span>
              
              
              <span class="tweetEntry-timestamp">- {{$post_created_at}}</span>
              
            </a>
            
            <div class="tweetEntry-text-container">
                    {{$post_status}}
            </div>
            
          </div>
          
          <div class="optionalMedia">
                <img class="optionalMedia-img" src="{{asset('uploads/posts/'.$post_image)}}">
          </div>

         
          
        </div>
 </div>

        <br>
@endforeach

          
@endsection