<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function ExpensesAll()
    {
        $expenses = Expense::latest()->get();
        return view('backend.expense.expense_all', compact('expenses'));
    }

    public function ExpensesAdd()
    {
        return view('backend.expense.expense_add');
    }

    public function ExpensesStore(Request $request)
    {
        Expense::insert([
            'expense_name' => $request->expense_name,
            'expense_amount' => $request->expense_amount,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Expense Added',  
            'alert-type' => 'success'
        );
        return redirect()->route('expenses')->with($notification);
    }

    public function ExpensesEdit($id)
    {
        $expenses = Expense::findorFail($id);
        return view('backend.expense.expense_edit', compact('expenses'));
    }

    public function ExpensesUpdate(Request $request)
    {
        $expense_id = $request->id;

        Expense::findOrFail($expense_id)->update([
            'expense_name' => $request->expense_name,
            'expense_amount' => $request->expense_amount,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Expense Updated',  
            'alert-type' => 'info'
        );
        return redirect()->route('expenses')->with($notification);
    }

    public function ExpensesDelete($id)
    {
        Expense::findOrFail($id)->delete();
        
        $notification = array(
            'message' => 'Expense Deleted',  
            'alert-type' => 'info'
        );
        return redirect()->route('expenses')->with($notification);
    }
}
