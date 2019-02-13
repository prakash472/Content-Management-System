@extends('layouts.index')
@section('content')
<?php
$posts=App\Post::where('user_id',$user_id)->get();
$users=App\User::find($user_id);
?>
<div id="content-wrapper">


    <div class="container-fluid">

      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Overview</li>
      </ol>
     
      <!-- DataTables Example -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-table"></i>
          Data Table Example</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Posts</th>
                  <th>Posts Created at</th>
                  <th>Actions</th>
                
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Posts</th>
                  <th>Posts Created at</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach($posts as $post)
                <tr>
                <td>{{$users->name}}</td>
                  <td>{{$post->status}}</td>
                  <td>
                       {{$post->created_at}}
                  </td>
                  <td>
                        <span><a href="{{route('delete.post',$post->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Post</button></a></span>
                        <span><a href="{{route('view.user.posts',$user_id)}}" class="btn btn-primary">View User Posts</button></a></span>
                  </td>
                 
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Bit4stack Technologies 2019</span>
        </div>
      </div>
    </footer>

  </div>
  <!-- /.content-wrapper -->

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

@endsection