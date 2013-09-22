<?php

namespace Example\Bundle\ApiBundle\Controller;


use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Example\Bundle\ApiBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    
    public function allAction()
    {

        $users = $this->getDoctrine()->getRepository('ExampleApiBundle:User')->findAll();
        $response = new Response();
        if ($users)  {
            $response->setStatusCode(200);
            $response->setContent(json_encode($users, true));
        } else {
            throw new NotFoundHttpException('there are no Users');
        }   

        return $response;
    }

    
    public function getAction($id)
    {

        $users =$this->getDoctrine()->getRepository('ExampleApiBundle:User')->find($id);

        $response = new Response();
        if ($users)  {
            $response->setStatusCode(200);
            $response->setContent(json_encode($users, true));
        } else {
            throw new NotFoundHttpException('there are no Users');
        }   

        return $response;
    }

    public function newAction()
    {
        $request = json_decode($this->getRequest()->getContent());

        $user = new User();
        $user->setUsername($request->username);
        $user->setEmail($request->email);
        $user->setPassword($request->password);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($user);
        
        $em->flush();
        
        $response = new Response();
        $response->setStatusCode(201);
        $response->setContent(json_encode($user));
        return $response;
    }

    public function editAction($id)
    {
        $request = json_decode($this->getRequest()->getContent(), true);
        
        $user = $this->getDoctrine()->getRepository('ExampleApiBundle:User')->find($id);
        
        if ($user) {
            $user->setBatch($request);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();
            $response = new Response();
            $response->setStatusCode(201);
            $response->setContent(json_encode($user));
        return $response;

        } else {
            throw new NotFoundHttpException('there are no Users');
        }  
    }

    public function deleteAction($id) 
    {
        $user = $this->getDoctrine()->getRepository('ExampleApiBundle:User')->find($id);

        if ($user) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($user);
            $em->flush();
            $response = new Response();
            $response->setStatusCode(204);
            return $response;
        } else {
            throw new NotFoundHttpException('there are no Users');
        }
    }
}