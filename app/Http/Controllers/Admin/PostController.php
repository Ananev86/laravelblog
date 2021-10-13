<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $posts=Post::paginate(20);
        return view('admin.posts.index',compact('posts'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // echo public_path('6');
        $categories=Category::pluck('title','id')->all();
      //  dd($categories);
        $tags=Tag::pluck('title','id')->all();

        return view('admin.posts.create',compact('tags','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'title'=>'required',
                'tags'=>'required',
                'thumbnail'=>'image'
            ]
        );
        $data=$request->all();
       $data['thumbnail']=Post::uploadImage($request);

        $post=Post::create($data);
        $post->tags()->sync($request->tags);
        $request->session()->flash('success','post dobavlena');
        return redirect()->route('posts.index');

       /* $request->validate(
            [
                'title'=>'required',
            ]
        );
        Category::create(
            $request->all()
        );
        $request->session()->flash('success','categoria dobavlena');
        return redirect()->route('categories.index');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo $id;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories=Category::pluck('title','id')->all();
        $tags=Tag::pluck('title','id')->all();
        $post=Post::find($id);

        return view('admin.posts.edit',compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


     //   dd($request->file('thumbnail')->getClientOriginalName());
        $post=Post::find($id);
       // if($request->hasFile('thumbnail'))

       /* {
            Storage::delete($post->thumbnail);
            $folder=date('Y-m-d');
            $data['thumbnail']=$request->file('thumbnail')->store("images/{$folder}");
        }*/
     $data['thumbnail']=Post::uploadImage($request,$post->thumbnail);
        $post->update($data);
        $post->tags()->sync($request->tags);
        $request->session()->flash('success','post edit');
        return redirect()->route('posts.index');




      /*  $request->validate(
            [
                'title'=>'required',
            ]
        );
        $cat=Category::find($id);
        $cat->update($request->all());
        $request->session()->flash('success','categoria obnovlena');
        return redirect()->route('categories.index');*/

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat=Category::find($id);
        $cat->delete();
        // $request->session()->flash('success','categoria ydalenaa');
        return redirect()->route('categories.index');
    }
}
