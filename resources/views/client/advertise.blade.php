@extends('layouts.client')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ route('advertise') }}">
                @csrf

              
                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Enter Your Phone') }}</label>

                    <div class="col-md-6">
                        <input type="text" value="" class="form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                      
                      
                    </div>
                    <input type="number" value="{{auth()->id()}}" name="user_id" hidden>
                   
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Become Writer') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection