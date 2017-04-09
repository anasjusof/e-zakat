<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\JenisZakat;

class JenisZakatManagementController extends Controller
{
    public function index(){

    	$jenis_zakats = JenisZakat::orderBy('id', 'DESC')->paginate(5);

    	return view('admin.jenis_zakat', compact('jenis_zakats'));

	}

	public function createZakat(Request $request){

		$input = $request->all();

		JenisZakat::create($input);

		return redirect()->back();
	}

	public function deleteZakat(Request $request){

		$jenis_zakats = JenisZakat::findOrFail($request->jeniszakat_id);

		foreach($jenis_zakats as $jenis_zakat){
    		$jenis_zakat->delete();
    	}

    	return redirect()->back();
	}

	public function updateZakat(Request $request){

		$input = $request->all();
		$jenis_zakat = JenisZakat::findOrFail($input['id']);
		$jenis_zakat->nama_zakat = $input['nama_zakat'];
		$jenis_zakat->bayaran_zakat = $input['bayaran_zakat'];
		$jenis_zakat->tahun = $input['tahun'];

		$jenis_zakat->save();

        return redirect()->back();

	}
}
