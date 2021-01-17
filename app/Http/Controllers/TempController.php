<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TempController extends Controller
{
    public function index()
    {
        $incomes = History::where('type', 1)->with('category')->orderByDesc('date')->get();
        $expenses = History::where('type', 0)->with('category')->orderByDesc('date')->orderByDesc('mandatory')->get();

        return view('temp_index', [
            'incomes' => $incomes,
            'expenses' => $expenses,
            'allIncomes' => $incomes->sum('sum'),
            'allExpenses' => $expenses->sum('sum') * -1,
            'allMandatory' => $expenses->where('mandatory', 1)->sum('sum') * -1,
            'balance' => History::balance(),
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $tp = $request->get('type');
        $sum = $request->get('sum');
        if(!$tp && $sum > 0){
            $sum *= -1;
        }


        $history = new History();
        $history->fill($request->all());
        $history->mandatory = $request->has('mandatory') ? 1 : 0;
        $history->sum = $sum;
        $history->date = Carbon::createFromFormat('d.m.Y', $request->get('date'));
        $history->save();
        return back();
    }
}
