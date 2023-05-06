<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route('/student/{id}', name: 'detail_Student')]
    public function getStudent(Student $student): Response
    {
        // $student = $repo->find($id);
        return $this->render(
            'student/getStudent.html.twig',
            [
                'student' => $student
            ]
        );
    }

    #[Route('/deleteStudent/{id}', name: 'delete_Student')]
    public function deleteStudent(Student $student, StudentRepository $repo): Response
    {

        // $student = $repo->find($id);
        $repo->remove($student, true);

        return $this->redirectToRoute('student_showS');
    }
    #[Route('/addStudent', name: 'student_add')]
    public function addStudent(Request $req, ManagerRegistry $em): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);

        $form->handleRequest($req);

        if ($form->isSubmitted()) {
            $manager = $em->getManager();
            $manager->persist($student);
            $manager->flush();
            return $this->redirectToRoute('student_showS');
        }
        return $this->render(
            "student/add.html.twig",
            [
                "f" => $form->createView()
            ]
        );
    }
    #[Route('updateStudent/{id}', name: 'student_update')]
    public function updateStudent(Request $req, Student $student, ManagerRegistry $em): Response
    {

        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($req);

        if ($form->isSubmitted()) {
            $manager = $em->getManager();
            $manager->persist($student);
            $manager->flush();
            return $this->redirectToRoute('student_showS');
        }
        return $this->renderForm(
            "student/add.html.twig",
            [
                "f" => $form
            ]
        );
    }
}
