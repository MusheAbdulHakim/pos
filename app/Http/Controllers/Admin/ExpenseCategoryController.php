<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'expense categories';
        if ($request->ajax()){
            $data = ExpenseCategory::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function ($row){
                        $editbtn = '<a data-id="'.$row->id.'" data-name="'.$row->name.'" href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('expense.category').'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-expense-category')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-expense-category')){
                            $deletebtn = '';
                        }

                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                        
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('admin.expenses.category',compact(
            'title',
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
            'name' => 'required|min:3|max:255'
        ]);
        ExpenseCategory::create([
            'name' => $request->name,
        ]);
        $notification = notify('expense category created');
        return back()->with($notification);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|max:255'
        ]);
        ExpenseCategory::findOrFail($request->id)->update([
            'name' => $request->name,
        ]);
        $notification = notify('expense category updated');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  model $expensecategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return ExpenseCategory::findOrFail($request->id)->delete();
    }
}
