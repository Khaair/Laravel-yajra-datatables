<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show the list
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm editBtn">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteBtn">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('products.index');
    }

    // Store new data


    public function store(Request $request)
    {

        // Validation
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        // Loop through the title and body arrays
        foreach ($request->title as $index => $title) {
            Product::updateOrCreate(
                ['id' => $request->post_id[$index] ?? null], // If editing, use post_id
                ['title' => $title, 'body' => $request->body[$index]]
            );
        }

        return response()->json(['success' => 'Posts saved successfully.']);
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
