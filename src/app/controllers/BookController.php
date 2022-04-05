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
        //getting search input
        $book = $this->request->get('book');
        $this->view->bookresults = [];
        if ($book) {
            $book = urlencode($book);

            //calling api helper class for response
            $response = $this->api->getSearchResponse($book);

            //setting data in session which I need in other pages as well to prevent multiple api requests
            $this->session->set('details', $response['docs']);
            $this->view->bookresults = $response['docs'];
        } else {
            $this->response->redirect('/');
        }
    }

    public function detailsAction()
    {
        $book = $this->request->get('isbn');
        if ($book) {
            $addDetails = $this->session->get('details');

            //calling api helper class for response
            $response = $this->api->getIsbnresponse($book);

            $this->view->addDetails = $addDetails[$this->request->get('key')];
            $this->view->details = $response['ISBN:' . $book];
            $this->view->cover = $this->request->get('cover');
        }
    }
}
