<?php

namespace App\Controllers;


use App\Models\Review;
use Slim\Http\Request;
use Slim\Http\Response;

class VoteController
{
    public function send(Request $request, Response $response, $args)
    {
        // Делаем вставку в БД
        $likes = Review::select('likes')->where('id', $args['id'])->get()[0]['likes'];
        $likes++;
        Review::where('id', $args['id'])->update([
            'likes' => $likes,
        ]);

        // Возвращаемся на главную
        return $response->withRedirect('/');
    }
}