<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }

    #[Route('/show/{name}', name: 'student_show')]
    public function show($name): Response
    {
        $students = [
            ['fname' => 'Zeineb', "lName" => 'BenJemaa'],
            ['fname' => 'Amir', "lName" => 'BenJemaa'],
        ];
        return $this->render(
            'student/show.html.twig',
            [
                'list' => $students,
                'name' => $name,
            ]
        );
    }

    #[Route('/showStudents', name: 'student_showS')]
    public function showStudents(StudentRepository $st): Response
    {
        // $students = $em->getRepository(Student::class)->findAll();
        $students = $st->findAll();
        return $this->render(
            'student/showStudents.html.twig',
            [
                'students' => $students
            ]
        );
    }
}
