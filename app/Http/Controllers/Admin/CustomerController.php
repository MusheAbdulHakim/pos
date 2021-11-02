<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'customers';

        if($request->ajax()){
            $data = Customer::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('customer_type',function ($row){
                        if(!empty($row->customerType)){
                            return $row->customerType->name;
                        }
                    })
                    ->addColumn('action',function ($row){
                        $editbtn = '<a href="'.route('customers.edit',$row->id).'" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('customers.destroy',$row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-customer')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-customer')){
                            $deletebtn = '';
                        }
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.customers.index',compact(
            'title',
        ));
    }



    /**
     * show form to created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create customer';
        $customertypes = CustomerType::get();
        return view('admin.customers.create',compact(
            'title','customertypes'
        ));
    }


    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required:min:3|max:200',
            'customer_type' => 'required',
            'phone' => 'required|min:10|max:15',
            'email' => 'nullable|email',
            'address' => 'nullable|min:3|max:255'
        ]);
        Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'customer_type_id' => $request->customer_type,
            'address' => $request->address,
        ]);
        $notification = notify('customer created successfully');
        return redirect()->route('customers.index')->with($notification);
    }

     /**
     * show form to edit resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $title = 'edit customer';
        $customertypes = CustomerType::get();
        return view('admin.customers.edit',compact(
            'title','customertypes','customer'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  model $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request,[
            'name' => 'required:min:3|max:200',
            'customer_type' => 'required',
            'phone' => 'required|min:10|max:15',
            'email' => 'nullable|email',
            'address' => 'nullable|min:3|max:255'
        ]);
        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'customer_type_id' => $request->customer_type,
            'address' => $request->address,
        ]);
        $notification = notify('customer updated successfully');
        return redirect()->route('customers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Customer::findOrFail($request->id)->delete();
    }
}
