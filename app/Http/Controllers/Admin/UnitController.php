<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'units';
        if($request->ajax()){
            $data = Unit::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('base_unit',function($row){
                       if(!empty($row->unit)){
                            return $row->unit->name;
                       }
                    })
                    ->addColumn('action',function ($row){
                        $editbtn = '<a data-id="'.$row->id.'" data-name="'.$row->name.'" data-code="'.$row->code.'" data-operator="'.$row->operator.'" data-value="'.$row->value.'" data-base="'.$row->unit_id.'" href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('unit').'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-unit')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-unit')){
                            $deletebtn = '';
                        }
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.unit.index',compact(
            'title'
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
            'code' => 'required|max:100',
            'name' => 'required|min:3|max:200',
            'base_unit' => 'nullable',
            'operator' => 'nullable',
            'value' => 'nullable',
        ]);
        Unit::create([
            'code' => $request->code,
            'name' => $request->name,
            'unit_id' => $request->base_unit,
            'operator' => $request->operator,
            'value' => $request->value ?? 1,
        ]);
        $notification = notify("unit has been created");
        return back()->with($notification);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|max:100',
            'name' => 'required|min:3|max:200',
            'base_unit' => 'nullable',
            'operator' => 'nullable',
            'value' => 'nullable',
        ]);
        Unit::findOrFail($request->id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'unit_id' => $request->base_unit,
            'operator' => $request->operator,
            'value' => $request->value ?? 1,
        ]);
        $notification = notify("unit has been updated");
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Unit::findOrFail($request->id)->delete();
    }
}
