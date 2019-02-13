@extends('master')
@section('content')
<form style="margin:0 auto; width:500px;" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label>Post Id</label>
<input type="number" class="form-control" name="post_id" id="post_id" value="{{$post->id}}" readonly>
  </div>
  <div class="form-group">
    <label>Post Id</label>
<input type="number" class="form-control" name="post_id" id="post_id" value="{{$post->id}}" readonly>
  </div>
  <div class="form-group">
    <label>Post Status</label>
  <input type="text" class="form-control" name="edit_post_status" id="edit_post_status" value="{{$post->status}}">
  </div>

<img src="{{asset('uploads/posts/'.$post->thumbnail)}}" style="width:80%;height:auto;padding-left:80px">
     
<div class="form-group">
  <label>Replace Image</label>
  <input type="file" name="edit_post_image" id="edit_post_image">
</div>
<input type="submit" class="btn btn-primary" style="margin-left:200px" formaction="{{route('update_users_post',$post->id)}}">
</form>
@endsection
{{-- <form enctype="multipart/form-data" method="POST">
        @csrf
       
 </form> --}}