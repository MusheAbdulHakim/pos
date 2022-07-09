<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'products';
        if($request->ajax()){
            $data = Product::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image',function ($row){
                    $src = asset('assets/images/users/avatar-3.jpg');
                    if(!empty($row->image)){
                        $src = asset('storage/product/'.$row->image);
                    }
                    $td = '<img class="avatar-md w-50 h-50" src="'.$src.'" />';
                    return $td;
                })
                ->addColumn('brand',function ($row){
                    if(!empty($row->brand)){
                        return $row->brand->title;
                    }
                })
                ->addColumn('category',function ($row){
                    if(!empty($row->product_category)){
                        return $row->product_category->name;
                    }
                })
                ->addColumn('unit',function ($row){
                    if(!empty($row->product_unit)){
                        return $row->product_unit->name;
                    }
                })
                ->addColumn('action',function ($row){
                    $editbtn = '<a data-id="'.$row->id.'" href="'.route('products.edit',$row->id).'" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('products.destroy',$row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    if(!auth()->user()->hasPermissionTo('edit-product')){
                        $editbtn = '';
                    }
                    if(!auth()->user()->hasPermissionTo('destroy-product')){
                        $deletebtn = '';
                    }

                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                    
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }
        return view('admin.products.index',compact(
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
        $title = 'add product';
        return view('admin.products.create',compact(
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
            'product_type' => 'required',
            'name' => 'required|min:3|max:200',
            'barcode' => 'nullable|min:3|max:255',
            'brand' => 'nullable',
            'category' => 'required',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,gif',
            'cost' => 'required',
            'price' => 'required',
            'alert_quantity' => 'nullable',
            'product_unit' => 'required',
            'sale_unit' => 'required',
            'purchase_unit' => 'required',
            'tax' => 'nullable',
            'tax_method' => 'nullable',
            'details' => 'nullable|max:255',
        ]);
    
        $imageName = null;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/product'), $imageName);
        }
        Product::create([
            'type' => $request->product_type,
            'name' => $request->name,
            'barcode' => $request->barcode,
            'brand_id' => $request->brand,
            'product_category_id' => $request->category,
            'image' => $imageName,
            'cost' => $request->cost,
            'price' => $request->price,
            'alert_quantity' => $request->alert_quantity,
            'product_unit_id' => $request->product_unit,
            'sale_unit_id' => $request->sale_unit,
            'purchase_unit_id' => $request->purchase_unit,
            'tax_id' => $request->tax,
            'tax_method' => $request->tax_method,
            'details' => $request->details,
        ]);
        $notification = notify('product has been added');
        return redirect()->route('products.index')->with($notification);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $title = 'edit product';
        return view('admin.products.edit',compact(
            'title','product'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'product_type' => 'required',
            'name' => 'required|min:3|max:200',
            'barcode' => 'nullable|min:3|max:255',
            'brand' => 'nullable',
            'category' => 'required',
            'image' => 'nullable|file|image|mimes:jpg,jpeg,png,gif',
            'cost' => 'required',
            'price' => 'required',
            'alert_quantity' => 'nullable',
            'product_unit' => 'required',
            'sale_unit' => 'required',
            'purchase_unit' => 'required',
            'tax' => 'nullable',
            'tax_method' => 'nullable',
            'details' => 'nullable|max:255',
        ]);
        $imageName = $product->image;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/product'), $imageName);
        }
        $product->update([
            'type' => $request->product_type,
            'name' => $request->name,
            'barcode' => $request->barcode,
            'brand_id' => $request->brand,
            'product_category_id' => $request->category,
            'image' => $imageName,
            'cost' => $request->cost,
            'price' => $request->price,
            'alert_quantity' => $request->alert_quantity,
            'product_unit_id' => $request->product_unit,
            'sale_unit_id' => $request->sale_unit,
            'purchase_unit_id' => $request->purchase_unit,
            'tax_id' => $request->tax,
            'tax_method' => $request->tax_method,
            'details' => $request->details,
        ]);
        $notification = notify('product has been added');
        return redirect()->route('products.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Product::findOrFail($request->id)->delete();
    }
}
