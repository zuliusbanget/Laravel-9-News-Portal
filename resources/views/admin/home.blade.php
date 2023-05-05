@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$categories->count()}}</h3>
            <p>Categories</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>

         @if (auth()->user()->is_admin)
         <a href="{{route('admin.categories')}}" class="small-box-footer">More info <i
          class="fa fa-arrow-circle-right"></i></a>
         @endif
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$posts->count()}}</h3>
            <p>Post</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          @if (auth()->user()->is_admin)
          <a href="{{route('admin.posts')}}" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
           @endif
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$events->count()}}</h3>
            <p>Events</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          @if (auth()->user()->is_admin)
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          @endif
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$videos->count()}}</h3>
            <p>Video</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          @if (auth()->user()->is_admin)
          <a href="{{route('admin.videos')}}" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
          @endif
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>{{$writter_request->count()}}</h3>
            <p>Writer Request</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          @if (auth()->user()->is_admin)
          <a href="{{route('admin.writer.requests')}}" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
          @endif
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-black">
          <div class="inner">
            <h3>{{$advert_request->count()}}</h3>
            <p>Advert Request</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          @if (auth()->user()->is_admin)
          <a href="{{route('admin.advert.requests')}}" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
          @endif
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>{{$users->count()}}</h3>
            <p>User Register</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          @if (auth()->user()->is_admin)
          <a href="{{route('admin.videos')}}" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
          @endif
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>{{$writter_request->count()}}</h3>
            <p>Writer</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          @if (auth()->user()->is_admin)
          <a href="{{route('admin.videos')}}" class="small-box-footer">More info <i
              class="fa fa-arrow-circle-right"></i></a>
          @endif
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-6">
      

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">LATEST USER</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
         
          </form>
        </div>
        <table class="table table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>phone</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if ($latest_user->count()>0)
                  @foreach ($latest_user as $user)
                      <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->writer->phone}}</td>
                        <td><a href="#">View</a></td>
                        <td><a href="#">Delete</a></td>
                      </tr>
                  @endforeach
              @else
                  <h2>No Users Found in The Database</h2>
              @endif
            </tbody>
        </table>


      </div>
      <div class="col-lg-6">
      

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">LATEST POST</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
         
          </form>
        </div>
        <table class="table table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th>Title</th>
                <th>View</th>
                <th>Category</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @if ($latest_post->count()>0)
                  @foreach ($latest_post as $post)
                      <tr>
                        <td>{{$post->title}}</td>
                        <td>{{$post->views}}</td>
                        <td>{{$post->category->title}}</td>
                        <td><a href="{{route('admin.post.update',$post->id)}}">View</a></td>
                        <td><a href="{{route('admin.post.destroy',$post->id)}}">Delete</a></td>
                      </tr>
                  @endforeach
              @else
                  <h2>No Users Found in The Database</h2>
              @endif
            </tbody>
        </table>

        
      </div>
      <!-- /.col-md-6 -->
      <!-- /.col-md-6 -->
    </div>
    <!-- /.col-md-6 -->
  </div>

  <!-- /.row -->
</div><!-- /.container-fluid -->
<!-- /.content -->
@endsection