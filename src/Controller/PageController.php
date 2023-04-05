<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class PageController
{
    #[Route('/home')]
    public function home(Request $request) : Response
    {
        $search = $request->get('search');

        return new Response('Welcome, home page ' . $search);
    }
}