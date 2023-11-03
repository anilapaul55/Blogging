<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Models\User;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = User::whereNot('role','Admin')->get();
        return view('Admin.user.list');
        // return view('Admin.user.list',compact('users'));

    }

    public function list(Request $request){
       
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<i style="font-size: 16px;margin: 0px 5px;color: #4E9AFF;" class="bi bi-pencil-fill" onclick="editemploye('.$row->id.')"></i>
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
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'user';
        if($user->save()){
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
        $user = User::where('id','=',$id)->first();
        if($user){
            $resp['status'] = 'true';
            $resp['user'] = $user;
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
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }

        if($user->save()){
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
        $user = User::where('id','=',$id)->delete();
        if($user){
            $resp['status'] = 'true';
            $resp['id'] = $id;
            return json_encode($resp);
        }
    }
}
