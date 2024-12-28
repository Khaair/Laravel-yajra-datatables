<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller

{
    // Show the list
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('category')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category', function($row){
                    return $row->category->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editBtn">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteBtn">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
       
        $categories = Category::all();
        return view('products.index', compact('categories'));
    }

    public function create()
    {
           
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

   

    // Store new data


    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Check if the title is an array or a single string
        if (is_array($request->title)) {
            // Loop through the title and body arrays
            foreach ($request->title as $index => $title) {
                Product::updateOrCreate(
                    ['id' => $request->my_id[$index] ?? null], 
                    [
                        'title' => $title, 
                        'body' => $request->body[$index], 
                        'category_id' => $request->category_id[$index] ?? $request->category_id
                    ]
                );
            }
        } else {
            // Single product entry
            Product::updateOrCreate(
                ['id' => $request->my_id ?? null], 
                [
                    'title' => $request->title, 
                    'body' => $request->body, 
                    'category_id' => $request->category_id
                ]
            );
        }
    
        return response()->json(['success' => 'Product(s) saved successfully.']);
    }

    // Edit data
    public function edit($id)
    {

        $singleInfo = Product::find($id);
        return response()->json($singleInfo);
    }

    // Delete data
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json(['success' => 'Data deleted successfully!']);
    }
}
