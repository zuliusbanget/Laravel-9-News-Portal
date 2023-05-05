@extends('layouts.client')

@section('content')
<div class="row" data-aos="fade-up">
    <div class="col-xl-8 stretch-card grid-margin">
        @if ($latest_breaking_news != null)
        <a href="{{route('client.post',$latest_breaking_news->id)}}" class="text-light">

            <div class="position-relative">
                <img src="{{asset('client/assets/images/dashboard/banner.jpg')}}" alt="banner" class="img-fluid" />
                <div class="banner-content">
                    <div class="badge badge-danger fs-12 font-weight-bold mb-3">
                        {{$latest_breaking_news->category->title}}
                    </div>
                    <h1 class="mb-0"></h1>
                    <h1 class="mb-2">
                        {{$latest_breaking_news->title}} - {{$latest_breaking_news->short_desc}}
                    </h1>
                    <div class="fs-12">
                        <span class="mr-2">Posted </span>{{$latest_breaking_news->created_at->diffForHumans()}}
                    </div>
                </div>
            </div>
        </a>
        @else

        @endif
    </div>
    <div class="col-xl-4 stretch-card grid-margin">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h2>Latest news</h2>
                @if ($latest_news->count()>0)
                @foreach ($latest_news as $news)
                <a href="{{route('client.post',$news->id)}}" class="text-light">

                    <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                        <div class="pr-3">
                            <h5>{{$news->title}}</h5>
                            <div class="fs-12">
                                <span class="mr-2">Posted </span>{{$news->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="rotate-img">
                            <img src="{{asset('storage/posts/'.$news->image)}}" alt="thumb"
                                class="img-fluid img-lg" />
                        </div>
                    </div>
                </a>
                @endforeach
                @else
                <h5>No Latest New</h5>
                @endif


            </div>
        </div>
    </div>
</div>
<div class="row" data-aos="fade-up">
    <div class="col-lg-3 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <h2>Category</h2>
                <ul class="vertical-menu">
                    @if($categories->count() >0)
                    @foreach ($categories as $category)
                    <li><a href="{{route('client.category',$category->id)}}">{{$category->title}}</a></li>
                    @endforeach
                    @else
                    <h3>No Categories Found</h3>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-9 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                @if ($breaking_news->count()>0)
                @foreach ($breaking_news as $news)
                <a href="{{route('client.post',$news->id)}}" class="text-dark">
                    <div class="row">
                        <div class="col-sm-4 grid-margin">
                            <div class="position-relative">
                                <div class="rotate-img">
                                    <img src="{{asset('storage/posts/'.$news->image)}}" alt="thumb"
                                        class="img-fluid" />
                                </div>
                                <div class="badge-positioned">
                                    <span class="badge badge-danger font-weight-bold">{{$news->category->title}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8  grid-margin">
                            <h2 class="mb-2 font-weight-600">
                                {{$news->title}}
                            </h2>
                            <div class="fs-13 mb-2">
                                <span class="mr-2">Posted </span>{{$news->created_at->diffForHumans()}}
                            </div>
                            <p class="mb-0">
                                {{$news->short_desc}}
                            </p>
                        </div>
                    </div>
                </a>
                <hr>
                @endforeach

                @else
                <h3>No Breaking News Found</h3>
                @endif


            </div>
        </div>
    </div>
</div>
<div class="row" data-aos="fade-up">
    <div class="col-sm-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-title">
                            Video
                        </div>
                        <div class="row">
                        @if ($videos->count()>0)
                            @foreach ($videos as $video)
                            <a href="{{$video->url}}">
                             <div class="col-sm-6 grid-margin">
                                <div class="position-relative">
                                    <div class="rotate-img">
                                        <img src="{{asset('storage/videos/'.$video->image)}}" width="300px" height="300px" alt="thumb" class="img-fluid" />
                                    </div>
                                    <div class="badge-positioned w-90">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge badge-danger font-weight-bold">{{$video->category->title ?? "none"}}</span>
                                            <div class="video-icon">
                                                <i class="mdi mdi-play"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                            @endforeach
                        @else

                        @endif
                    </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                Latest Video
                            </div>
                            <p class="mb-3">See all</p>
                        </div>
                        @if ($latest_videos->count()>0)
                        @foreach ($latest_videos as $video)
                        <a href="{{$video->url}}" class="text-dark">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                            <div class="div-w-80 mr-3">
                                <div class="rotate-img">
                                    <img src="{{asset('storage/videos/'.$video->image)}}" alt="thumb" class="img-fluid" />
                                </div>
                            </div>
                            <h3 class="font-weight-600 mb-0">
                                {{$video->title}}
                            </h3>
                        </div>
                        </a>
                        @endforeach
                        @else

                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" data-aos="fade-up">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card-title">
                            Sport light
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-8 col-sm-6">
                                <div class="rotate-img">
                                    <img src="assets/images/dashboard/home_16.jpg" alt="thumb" class="img-fluid" />
                                </div>
                                <h2 class="mt-3 text-primary mb-2">
                                    Newsrooms exercise..
                                </h2>
                                <p class="fs-13 mb-1 text-muted">
                                    <span class="mr-2">Photo </span>10 Minutes ago
                                </p>
                                <p class="my-3 fs-15">
                                    Lorem Ipsum has been the industry's standard dummy
                                    text ever since the 1500s, when an unknown printer
                                    took
                                </p>
                                <a href="#" class="font-weight-600 fs-16 text-dark">Read more</a>
                            </div>
                            <div class="col-xl-6 col-lg-4 col-sm-6">
                                <div class="border-bottom pb-3 mb-3">
                                    <h3 class="font-weight-600 mb-0">
                                        Social distancing is ..
                                    </h3>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                    <p class="mb-0">
                                        Lorem Ipsum has been the industry's
                                    </p>
                                </div>
                                <div class="border-bottom pb-3 mb-3">
                                    <h3 class="font-weight-600 mb-0">
                                        Panic buying is forcing..
                                    </h3>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                    <p class="mb-0">
                                        Lorem Ipsum has been the industry's
                                    </p>
                                </div>
                                <div class="border-bottom pb-3 mb-3">
                                    <h3 class="font-weight-600 mb-0">
                                        Businesses ask hundreds..
                                    </h3>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                    <p class="mb-0">
                                        Lorem Ipsum has been the industry's
                                    </p>
                                </div>
                                <div>
                                    <h3 class="font-weight-600 mb-0">
                                        Tesla's California factory..
                                    </h3>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                    <p class="mb-0">
                                        Lorem Ipsum has been the industry's
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card-title">
                                    Sport light
                                </div>
                                <div class="border-bottom pb-3">
                                    <div class="rotate-img">
                                        <img src="assets/images/dashboard/home_17.jpg" alt="thumb" class="img-fluid" />
                                    </div>
                                    <p class="fs-16 font-weight-600 mb-0 mt-3">
                                        Kaine: Trump Jr. may have
                                    </p>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                </div>
                                <div class="pt-3 pb-3">
                                    <div class="rotate-img">
                                        <img src="assets/images/dashboard/home_18.jpg" alt="thumb" class="img-fluid" />
                                    </div>
                                    <p class="fs-16 font-weight-600 mb-0 mt-3">
                                        Kaine: Trump Jr. may have
                                    </p>
                                    <p class="fs-13 text-muted mb-0">
                                        <span class="mr-2">Photo </span>10 Minutes ago
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card-title">
                                    Celebrity news
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="border-bottom pb-3">
                                            <div class="row">
                                                <div class="col-sm-5 pr-2">
                                                    <div class="rotate-img">
                                                        <img src="assets/images/dashboard/home_19.jpg" alt="thumb"
                                                            class="img-fluid w-100" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 pl-2">
                                                    <p class="fs-16 font-weight-600 mb-0">
                                                        Online shopping ..
                                                    </p>
                                                    <p class="fs-13 text-muted mb-0">
                                                        <span class="mr-2">Photo </span>10
                                                        Minutes ago
                                                    </p>
                                                    <p class="mb-0 fs-13">
                                                        Lorem Ipsum has been
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="border-bottom pb-3 pt-3">
                                            <div class="row">
                                                <div class="col-sm-5 pr-2">
                                                    <div class="rotate-img">
                                                        <img src="assets/images/dashboard/home_20.jpg" alt="thumb"
                                                            class="img-fluid w-100" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 pl-2">
                                                    <p class="fs-16 font-weight-600 mb-0">
                                                        Online shopping ..
                                                    </p>
                                                    <p class="fs-13 text-muted mb-0">
                                                        <span class="mr-2">Photo </span>10
                                                        Minutes ago
                                                    </p>
                                                    <p class="mb-0 fs-13">
                                                        Lorem Ipsum has been
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="border-bottom pb-3 pt-3">
                                            <div class="row">
                                                <div class="col-sm-5 pr-2">
                                                    <div class="rotate-img">
                                                        <img src="assets/images/dashboard/home_21.jpg" alt="thumb"
                                                            class="img-fluid w-100" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 pl-2">
                                                    <p class="fs-16 font-weight-600 mb-0">
                                                        Online shopping ..
                                                    </p>
                                                    <p class="fs-13 text-muted mb-0">
                                                        <span class="mr-2">Photo </span>10
                                                        Minutes ago
                                                    </p>
                                                    <p class="mb-0 fs-13">
                                                        Lorem Ipsum has been
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="pt-3">
                                            <div class="row">
                                                <div class="col-sm-5 pr-2">
                                                    <div class="rotate-img">
                                                        <img src="assets/images/dashboard/home_22.jpg" alt="thumb"
                                                            class="img-fluid w-100" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 pl-2">
                                                    <p class="fs-16 font-weight-600 mb-0">
                                                        Online shopping ..
                                                    </p>
                                                    <p class="fs-13 text-muted mb-0">
                                                        <span class="mr-2">Photo </span>10
                                                        Minutes ago
                                                    </p>
                                                    <p class="mb-0 fs-13">
                                                        Lorem Ipsum has been
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection