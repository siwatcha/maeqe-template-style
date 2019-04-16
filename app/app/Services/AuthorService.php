<?php

namespace App\Services;

class AuthorService
{
    public function listAuthor()
    {
        $author_str = file_get_contents("http://maqe.github.io/json/authors.json");
        $author_json = json_decode($author_str, true);

        return collect($author_json)->map(function ($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'role' => $item['role'],
                'place' => $item['place'],
                'avatar_url' => $item['avatar_url'],
            ];
        });
    }
}
