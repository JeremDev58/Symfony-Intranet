<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Client;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $clients_nouveau = $this->getDoctrine()->getRepository(Client::class)->findBy(array(), array('id' => 'DESC'),5);
        $clients_consult = $this->getDoctrine()->getRepository(Client::class)->findBy(array(), array('nb_visites' => 'DESC'),5);

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'clients_nouveau' => $clients_nouveau,
            'clients_consult' => $clients_consult,
        ]);
    }
}
