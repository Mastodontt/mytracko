<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Dto\CreatePost;
use App\Dto\DeletePost;
use App\Dto\UpdatePost;
use Illuminate\Support\Facades\Gate;
use App\Services\Post\CreatePostService;
use App\Services\Post\DeletePostService;
use App\Services\Post\UpdatePostService;
use App\Interfaces\PostRepositoryInterface;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

class PostController extends Controller
{

    private PostRepositoryInterface $postRepository;
    private CreatePostService $createPostService;
    private UpdatePostService $updatePostService;
    private DeletePostService $deletePostService;

    public function __construct(
        CreatePostService $createPostService,
        UpdatePostService $updatePostService,
        DeletePostService $deletePostService,
        PostRepositoryInterface $postRepository
        )
    {
        $this->createPostService = $createPostService;
        $this->updatePostService = $updatePostService;
        $this->deletePostService = $deletePostService;
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getAllPostsPaginated();

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
        $createPost = CreatePost::fromRequest($request);
        $this->createPostService->handle($createPost);
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
        $post = $this->postRepository->getPostById($post->id);
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

        $updatePost = UpdatePost::fromRequest($request, $post->id);
        $post = $this->updatePostService->handle($updatePost);

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
            $deletePost = DeletePost::make($post->id);
            $this->deletePostService->handle($deletePost);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', __('posts.record_not_found'));
        }

        return redirect()->route('posts.index')->with('success',__('posts.deleted_succesfully'));
    }

}
