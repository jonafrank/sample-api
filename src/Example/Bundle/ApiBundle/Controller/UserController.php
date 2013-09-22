<?php

namespace Example\Bundle\ApiBundle\Controller

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Example\Bundle\ApiBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Rest\View
     */
    public function allAction()
    {
        $users = $this->getDoctrine->getRepository('ExampleApiBundle:User')->findAll();

        return array('users' => $users);
    }

    /**
     * @Rest\View
     */
    public function getAction($id)
    {
        $user =$this->getDoctrine->getRepository('ExampleApiBundle:User')->find($id);

        if (!$user instanceof User) {
            throw new NotFoundHttpException('User not found');
        }

        return array('user' => $user);
    }
}