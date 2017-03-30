<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Bank;

class BankController extends Controller
{
    public function index(){
    	$banks = Bank::orderBy('id', 'DESC')->paginate(5);

    	return view('bank.index', compact('banks'));
    }

    public function deleteBank(Request $request){
    	$banks = Bank::findOrFail($request->banks_id);

    	foreach($banks as $bank){
    		$bank->delete();
    	}

    	return redirect()->back();
    }

    public function createBank(Request $request){
    	Bank::create($request->all());

    	return redirect()->back();
    }
}
