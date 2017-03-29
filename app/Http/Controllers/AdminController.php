<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\History;

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

        $histories = History::select('users.name', 'users.email','histories.zakats_id','histories.created_at', 'receipts.filename', 'histories.status')
                                ->join('users', 'histories.users_id', '=', 'users.id')
                                ->join('receipts', 'histories.receipts_id', '=', 'receipts.id')
                                ->paginate(5);

        return view('admin.approval', compact('histories'))
                                        ->with('directory', $directory);
    }

    
}
