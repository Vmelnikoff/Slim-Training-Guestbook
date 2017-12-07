<?php


namespace App\Controllers;


use App\Models\Review;

class ReviewController extends Controller
{

    public function index($request, $response, $args)
    {

        $review = Review::find($args['id']);

        $prev = $review->getPrev($args['id']);
        $next = $review->getNext($args['id']);

        return $this->c->view->render($response, 'review.twig', [
            'review' => $review, 'prev' => $prev, 'next' => $next
        ]);

    }

}