<?php

namespace App\Services;

use Carbon\Carbon;

class PostService
{

    protected $authorService;

    public function __construct(AuthorService $author)
    {
        $this->authorService = $author;
    }
    public function listPost($page)
    {
        $size = 8;
        $posts = file_get_contents("http://maqe.github.io/json/posts.json");
        $posts_json = json_decode($posts, true);

        $start = ($page - 1) * $size;

        $total = count($posts_json);
        $lastPage = $total / $size;

        $posts_arr = array_slice($posts_json, $start, $size);
        $start += 1;

        $author_col = $this->authorService->listAuthor();

        return [
            'page' => $page,
            'last_page' => ceil($lastPage),
            'datas' => $this::setData($posts_arr, $author_col),
        ];

    }

    private function setData($posts_arr, $author_col)
    {
        return collect($posts_arr)->map(function ($item) use ($author_col) {
            return [
                'id' => $item['id'],
                'title' => $item['title'],
                'body' => $item['body'],
                'image_url' => $item['image_url'],
                'created_at' => Carbon::parse($item['created_at'])->diffForHumans(),
                'author' => $author_col->first(function ($value) use ($item) {
                    return $value['id'] == $item['author_id'];
                }),
            ];
        });
    }

}
