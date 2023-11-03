<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(123);
        // $categories = Category::all();
        // return view('Admin.category.list');
        // return view('Admin.category.list',compact('categories'));
        return view('Admin.category.list');

    }

    public function list_cat(Request $request)
    {
               
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<i style="font-size: 16px;margin: 0px 5px;color: #4E9AFF;" class="bi bi-pencil-fill" onclick="editCategory('.$row->id.')"></i>
                           <i style="font-size: 16px;margin: 0px 5px;color: #FF5F5F;" class="bi bi-trash-fill" onclick="deletemploye('.$row->id.')"></i>
                           ';
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
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
    public function store(CategoryRequest $request)
    {
        // dd($request);
        $category = new Category();
        $category->category_name = $request->name;
        $category->category_status = "active";
        // $category->save();

        if($category->save()){
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
        $category = Category::where('id','=',$id)->first();
        if($category){
            $resp['status'] = 'true';
            $resp['category'] = $category;
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
    public function update(CategoryRequest $request, $id)
    {
        //
        // dd($id);
        $category = Category::findOrFail($id);
        $category->category_name = $request->name;
        $category->category_status = "active";
        // $category->save();
        if($category->save()){
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
        $category = Category::where('id','=',$id)->delete();
        if($category){
            $resp['status'] = 'true';
            $resp['id'] = $id;
            return json_encode($resp);
        }
    }
}
