<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'expenses';
        if($request->ajax()){
            return DataTables::of(Expense::get())
                    ->addIndexColumn()
                    ->addColumn('expense_category',function ($row){
                        if(!empty($row->expenseCategory)){
                            return $row->expenseCategory->name;
                        }
                    })
                    ->addColumn('action',function ($row){
                        $editbtn = '<a href="'.route('expenses.edit',$row->id).'" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('expenses.destroy',$row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-expense')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-expense')){
                            $deletebtn = '';
                        }
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.expenses.index',compact(
            'title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create expense';
        $categories = ExpenseCategory::get();
        return view('admin.expenses.create',compact(
            'title','categories'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'expense_category' => 'required',
            'amount' => 'required',
            'comment' => 'nullable|min:5|max:255',
        ]);
        Expense::create([
            'expense_category_id' => $request->expense_category,
            'amount' => $request->amount,
            'comment' => $request->comment,
        ]);
        $notification = notify("Expense created successfully");
        return redirect()->route('expenses.index')->with($notification);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  model $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $title = 'edit expense';
        $categories = ExpenseCategory::get();
        return view('admin.expenses.edit',compact(
            'title','expense','categories',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  model $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $this->validate($request,[
            'expense_category' => 'required',
            'amount' => 'required',
            'comment' => 'nullable|min:5|max:255',
        ]);
        $expense->update([
            'expense_category_id' => $request->expense_category,
            'amount' => $request->amount,
            'comment' => $request->comment,
        ]);
        $notification = notify("Expense updated successfully");
        return redirect()->route('expenses.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Expense::findOrFail($request->id)->delete();
    }
}
