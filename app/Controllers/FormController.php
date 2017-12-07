<?php


namespace App\Controllers;


use App\Models\Review;
use Slim\Http\Request;
use Slim\Http\Response;

class FormController extends Controller
{
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->view->render($response, 'form.twig');
    }

    public function send(Request $request, Response $response, $args)
    {
        if (!empty($request->getParams()['first_name']) && !empty($request->getParams()['note'])) {

            // Делаем вставку в БД
            Review::create($request->getParams());

            // Возвращаем страницу успешной записи
            return $this->c->view->render($response, 'form-success.twig');
        }

        return $this->c->view->render($response, 'form.twig');
    }

}