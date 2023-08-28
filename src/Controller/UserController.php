<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserEntityRepository;

class UserController extends AbstractController
{

    private $userEntityRepository;
    public function __construct(UserEntityRepository $userEntityRepository){
        $this->userEntityRepository = $userEntityRepository;
    }
    #[Route('/users/{page}', name: 'app_user')]
    public function index(int $page = 1): Response
    {
        return $this->render('user/list.html.twig', [
            'controller_name' => 'UserController',
            'page' => $page
        ]);
    }
    #[Route('/users/list/{page}', name: 'app_user_list')]
    public function list(int $page = 1): Response
    {

        $itemsPerPage = 10; // Number of users per page
        $offset = ($page - 1) * $itemsPerPage;

        $users = $this->userEntityRepository->findBy([], null, $itemsPerPage, $offset);

        $totalCount = $this->userEntityRepository->count([]);

        $totalPages = ceil($totalCount / $itemsPerPage);

        return $this->render('user/users.html.twig', [
            'controller_name' => 'UserController',
            'page' => $page,
            'users' => $users,
            'totalPages' => $totalPages
        ]);
    }
}
