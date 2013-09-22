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
}