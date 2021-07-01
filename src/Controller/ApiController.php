<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApiController extends AbstractController
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function login(Request $request): Response
    {
        $email = 'lkl@dd.ccc';
        $password = 'lkl@dd.ccc';


        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);


        if (!$user) {
            return JsonResponse::create(['status' => 'User not found'], 404, [], true);
        }

        if (!$this->passwordEncoder->isPasswordValid($user, $password)) {
            return JsonResponse::create(['status' => 'Incorrect password'], 404, [], true);
        }


        return JsonResponse::create(['data' => ['apiKey' => $user->getApiKey()], 'status' => 'Success'], 200, [], true);
    }
}
