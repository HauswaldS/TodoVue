<?php

namespace API\TodoApiBundle\Controller;

use API\TodoApiBundle\Entity\Todo;
use API\TodoApiBundle\Form\TodoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class TodoApiController extends Controller
{

    /**
     * @param Request $request
     * @return array
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Get("todos")
     *
     */
    public function cgetTodoAction(Request $request)
    {
        $todos = $this->getDoctrine()->getManager()->getRepository("APITodoApiBundle:Todo")->findAll();
        if ($todos) {
            return $todos;
        } else {
            return [];
        }
    }

    /**
     * @param Request $request
     * @return Todo|string
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Post("todos")
     */
    public function postTodoAction(Request $request)
    {
        $todo = new Todo();
        $form = $this->createForm(TodoType::class, $todo);
        $form->submit($request->request->all());


        if ($form->isValid()) {
            $todo->setMadeAt(new \DateTime('now'));
            $todo->setIsDone(false);
            $this->getDoctrine()->getManager()->persist($todo);
            $this->getDoctrine()->getManager()->flush();
            return $todo;
        } else {
            return $form;
        }
    }

    /**
     * @param Request $request
     * @return object|string
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Put("todos/{id}")
     */
    public function putTodoAction(Request $request, $id)
    {
        $todo = $this->getDoctrine()->getManager()->getRepository('APITodoApiBundle:Todo')->find($id);
        if ($todo) {
            $form = $this->createForm(TodoType::class, $todo);
            $form->submit($request->request->all());
            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->persist($todo);
                $this->getDoctrine()->getManager()->flush($todo);
                return $todo;
            } else {
                return $form;
            }
        } else {
            return Response::HTTP_NOT_FOUND;
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return int|string
     *
     * @Rest\View(statusCode=Response::HTTP_OK)
     * @Rest\Delete("todos/{id}/delete")
     */
    public function deleteTodoAction(Request $request, $id)
    {
        $todo = $this->getDoctrine()->getManager()->getRepository('APITodoApiBundle:Todo')->find($id);
        if ($todo) {
            $this->getDoctrine()->getManager()->remove($todo);
            $this->getDoctrine()->getManager()->flush();
            return "Todo deleted successfully";
        } else {
            return Response::HTTP_NOT_FOUND;
        }

    }

}
