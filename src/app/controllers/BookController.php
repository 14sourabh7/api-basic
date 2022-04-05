<?php

use Phalcon\Mvc\Controller;


class BookController extends Controller
{
    public function indexAction()
    {
        $this->response->redirect('/');
    }
    public function searchAction()
    {
        $apihelper = new \App\Components\Apihelper();
        $book = $this->request->get('book');
        $this->view->bookresults = [];
        if ($book) {
            $book = urlencode($book);
            $response = $apihelper->getSearchResponse($book);
            $this->session->set('details', $response['docs']);
            $this->view->bookresults = $response['docs'];
        } else {
            $this->response->redirect('/');
        }
    }

    public function detailsAction()
    {
        $apihelper = new \App\Components\Apihelper();
        $book = $this->request->get('isbn');
        if ($book) {
            $addDetails = $this->session->get('details');
            $response = $apihelper->getIsbnresponse($book);
            $this->view->addDetails = $addDetails[$this->request->get('key')];
            $this->view->details = $response['ISBN:' . $book];
            $this->view->cover = $this->request->get('cover');
        }
    }
}
