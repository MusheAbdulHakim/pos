<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;
use App\Models\PurchaseProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'purchases';
        if($request->ajax()){
            $purchases = Purchase::get();
            return DataTables::of($purchases)
                    ->addIndexColumn()
                    ->addColumn('date',function($row){
                        return date_format(date_create($row->created_at),'d,M Y');
                    })
                    ->addColumn('supplier',function($row){
                        if(!empty($row->supplier)){
                            return $row->supplier->name;
                        }
                    })
                    ->addColumn('products',function($row){
                        if(!empty($row->products)){
                            return array_map(function($item){
                                return $item['name'];
                            },$row->products);
                        }
                    })
                    ->addColumn('action',function ($row){
                        $editbtn = '<a href="'.route('purchases.edit',$row->id).'" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('purchases.destroy',$row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-purchase')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-purchase')){
                            $deletebtn = '';
                        }
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
                    
        }
        return view('admin.purchases.index',compact(
            'title'
        ));
    }

    

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $data = Product::where('name', 'LIKE', '%'. $query. '%')
                        ->orWhere('barcode','LIKE','%'. $query. '%')
                        ->get();
        return response()->json($data);
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create purchase';
        return view('admin.purchases.create',compact(
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
            'supplier' => 'required',
            'status' => 'required',
            'products' => 'required',
            'note' => 'nullable|min:3|max:255',
        ]);
        $reference = IdGenerator::generate(['table' => 'purchases','field'=>'reference', 'length' => 10, 'prefix' =>'Pur-']);
        Purchase::create([
            'reference' => $reference,
            'status' => $request->status,
            'supplier_id' => $request->supplier,
            'products' => $request->products,
            'note' => $request->note,
        ]);
        $notification = notify('purchase added successfully');
        return redirect()->route('purchases.index')->with($notification);      

    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \app\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $title = 'edit purchase';
        return view('admin.purchases.edit',compact(
            'title','purchase'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \app\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request,[
            'supplier' => 'required',
            'status' => 'required',
            'products' => 'required',
            'note' => 'nullable|min:3|max:255',
        ]);
        $purchase->update([
            'status' => $request->status,
            'supplier_id' => $request->supplier,
            'products' => $request->products,
            'note' => $request->note,
        ]);
        $notification = notify('purchase updated successfully');
        return redirect()->route('purchases.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Purchase::findOrFail($request->id)->delete();
    }
}
