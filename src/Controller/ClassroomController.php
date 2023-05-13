<?php

namespace App\Controller;

use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/showClassroom', name: 'showClassroom')]
    public function showClassroom(ClassroomRepository $r): Response
    {
        $classrooms = $r->findAll();
        return $this->render('classroom/showC.html.twig', [
            'c' => $classrooms,
        ]);
    }
}
