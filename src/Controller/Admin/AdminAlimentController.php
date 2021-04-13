<?php

namespace App\Controller\Admin;

use App\Repository\AlimentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliments", name="app_admin_aliments_index", methods="GET")
     */
    public function index(AlimentRepository $alimentRepository, PaginatorInterface $paginator, Request $request)
    {
        {
            $aliments = $paginator->paginate(
                $alimentRepository->findAllWithPagination(),
                $request->query->getInt('page', 1),
                10

            );


            return $this->render('admin/admin_aliment/index.html.twig', [
                'aliments' => $aliments,
            ]);
        }
    }
}
