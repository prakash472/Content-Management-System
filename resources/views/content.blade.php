@extends('master')
@section('content')
@if (Session::has('password error'))
   <div class="alert alert-info">{{ Session::get('password error') }}</div>
@endif

@if (Session::has('same password error'))
   <div class="alert alert-info">{{ Session::get('same password error') }}</div>
@endif


@if (Session::has('old and new password same'))
   <div class="alert alert-info">{{ Session::get('old and new password same') }}</div>
@endif


@foreach(App\Post::orderBy('created_at','desc')->get() as $post)
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
            {{-- <span><a href="#editLessonModal" class="btn btn-warning" data-toggle="modal" data-lesson_id="{{$lessons_id}}" data-lesson_title="{{$lessons_title}}" data-lesson_duration="{{$lessons_duration}}" data-lesson_video_url="{{$lessons_video}}" data-course_id="{{$course_id}}">Edit Lesson</button></a></span>
                    --}}
          
          <div class="tweetEntry-content">
            
            <a class="tweetEntry-account-group" href="[accountURL]">
              
            <img class="tweetEntry-avatar" src="{{asset('uploads/profile_pics/'.auth()->user()->profile_pic)}}">
              
              <strong class="tweetEntry-fullname">
                <?php
                  $user_name=App\User::find($post_user_id);
                ?>
                
                  @if($user_name->isOnline())
                  <li class="text-suceess" style="color:green">
                      Acive 
                  </li>
                  @else
                  <li class="text-muted" style="color:red">
                      Inactive
                  </li>
                  @endif
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
     