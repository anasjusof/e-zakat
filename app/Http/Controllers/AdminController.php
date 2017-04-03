<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;

use App\History;
use App\User;
use App\Bank;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.pay-zakat');
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
    public function store(Request $request)
    {
        //
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
        //
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
    }

    public function showLogin(){
        return view('login.login');
    }

    public function showRegistration(){
        return view('login.registration');
    }

    public function showForgotPassword(){
        return view('login.forgot-password');
    }

    public function showApproval(){

        $directory = '/images/';

        $histories = History::select('histories.id as history_id', 'users.name', 'users.email','histories.zakats_id','histories.created_at', 'receipts.filename', 'histories.status')
                                ->join('users', 'histories.users_id', '=', 'users.id')
                                ->join('receipts', 'histories.receipts_id', '=', 'receipts.id')
                                ->orderBy('histories.created_at', 'DESC')
                                ->paginate(5);

        return view('admin.approval', compact('histories'))
                                        ->with('directory', $directory);
    }

    public function adminManagement(){
        $admins = User::where('roles_id', '=', 1)->paginate(5);

        return view('admin.admin-management', compact('admins'));
    }

    public function adminDelete(Request $request){
        $admins = User::findOrFail($request->admins_id);

        foreach($admins as $admin){
            $admin->delete();
        }

        return redirect()->back();
    }

    public function adminCreate(UserRequest $request){
        $input = $request->except('confirm_password');

        $input['roles_id'] = 1;
        $input['password'] = bcrypt($request->password);

        User::create($input);

        return redirect()->back();
    }

    public function adminEdit(UserRequest $request){
        $input = $request->except('confirm_password', 'email');

        $user = User::findOrFail($input['id']);

        $input['password'] = preg_replace('/\s+/', '', $input['password']);

        if(empty($input['password']) || $input['password'] == ''){
            $user->name = $input['name'];    
        }
        else{
            $user->name = $input['name'];
            $user->password = bcrypt($input['password']);
        }
        

        $user->save();

        return redirect()->back();
    }

    public function dashboard(){
        $directory = '/images/';

        $histories = History::select('histories.id as history_id', 'users.name', 'users.email','histories.zakats_id','histories.created_at', 'receipts.filename', 'histories.status')
                                ->join('users', 'histories.users_id', '=', 'users.id')
                                ->join('receipts', 'histories.receipts_id', '=', 'receipts.id')
                                ->orderBy('histories.created_at', 'DESC')
                                ->paginate(5);

        $banks = Bank::orderBy('id', 'DESC')->paginate(5);

        $admins = User::where('roles_id', '=', 1)->paginate(5);

        $totals = History::get();

        $pendings = History::where('status', '=', '0')->get();

        $valids = History::where('status', '=', '1')->get();

        $rejects = History::where('status', '=', '2')->get();

        return view('admin.admin-dashboard', compact('histories', 'banks', 'admins', 'totals', 'pendings', 'valids', 'rejects'))
                                        ->with('directory', $directory);
    }

    
}
