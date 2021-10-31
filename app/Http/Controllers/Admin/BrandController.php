<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'brands';
        if($request->ajax()){
            return DataTables::of(Brand::get())
                    ->addIndexColumn()
                    ->addColumn('image',function ($row){
                        $td = '<img class="avatar-md" src="'.asset('storage/brand/'.$row->image).'" />';
                        return $td;
                    })
                    ->addColumn('action',function ($row){
                        $editbtn = '<a data-id="'.$row->id.'" data-title="'.$row->title.'" data-image="'.$row->image.'" href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('brand',$row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['image','action'])
                    ->make(true);
        }
        
        return view('admin.brand.index',compact(
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
            'title' => 'required|min:3|max:200',
            'image' => 'nullable|file|image|mimes:png,jpg,jpeg',
        ]);
        $imageName = null;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/brand'), $imageName);
        }
        Brand::create([
            'title' => $request->title,
            'image' => $imageName,
        ]);
        $notification = notify('brand created successfully');
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
            'title' => 'required|min:3|max:200',
            'image' => 'nullable|file|image|mimes:png,jpg,jpeg',
        ]);
        $brand  = Brand::findOrFail($request->id);
        $imageName = $brand->image;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/brand'), $imageName);
        }
        $brand->update([
            'title' => $request->title,
            'image' => $imageName,
        ]);
        $notification = notify('brand updated successfully');
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
        return Brand::findOrFail($request->id)->delete();
    }
}
