<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Finance;

class FinanceController extends Controller
{
    public function create()
    {
        return view('pages.finance');
    }

    public function store(Request $request)
    {
        $stock = new Finance([
            'Nazov' => $request->get('Nazov'),
            'Prijem' => $request->get('Prijem'),
            'Vydavok' => $request->get('Vydavok'),
            'rok' => $request->get('rok'),
            'Datum' => $request->get('Datum'),
        ]);
        $stock->save();

        //return redirect('finance_view');
        return view('pages.finance_view');
    }

    public function index()
    {
        return view('pages.finance_view');
    }

    public function chart()
    {
        $result = DB::table('Finance')
            //->where('Nazov','=','Hello')
            //->orderBy('rok', 'ASC')
            ->get();
       //
        return response()->json($result);
        var_dump($result); exit;
    }
}
