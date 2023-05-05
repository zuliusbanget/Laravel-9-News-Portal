@extends('layouts.client')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1 class="font-weight-600 mb-4">
      {{$title}}
    </h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-8">
  @if ($all_news->count()>0)
    @foreach ($all_news as $news)
    <a href="{{route('client.post',$news->id)}}" class="text-dark">
    <div class="row">
      <div class="col-sm-4 grid-margin">
        <div class="rotate-img">
          <img src="{{asset('client/assets/images/dashboard/home_1.jpg')}}" alt="banner" class="img-fluid" />
        </div>
      </div>
      <div class="col-sm-8 grid-margin">
        <h2 class="font-weight-600 mb-2">
          {{$news->title}}
        </h2>
        <p class="fs-13 text-muted mb-0">
          <span class="mr-2">Posted </span>{{$news->created_at->diffForHumans()}}
        </p>
        <p class="fs-15">
          {{$news->short_desc}}
        </p>
      </div>
    </div>
  </a><hr>
    @endforeach
  @else
  <h2>No News Found in This Category</h2>
  @endif

</div>
  <div class="col-lg-4">
    <h2 class="mb-4 text-primary font-weight-600">
      Latest news
    </h2>
    @if ($latest_news->count()>0)
    @foreach ($latest_news as $news)
    <a href="{{route('client.post',$news->id)}}" class="text-dark">

      <div class="row">
        <div class="col-sm-12">
          <div class="border-bottom pb-4 pt-4">
            <div class="row">
              <div class="col-sm-8">
                <h5 class="font-weight-600 mb-1">
                  {{$news->short_desc}}
                </h5>
                <p class="fs-13 text-muted mb-0">
                  <span class="mr-2">Posted </span>{{$news->created_at->diffForHumans()}}
                </p>
              </div>
              <div class="col-sm-4">
                <div class="rotate-img">
                  <img src="{{asset('client/assets/images/dashboard/home_1.jpg')}}" alt="banner" class="img-fluid" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    @endforeach
    @else
    <h5>No Latest New</h5>
    @endif
    <div class="trending">
      <h2 class="mb-4 text-primary font-weight-600">
        Trending
      </h2>
      <div class="mb-4">
        <div class="rotate-img">
          <img src="../assets/images/business/business_4.png" alt="banner" class="img-fluid" />
        </div>
        <h3 class="mt-3 font-weight-600">
          Virus Kills Member Of Advising Iran’s Supreme
        </h3>
        <p class="fs-13 text-muted mb-0">
          <span class="mr-2">Photo </span>10 Minutes ago
        </p>
      </div>
      <div class="mb-4">
        <div class="rotate-img">
          <img src="../assets/images/business/business_5.png" alt="banner" class="img-fluid" />
        </div>
        <h3 class="mt-3 font-weight-600">
          Virus Kills Member Of Advising Iran’s Supreme
        </h3>
        <p class="fs-13 text-muted mb-0">
          <span class="mr-2">Photo </span>10 Minutes ago
        </p>
      </div>
      <div class="mb-4">
        <div class="rotate-img">
          <img src="../assets/images/business/business_6.png" alt="banner" class="img-fluid" />
        </div>
        <h3 class="mt-3 font-weight-600">
          Virus Kills Member Of Advising Iran’s Supreme
        </h3>
        <p class="fs-13 text-muted mb-0">
          <span class="mr-2">Photo </span>10 Minutes ago
        </p>
      </div>
    </div>
  </div>
</div>
@endsection