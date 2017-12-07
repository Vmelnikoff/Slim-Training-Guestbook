<?php


namespace App\Controllers;



use App\App;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        // Определяем IP
//        $ip = App::getIP($request->getServerParams());


        if (empty($request->getParams()['sortlike'])) {
            $sortlike = 'ASC';
        } else {
            $sortlike = ($request->getParams()['sortlike'] == 'ASC') ? 'DESC' : 'ASC';
        }

        if (empty($request->getParams()['sortdate'])) {
            $sortdate = 'ASC';
        } else {
            $sortdate = ($request->getParams()['sortdate'] == 'ASC') ? 'DESC' : 'ASC';
        }

        $reviews = $this->c->review
            ->orderBy('created_at', $sortdate)
            ->orderBy('likes', $sortlike)
            ->get();

        return $this->c->view->render($response, 'index.twig', [
            'reviews' => $reviews, 'sortdate' => $sortdate, 'sortlike' => $sortlike,
        ]);
    }

}
