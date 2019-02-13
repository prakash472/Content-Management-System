<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
  

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     {{-- <link href="{{ asset('css/content.css') }}" rel="stylesheet"> --}}
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   Go To Homepage
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('my_posts')}}">My Posts
                                    </a>
                                <a class="dropdown-item" href="#addPostModal" data-toggle="modal">Add Posts
                                </a>
                                <a class="dropdown-item" href="#updateProfilePicModal" data-toggle="modal">Update Profile Pic
                                  </a>
                                @if(auth()->user()->is_admin)
                                <a class="dropdown-item" href="{{route('admin.dashboard')}}">Admin Dashboard
                                </a>
                                @endif
                                <a class="dropdown-item" href="#myprofileModal" data-toggle="modal">My Profile
                                    </a>
                              
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
            
        </main>
    </div>

        <!-- Add Post Modal -->
       @auth
        <div id="addPostModal" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                      <div class="modal-header">
                        <h4 class="modal-title">Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Status</label>
                          <input type="text" class="form-control"  id="post_status" name="post_status" required>
                        </div>
                        <div class="form-group">
                          <label>Post Pics</label>
                          <input type="file" class="form-control"  id="post_pics" name="post_pics" required>
                        </div>
                        <div class="form-group">
                                <label>Post Pics</label>
                                <input type="text" class="form-control"  id="user_name" name="user_name" value="{{auth()->user()->name}}" readonly>
                        </div>
                        <input type="hidden" class="form-control"  id="user_id" name="user_id" value="{{auth()->user()->id}}" readonly>      
                  </div>
                 
                      <div class="modal-footer" style="background: #ecf0f1;">
                           
                     <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" style="border-radius: 2px;
                        min-width: 100px;">
                        <input type="submit" style="border-radius: 2px;min-width: 100px;" class="btn btn-success" value="Add Posts" formaction="{{route('add.new.posts')}}">
                        {{-- <button type="submit" class="btn btn-danger" formaction="{{route('instructor.add_next_lesson',$id)}}">Add Next Lesson</button>
                            
                        <span><button type="submit" class="btn btn-danger" formaction="{{route('instructor.finish_add_next_lesson',$id)}}">Finish</button></span>
                         --}}
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              @endauth
            
      <!-- Delete Post Modal -->
      <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background:lightcoral">
                  <h5 class="modal-title">Delete Post</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete your Post?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" style="background:red">Delete</button>
                </div>
              </div>
            </div>
          </div>

          <!-- My profile Modal -->
          @auth
          <div id="myprofileModal" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="post" enctype="multipart/form-data">
                          @csrf
                        <div class="modal-header">
                          <h4 class="modal-title">My Profile</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                        <img src="{{asset('uploads/profile_pics/'.auth()->user()->profile_pic)}}" style="width:40%;height:auto;padding-left:80px">
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control"  id="update_user_name" name="update_user_name" value="{{auth()->user()->name}}">
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control"  id="email" name="email" value="{{auth()->user()->email}}" readonly>
                          </div>
                          <div class="form-group">
                            <label>Current Password</label>
                            <input type="text" class="form-control"  id="current_password" name="current_password" required>
                          </div>
                          <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control"  id="new_password" name="new_password" required>
                          </div>
                          <div class="form-group">
                            <label>Re Password</label>
                            <input type="password" class="form-control"  id="confirm_new_password" name="confirm_new_password" required>
                          </div>
                          <input type="hidden" class="form-control"  id="update_user_id" name="update_user_id" value="{{auth()->user()->id}}" readonly>
                    </div>
                   
                        <div class="modal-footer" style="background: #ecf0f1;">
                             
                       <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" style="border-radius: 2px;
                          min-width: 100px;">
                          <input type="submit" style="border-radius: 2px;min-width: 100px;" class="btn btn-success" value="Update Password" formaction="{{route('update.password')}}">
                          {{-- <button type="submit" class="btn btn-danger" formaction="{{route('instructor.add_next_lesson',$id)}}">Add Next Lesson</button>
                              
                          <span><button type="submit" class="btn btn-danger" formaction="{{route('instructor.finish_add_next_lesson',$id)}}">Finish</button></span>
                           --}}
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                @endauth

                @auth
                <!-- Update Profile Picture Modal -->
                <div id="updateProfilePicModal" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                          <div class="modal-header">
                            <h4 class="modal-title">Update Profile Pic</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body">
                          <img src="{{asset('uploads/profile_pics/'.auth()->user()->profile_pic)}}" style="width:40%;height:auto;padding-left:80px">
                          <div class="form-group">
                              <label>Update Profile Pics</label>
                              <input type="file" class="form-control"  id="update_profile_pics" name="update_profile_pics" required>
                            </div> 
                      </div>
                     
                          <div class="modal-footer" style="background: #ecf0f1;">
                               
                         <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" style="border-radius: 2px;
                            min-width: 100px;">
                            <input type="submit" style="border-radius: 2px;min-width: 100px;" class="btn btn-success" value="Update Profile Pic" formaction="{{route('update.profile_pics')}}">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  @endauth

                 

</body>
</html>
