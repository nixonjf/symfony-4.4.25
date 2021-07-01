<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class indexController extends AbstractController
{
    public function index(): Response
    {
        $user = $this->getUser();
        
        return new Response(
            '<html><body>Welcome  '.$user->getUsername().'! <br> <a href="/logout">logout</a></body></html>'
        );
    }
}
