@extends('layouts.index')
@section('content')
<?php
$users=App\User::all();

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

      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-comments"></i>
              </div>
            <div class="mr-5">{{App\User::count()}}</div>
            </div>
            <a class="card-footer text-white clearfix small z-1">
              <span class="float-left">Total users</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-list"></i>
              </div>
              <div class="mr-5">{{App\Post::count()}}</div>
            </div>
            <a class="card-footer text-white clearfix small z-1">
              <span class="float-left">Total Posts</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">{{App\Post::select('user_id')->distinct()->get()->count()}}</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Unique Post</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        {{-- <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fas fa-fw fa-life-ring"></i>
              </div>
              <div class="mr-5">13 New Tickets!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div> --}}
      </div>
{{-- 
      <!-- Area Chart Example-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fas fa-chart-area"></i>
          Area Chart Example</div>
        <div class="card-body">
          <canvas id="myAreaChart" width="100%" height="30"></canvas>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div> --}}

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
                  <th>Email</th>
                  <th>Status</th>
                  <th>Posts Created</th>
                  <th>Actions</th>
                
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Posts Created</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                  @foreach($users as $user)
                  <?php
                   $user_name=$user->name;
                   $user_email=$user->email;
                   $user_posts=$user->posts->count();
                  ?>
                <tr>
                  <td>{{$user_name}}</td>
                  <td>{{$user_email}}</td>
                  <td>
                        @if($user->isOnline())
                  <li class="text-suceess" style="color:green">
                      Acive 
                  </li>
                  @else
                  <li class="text-muted" style="color:red">
                      Inactive
                  </li>
                  @endif
                  </td>
                  <td>{{$user_posts}}</td>
                  <td>
                        <span><a href="{{route('delete.user',$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete User</button></a></span>
                        <span><a href="{{route('view.user.posts',$user->id)}}" class="btn btn-primary">View User Posts</button></a></span>
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