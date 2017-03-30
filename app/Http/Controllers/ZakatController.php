<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use File;

use App\Receipt;
use App\History;

class ZakatController extends Controller
{
    public function insertZakat(Request $request){

    	$input = $request->only('zakat_type', 'receipts_image', 'banks_id');
    	$user = Auth::user();

    	//Store receipt
    	if(!empty($input['receipts_image'])){

            $file = $input['receipts_image'];

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $receipt = Receipt::create(['filename'=>$name]);

            $input['receipts_id'] = $receipt->id;
        }

        //Store zakat info
        
        $saved_input['banks_id'] = $input['banks_id'];
    	$saved_input['users_id'] = $user->id;
    	$saved_input['zakats_id'] = $input['zakat_type'];
    	$saved_input['receipts_id'] = $input['receipts_id'];
    	$saved_input['status'] = 0;

    	$history = History::create($saved_input);

    	return redirect()->back();
    }

    public function updateZakatStatus(Request $request){

        foreach($request->history as $history){

            $pieces = explode("-", $history);
            $history_id = $pieces[0];
            $status = $pieces[1];

            $historyDB = History::find($history_id);

            $historyDB->status = $status;

            $historyDB->save();

        }

        return redirect()->back();
    }
}
