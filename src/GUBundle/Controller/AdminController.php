<?php

namespace GUBundle\Controller;

use GUBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GU/Admin/indexadmin.html.twig');
    }

    public function readAllUsersAction()
    {
        $users = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findAll();
        return $this->render('GUBundle:Admin:readAllUsers.html.twig',['users'=>$users]);
    }
    public function readUserByRoleAction(Request $request, $role)
    {
        $role=$request->attributes->get('role');
        $users = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findByRole($role);
        return $this->render('GUBundle:Admin:readAllUsers.html.twig',['users'=>$users]);
    }
    public function readUserAction($username)
    {
        $user = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findOneBy(['username' => $username]);
        return $this->render('GUBundle:Admin:readUser.html.twig',['username'=>$user]);
    }
}
