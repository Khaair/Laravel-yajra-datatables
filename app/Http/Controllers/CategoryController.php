<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Yajra\DataTables\DataTables;



use Illuminate\Http\Request;

class CategoryController extends Controller
{
     // Show the list
     public function index(Request $request)
     {
         if ($request->ajax()) {
             $data = Category::latest()->get();
             return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                     $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editBtn">Edit</a>';
                     $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteBtn">Delete</a>';
                     return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }
         return view('categories.index');
     }
 
     // Store new 
     public function store(Request $request)
     {
          // Validation
          $request->validate([
            'name' => 'required|max:255',
            
        ]);
      
        Category::updateOrCreate(
             ['id' => $request->my_id],
             ['name' => $request->name]
         );        
         return response()->json(['success'=>'Data saved successfully!']);
         
     }
 
     // Edit
     public function edit($id)
     {
         $singleInfo = Category::find($id);
         return response()->json($singleInfo);
     }
 
     // Delete
     public function destroy($id)
     {
        Category::find($id)->delete();
         return response()->json(['success'=>'Data deleted successfully!']);
     }
}
