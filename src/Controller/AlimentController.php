<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="app_index")
     */
    public function index(AlimentRepository $alimentRepository, PaginatorInterface $paginator, Request $request)
    {
        $aliments = $paginator->paginate(
          $alimentRepository->findAllWithPagination(),
          $request->query->getInt('page',1),
          10

        );

        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments
        ]);
    }
}

