<?php

namespace App\Http\Controllers;

use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TempController extends Controller
{
    public function index()
    {
        $incomes = History::where('type', 1)->orderByDesc('date')->get();
        $expenses = History::where('type', 0)->orderByDesc('date')->orderByDesc('mandatory')->get();


        return view('temp_index', [
            'incomes' => $incomes,
            'expenses' => $expenses,
            'allIncomes' => $incomes->sum('sum'),
            'allExpenses' => $expenses->sum('sum'),
            'balance' => History::balance()
        ]);
    }

    public function store(Request $request)
    {
        $history = new History();
        $history->fill($request->all());
        $history->mandatory = $request->has('mandatory') ? 1 : 0;
        $history->date = Carbon::createFromFormat('d.m.Y', $request->get('date'));
        $history->save();
        return back();
    }
}
