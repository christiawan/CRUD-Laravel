<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Blog;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $blog = Blog::all();
        // $blog = Blog::paginate(1);
        $blog = DB::table('blog')->paginate(3);
        return view('blog.index', ['data' => $blog]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required|min:5',
            'subject' => 'required|min:20',
        ]);
        $blog = new Blog;

        $blog->title = $request->title;
        $blog->subject = $request->subject;
        $blog->slug = str_slug($request->title,'-');

        $blog->save();

        return redirect('crud')->with('pesan','blog sudah di tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($title)
    {
        //
        // $blog = Blog::find($id);
        // dd($blog); die 
        $blog = Blog::where('slug',$title)->first();
        if (!$blog) {
           abort(404);
        }
        return view('blog.single')->with('data',$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $blog = Blog::find($id);
        // dd($blog); die 
        if (!$blog) {
           abort(404);
        }
        return view('blog.edit')->with('data',$blog);
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
        //
        //
        $this->validate($request, [
            'title' => 'required|min:5',
            'subject' => 'required|min:20',
        ]);
         $blog = Blog::find($id);

        $blog->title = $request->title;
        $blog->subject = $request->subject;
        $blog->slug = str_slug($request->title,'-');

        $blog->save();

        return redirect('crud')->with('pesan','blog sudah di update ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         $blog = Blog::find($id);
         $blog->delete();
        return redirect('crud')->with('pesan','Data sudah di hapus');

    }
}
