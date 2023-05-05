<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Post;
use App\Models\Event;
use App\Models\Writter;
use App\Models\Advertise;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;


class AdminController extends Controller
{

    public function uploadImage($image, $dir)
    {
        $image_name = $image->getClientOriginalName();
        $new_name = time() . $image_name;
        $image->move($dir, $new_name);
        return $new_name;
    }

    public function home()
    {
        $categories = Category::all();
        $posts = Post::all();
        $events = Event::all();
        $latest_post=Post::latest()->take(10)->get();
        $latest_user=User::latest()->take(10)->get();
        $writter_request = User::where('is_writer',1)->get();
        $admins = User::where('is_admin',1)->get();
        $writters = Writter::all();
        $advert_request = Advertise::all();
        $videos = Video::all();
        $users = User::all();
        return view('admin.home', compact(
            'categories',
            'posts',
            'events',
            'latest_post',
            'latest_user',
            'advert_request',
            'writter_request',
            'videos',
            'writters',
            'admins',
            'users')
        );
    }

    public function users(Request $request){
        $page = "Registered Users";
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btns = '<div class="btn-group"><a href="users/user/' . $data->id . '" class="edit btn btn-primary btn-sm">View/Edit</a><a href="users/destroy/' . $data->id . '" class="btn btn-danger btn-sm">Delete</a></div>';
                    return $btns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.users', compact('page'));
    }

    public function updateUserForm($id)
    {
        $user = User::find($id);
        return view('admin.profile', compact('user'));
    }

    public function updateUserImage(Request $request, $id)
    {
        if (!$request->image) {
            toastr()->error('Image field if required!');
            return back();
        }
        $user = User::find($id);
        if ($request->image) {
            $dir ="storage/profile/";
            $new_image = $this->uploadImage($request->image, $dir);
            $user->image = $new_image;
            $user->save();
        }

        toastr()->success('Image Updated successfully');
        return back();
    }


    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->all();
        $user->fill($input)->save();

        if ($request->password && $user->password==Hash::make($request->password)) {
            $password = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            toastr()->success('User details updated successfully');
        } else {
            toastr()->warning('Password Tidak Sama');
        }
       
        return back();
    }



    public function settingsUpdateForm()
    {

        $page = "update settings";
        $settings = Setting::latest()->first();
        return view('admin.update-settings', \compact('settings', 'page'));
    }

    public function settingsUpdate(Request $request)
    {
        $logo = null;
        $settings = Setting::latest()->first();
        if ($settings !=null && $settings->site_logo) {
            $logo = $settings->site_logo;
        }
        //$logo = $settings->site_logo;

        if ($request->site_logo) {
            $dir  = "storage/settings/logo/";
            $logo = $this->uploadImage($request->site_logo, $dir);
        }


        if ($settings != null) {
            $input = $request->all();
            $settings->fill($input)->save();
            $settings->site_logo = $logo;
            $settings->save();
            toastr()->success('Settings Update Successfully');
            return back();
        } else {
            Setting::create($request->all());
            if($request->site_logo){
                $settings->site_logo = $logo;
                $settings->save();
            }
            toastr()->success('Settings Created Successfully');
            return back();
        }
    }


    //CATEGORY CRUD SECTION
    public function categories(Request $request)
    {
        $page = "Categories";
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btns = '<div class="btn-group"><a href="categories/' . $data->id . '" class="edit btn btn-primary btn-sm">View/Edit</a><a href="categories/destroy/' . $data->id . '" class="btn btn-danger btn-sm">Delete</a></div>';
                    return $btns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('admin.categories', compact('page'));
    }


    public function categoryCreateForm()
    {
        $page = "Create Category";
        return view('admin.create-category', compact('page'));
    }

    public function categoryCreate(Request $request)
    {
        $image = null;
        if ($request->image) {
            $dir  = "storage/categories/";
            $image = $this->uploadImage($request->image, $dir);
        }

        $category = new Category;
        $category->title = $request->title;
        $category->desc = $request->desc;
        $category->image = $image;
        $category->user_id = $request->user_id;
        $category->save();
        toastr()->success('Category Created Successfully');
        return back();
    }

    public function categoryUpdateForm($id)
    {
        $category = Category::find($id);
        $page = "Update Category";
        return view('admin.update-category', compact('category', 'page'));
    }

    public function categoryUpdate(Request $request, $id)
    {
        $category = Category::find($id);

        if ($category->image) {
            $image = $category->site_logo;
        }

        if ($request->image) {
            $dir = "storage/categories/";
            $image = $this->uploadImage($request->image, $dir);
        }

        $category->fill($request->all())->save();

        if ($request->image) {
            $category->image = $image;
            $category->save();
        }
        toastr()->success('Category Updated Successfully');
        return back();
    }

    public function categoryDestroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        toastr()->success('Category Deleted Successfully');
        return back();
    }


    //POST CRUD SECTION
    public function posts(Request $request)
    {
        $page = "posts";

        if ($request->ajax()) {
            $data = Post::latest()->get();
            if(auth()->user()->is_writer){
                $data = Post::where('user_id',auth()->id())->latest()->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btns = '<div class="btn-group"><a href="posts/' . $data->id . '" class="edit btn btn-primary btn-sm">View/Edit</a><a href="posts/destroy/' . $data->id . '" class="btn btn-danger btn-sm">Delete</a></div>';
                    return $btns;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.posts', compact('page'));
    }

    public function postCreateForm()
    {
        $page = "Create Post";
        $categories = Category::latest()->get();
        return view('admin.create-post', compact('page', 'categories'));
    }

    public function postCreate(Request $request)
    {
       $image = null;
        if ($request->image) {
            $dir  = "storage/posts/";
            $image = $this->uploadImage($request->image, $dir);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        $post->short_desc = $request->short_desc;
        $post->long_desc = $request->long_desc;
        $post->special = $request->special;
        $post->breaking = $request->breaking;
        $post->image = $image;
        $post->save();
        toastr()->success('Post Created Successfully');
        return back();
    }

    public function postUpdateForm($id)
    {
        $page = "Update Post";
        $post = Post::find($id);
        $categories = Category::latest()->get();
        return view('admin.update-post', compact('post', 'page', 'categories'));
    }

    public function postUpdate(Request $request, $id)
    {
       $post = Post::find($id);

        if ($post->image) {
            $image = $post->site_logo;
        }

        $post->fill($request->all())->save();
        
        if ($request->image) {
            $dir = "storage/posts/";
            $image = $this->uploadImage($request->image, $dir);
            $post->image = $image;
            $post->save();
        }
       
        toastr()->success('post Updated Successfully');
        return back();
    }

    public function postDestroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        toastr()->success('Post Deleted Successfully');
        return back();
    }

    //EVENT CRUD SECTION
    public function events(Request $request)
    {
        $page = "events";
        $events = Event::latest()->get();
        return view('admin.events', compact('page', 'events'));
    }

    public function eventCreateForm()
    {
        $page = "Create event";
        return view('admin.create-event', compact('page'));
    }

    public function eventCreate(Request $request)
    {
        Event::create($request->all());
        toastr()->success('Event Created Successfully');
        return back();
    }

    public function EventUpdateForm($id)
    {
        $page = "Update Event";
        $event = Event::find($id);
        return view('admin.update-event', compact('event', 'page'));
    }

    public function eventUpdate(Request $request, $id)
    {
        $event = Event::find($id);
        $event->fill($request->all())->save();
        toastr()->success('Event Updated Successfully');
        return back();
    }

    public function eventDestroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        toastr()->success('Event Deleted Successfully');
        return back();
    }

    public function writer_requests()
    {
        $page = "Writer Requests";
        $writer_requests = Writter::latest()->get();
        return view('admin.writer-request',compact('writer_requests','page'));
    }

    public function advertiser_requests()
    {
        $page = "Advertiser Requests";
        $advertiser_requests = Advertise::latest()->get();
        return view('admin.advert-request',compact('advertiser_requests','page'));
    }

   public function writer_destroy($id){
        $r = Writter::find($id);
        $r->delete();
        toastr()->success('Writer Request Deleted Successfully');
        return back();
   }

    public function advertiser_destroy($id){
        $r = Advertise::find($id);
        $r->delete();
        toastr()->success('Advertiser Request Deleted Successfully');
        return back();
    }

    public function approveWriter($id){
        $r = User::find($id);
        $r->is_writer = 1;
        $r->save();
        toastr()->success('User Role Changed to writer Successfully');
        return back();
    }

    public function approveAdvert(){

    }

    public function bannWriter($id){
        $r = User::find($id);
        $r->is_writer = 0;
        $r->save();
        toastr()->warning('Banned From Accessing Writers Panel Successfully');
        return back();
    }

    public function bannAdvert($id){
      
    }


    public function videos(Request $request){
        $page = "Videos";
        $videos = Video::latest()->get();
        if (auth()->user()->is_writer){
            $videos = Video::where('user_id',auth()->id())->latest()->get();
        }
        return view('admin.videos', compact('page', 'videos'));
    }

    public function videoCreateForm(){
        $page = "Create Video";
        $categories = Category::latest()->get();
        return view('admin.create-video',compact('page','categories'));
    }

    public function videoCreate(Request $request){
        $image = null;
        if ($request->image) {
            $dir  = "storage/videos/";
            $image = $this->uploadImage($request->image, $dir);
        }

        $video = new Video;
        $video->title = $request->title;
        $video->url = $request->url;
        $video->category_id = $request->category_id;
        $video->image = $image;
        $video->user_id = $request->user_id;
        $video->save();
        toastr()->success('Video Created Successfully');
        return back();
    }

    public function videoUpdateForm($id){
        $page = "Update Video";
        $video = Video::find($id);
        $categories = Category::latest()->get();
        return view('admin.update-video', compact('video','categories', 'page'));
    }

    public function videoUpdate(Request $request,$id){
        $video = Video::find($id);

        if ($video->image) {
            $image = $video->site_logo;
        }

        $video->fill($request->all())->save();
        
        if ($request->image) {
            $dir = "storage/videos/";
            $image = $this->uploadImage($request->image, $dir);
            $video->image = $image;
            $video->save();
        }
       
        toastr()->success('video Updated Successfully');
        return back();
    }

    public function videoDestroy($id){
        $video = Video::find($id);
        $video->delete();
        toastr()->success('Video Deleted Successfully');
        return back();
    }

}
