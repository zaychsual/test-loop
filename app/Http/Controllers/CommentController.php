<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Comment::leftJoin('users', 'users.email', '=', 'comments.email')
            ->leftJoin('posts', 'posts.id', '=', 'comments.post_id')
            ->select('posts.title', 'comments.name', 'comments.email', 'comments.website', 'comments.website')
            ->when(request()->q, function($data) {
                $data = $data->where('comments.name', 'like', '%'. request()->q . '%');
            })->paginate(10);

        return view('admin.comment.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required',
           'content'  => 'required'
       ]);

       //save to DB
       $post = Comment::create([
           'title' => $request->title,
           'content' => $request->content,
       ]);

       if($post){
            return redirect()->route('admin.comment.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect()->route('admin.comment.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Comment::findOrFail($id);

        return view('admin.comment.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Comment::findOrFail($id);

        return view('admin.comment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Comment::findOrFail($id);
        $post->title = $request->title;
        $post->slug = \Str::slug($post->title, '-');
        $post->content = $request->content;
        $post->update();

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('admin.comment.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('admin.comment.index')->with(['error' => 'Data Gagal Diupdate!']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Comment::findOrFail($id);
        $post->delete();

        if($post){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
