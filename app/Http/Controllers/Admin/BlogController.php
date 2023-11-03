<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Models\Blog;
use DataTables;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blogs = Blog::all();
        return view('Admin.blog.list');
        // return view('Admin.blog.list',compact('blogs'));
    }

    public function list_blog(Request $request){
        if ($request->ajax()) {
            $data = Blog::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<i style="font-size: 16px;margin: 0px 5px;color: #4E9AFF;" class="bi bi-pencil-fill" onclick="editblog('.$row->id.')"></i>
                           <i style="font-size: 16px;margin: 0px 5px;color: #FF5F5F;" class="bi bi-trash-fill" onclick="deletblog('.$row->id.')"></i>
                           ';
                            return $btn;
                    })
                    ->addColumn('imagecostum', function($row){
                        $btn = '<img src="/img/blog/'. $row->Image.'" style="width:60px; height:60px; object-fit:contain;" alt="">
                        ';
                         return $btn;
                 })
                    ->rawColumns(['action','imagecostum'])
                    ->make(true);
        }
      
        return view('users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        // dd($request);
        $image = $request->file('image');
        $imag_path = '';
        if (!empty($image)) {
            $new_name = $request->name.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img/blog'), $new_name);
            $uploads_dir = 'public/img/blog';
            $imag_path = $new_name;
        }

        $blog = new Blog();
        $blog->Name = $request->name;
        $blog->Date = $request->date;
        $blog->Author = $request->author;
        $blog->Content = $request->content;
        $blog->Image = $imag_path;
        if($blog->save()){
            $resp['status'] = 'true';
            return json_encode($resp);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $blog = Blog::where('id','=',$id)->first();
        if($blog){
            $resp['status'] = 'true';
            $resp['blog'] = $blog;
            return json_encode($resp);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        
        $blog = Blog::findOrFail($id);

        // $randomString = randomstring();
        $randomString = Str::random(4);

        $image = $request->file('image');
        $imag_path = $blog->Image;
        if (!empty($image)) {
            $new_name = $request->name.'_'.$randomString.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('img/blog'), $new_name);
            $uploads_dir = 'public/img/blog';
            $imag_path = $new_name;
        }

        $blog->Name = $request->name;
        $blog->Date = $request->date;
        $blog->Author = $request->author;
        $blog->Content = $request->content;
        $blog->Image = $imag_path;

        if($blog->save()){
            $resp['status'] = 'true';
            return json_encode($resp);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::where('id','=',$id)->delete();
        if($blog){
            $resp['status'] = 'true';
            $resp['id'] = $id;
            return json_encode($resp);
        }
    }
}
