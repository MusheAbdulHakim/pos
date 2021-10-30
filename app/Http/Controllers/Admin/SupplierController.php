<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'suppliers';
        if($request->ajax()){
            $data = Supplier::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function ($row){
                        $editbtn = '<a href="'.route('suppliers.edit',$row->id).'" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('suppliers.destroy',$row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.suppliers.index',compact(
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
        $title = 'create supplier';
        return view('admin.suppliers.create',compact(
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
            'name' => 'required:min:3|max:200',
            'phone' => 'required|min:10|max:15',
            'email' => 'nullable|email',
            'address' => 'nullable|min:3|max:255',
            'note' => 'nullable|min:3|max:255',
        ]);
        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'customer_type_id' => $request->customer_type,
            'address' => $request->address,
        ]);
        $notification = notify('supplier created successfully');
        return redirect()->route('suppliers.index')->with($notification);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  model $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $title = 'edit supplier';
        return view('admin.suppliers.edit',compact(
            'title','supplier'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request,[
            'name' => 'required:min:3|max:200',
            'phone' => 'required|min:10|max:15',
            'email' => 'nullable|email',
            'address' => 'nullable|min:3|max:255',
            'note' => 'nullable|min:3|max:255',
        ]);
        $supplier->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'note' => $request->note,
        ]);
        $notification = notify('supplier updated successfully');
        return redirect()->route('suppliers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Supplier::findOrFail($request->id)->delete();
    }
}
