@extends('layouts.client')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <table class="table table-striped table-responsive-sm">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @if ($events->count()>0)
               
                    @foreach ($events as $event)
                        <tr>
                        <td>{{$event->title}}</td>
                        <td>{!!$event->desc!!}</td>
                        <td>{{$event->date}}</td>
                        </tr>
                    @endforeach
                @else
                <h2>No Events Found!</h2>
                @endif
            </tbody>

        </table>
    
    </div>
</div>
@endsection