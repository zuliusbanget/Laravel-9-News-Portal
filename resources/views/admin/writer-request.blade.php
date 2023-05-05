@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$page}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin/home">Home</a></li>
              <li class="breadcrumb-item active">{{$page}}</li>
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
            <div class="col-md-12">
                <table class="table table-striped table-responsive-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Send On</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($writer_requests->count()>0)
                       
                            @foreach ($writer_requests as $writer_request)
                                <tr>
                                <td>{{$writer_request->user->name}}</td>
                                <td>{!!$writer_request->phone!!}</td>
                                <td>{{$writer_request->user->email}}</td>
                                <td>{{$writer_request->created_at}}</td>
                                
                                    @if ($writer_request->user->is_writer)
                                    <td><a class="btn btn-sm btn-warning" href="{{route('admin.writer.bann',$writer_request->user->id)}}"><i class="fa fa-ban"></i></a></td>
                                  
                                    @else
                                    <td><a class="btn btn-sm btn-success" href="{{route('admin.writer.approve',$writer_request->user->id)}}"><i class="fa fa-thumbs-up"></i></a></td>
                                  
                                    @endif
                                   <td><a class="btn btn-sm btn-danger" href="{{route('admin.writer.destroy',$writer_request->id)}}"><i class="fa fa-trash"></i></a></td>

                                </td>
                                
                               </tr>
                            @endforeach
                        @else
                        <h2>No writer requests Found!</h2>
                        @endif
                    </tbody>
        
                </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('additional_scripts')

@endsection