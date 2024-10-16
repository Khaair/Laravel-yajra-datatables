<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    // Show the list of posts
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn btn-primary btn-sm editPost">Edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger btn-sm deletePost">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('posts.index');
    }

    // Store new post
    public function store(Request $request)
    {
        Post::updateOrCreate(
            ['id' => $request->post_id],
            ['title' => $request->title, 'body' => $request->body]
        );        
        return response()->json(['success'=>'Post saved successfully!']);
    }

    // Edit a post
    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    // Delete a post
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json(['success'=>'Post deleted successfully!']);
    }
}
