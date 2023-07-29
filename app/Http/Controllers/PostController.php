<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Enums\PaginationOptions;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')
                     ->orderBy('id', 'desc')             
                     ->paginate(PaginationOptions::DEFAULT_PER_PAGE);

        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = new Post($request->validated());
        $post->created_by = Auth::id();
        $post->save();
        return redirect()->route('posts.index')->with('success',__('posts.created_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {

        if (Gate::denies('update-post', $post)) {
            return redirect()->back()->with('error',__('posts.unauthorized_to_delete'));
        }

        $post->update($request->validated());
        return redirect()->route('posts.index')->with('success',__('posts.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        if (Gate::denies('delete-post', $post)) {
            return redirect()->back()->with('error', __('posts.unauthorized_to_delete'));
        }

        try {
        $post->delete();
        } catch(\Exception $e) {
            return redirect()->back()->with('error', __('posts.record_not_found'));
        }

        return redirect()->route('posts.index')->with('success',__('posts.deleted_succesfully'));
    }

}
