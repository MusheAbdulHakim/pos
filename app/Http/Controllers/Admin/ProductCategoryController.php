<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'product categories';
        if ($request->ajax()){
            $data = ProductCategory::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('parent_category',function($row){
                        if(!empty($row->productCategory)){
                             return $row->productCategory->name;
                        }
                     })
                    ->addColumn('image',function ($row){
                        $src = asset('assets/images/users/avatar-3.jpg');
                        if(!empty($row->image)){
                            $src = asset('storage/product/category/'.$row->image);
                        }
                        $td = '<img class="avatar-md" src="'.$src.'" />';
                        return $td;
                    })
                    ->addColumn('action',function ($row){
                        $editbtn = '<a data-id="'.$row->id.'" data-name="'.$row->name.'" data-base="'.$row->product_category_id.'"  href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('product.category').'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-product-category')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-product-category')){
                            $deletebtn = '';
                        }

                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                        
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
        
        return view('admin.products.category',compact(
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
            'name' => 'required|min:3|max:200',
            'image' => 'nullable|file|image|mimes:png,jpg,jpeg',
            'parent_category' => 'nullable'
        ]);
        $imageName = null;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/product/category'), $imageName);
        }
        ProductCategory::create([
            'name' => $request->name,
            'image' => $imageName,
            'product_category_id' => $request->parent_category
        ]);
        $notification = notify('product category created');
        return back()->with($notification);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|max:200',
            'image' => 'nullable|file|image|mimes:png,jpg,jpeg',
            'parent_category' => 'nullable'
        ]);
        $category = ProductCategory::findOrFail($request->id);
        $imageName = $category->image;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/product/category'), $imageName);
        }
        $category->update([
            'name' => $request->name,
            'image' => $imageName,
            'product_category_id' => $request->parent_category
        ]);
        $notification = notify('product category updated');
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
        return ProductCategory::findOrFail($request->id)->delete();
    }
}
