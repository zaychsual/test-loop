<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::join('posts', 'posts.user_id', '=', 'users.id')
            ->join('comments', 'comments.post_id', '=', 'posts.id')
            ->select('users.name', 'posts.title', 'comments.email', 'comments.comment')
            ->when(request()->q, function($data) {
                $data = $data->where('comments.name', 'like', '%'. request()->q . '%');
            })->paginate(10);
        // dd($data);
        return view('admin.user.index', compact('data'));
    }
}
