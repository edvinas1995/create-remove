<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Products;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/create")
     */
    public function createAction(){

        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setTitle("higiena");

        $product = new Products();
        $product->setTitle("Šampūnas");
        $product->setPrice("56.76");
        $product->setActive(1);
        $product->setCategory($category);

        $em->persist($category);
        $em->persist($product);

        $em->flush();

        return new Response("saved!");
    }


    /**
     * @Route("/remove/{id}")
     */
    public function removeAction(Products $product){

        $em = $this->getDoctrine()->getManager();
//      $product = $em->getRepository('AppBundle:Product')->find($id);

        $em->remove($product);
        $em->flush();

        return new Response("removed!");

    }
}
