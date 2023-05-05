<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Writter;
use App\Models\User;
use App\Models\Advertise;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function uploadImage($image,$dir){
        $image_name = $image->getClientOriginalName();
        $new_name = time().$image_name;
        $image->move($dir,$new_name);
        return $new_name;
    }

    public function welcome(){
        $categories = Category::latest()->get();
        $latest_breaking_news = Post::where('breaking',1)->latest()->first();
        $breaking_news = Post::where('breaking',1)->latest()->get();
        $videos = Video::inRandomOrder()->take(6)->get();
        $latest_videos = Video::latest()->take(5)->get();
        $latest_news = Post::latest()->take(3)->get();
        return view('welcome',compact('latest_videos','videos','latest_news','categories','latest_breaking_news','breaking_news'));
    }

    public function post($id){
        $post = Post::find($id);
        return view('client.post',compact('post'));
    }

    public function category($id){
        $category = Category::find($id);
        $title = $category->title;
        $latest_news = $category->posts()->latest()->take(5)->get();
        $all_news = $category->posts()->paginate(10);
        
        return view('client.category-posts',compact('category','latest_news','all_news','title'));
    }

    public function ckUpload(Request $request){
        if ($request->hasFile('upload')){
            $dir = "storage/ckuploads";
            $filenametostore=$this->uploadImage($request->file('upload'),$dir);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/ckuploads/'.$filenametostore);
            $msg ='Image Successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum,'$url','$msg')</script>";
        
            @header('Content-type: text/html;charset=utf-8');
            echo $re;
        }
    }


public function writeForm(){
    return view('client.become-writer');

}
public function writeForUs(Request $request){

    $request_sent = Writter::where('user_id',auth()->id())->first();
    if ($request_sent){
        toastr()->warning('Please wait for admin approval','Request already sent! ');
        return back();
    } else { 
        Writter::create($request->all());
        toastr()->success('Data has been saved successfully!', 'Congrats');
        return back();
    }
}
public function contactForm(){

}
public function contactUs(){

}
public function advertiseForm(){

    return view('client.advertise');

}
public function advertise(Request $request){
    $request_sent = Advertise::where('user_id',auth()->id())->first();
    if ($request_sent){
        toastr()->warning('Please wait for admin approval','Request already sent! ');
        return back();
    } else { 
        Advertise::create($request->all());
    toastr()->success('Data has been saved successfully!', 'Congrats');
    return back();
    }
}
public function about(){

    $about = Setting::latest()->first()->about;
    return view('client.about',compact('about'));
}

public function clientEvents(){
    $events = Event::latest()->paginate(10);
    return view('client.events',compact('events'));
}
    
}
