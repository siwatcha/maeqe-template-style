<?php
namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class PostController extends BaseController
{

    protected $postService;

    public function __construct(PostService $post)
    {
        $this->postService = $post;
    }

    public function listPost(Request $request)
    {
        $page = $request->input('page');

        $posts = $this->postService->listPost($page);

        return View::make('post')->with('posts', $posts);
    }

}
