<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(OfferRepository $offerRepository): Response
  {
    // 1 - Récupération de la donnée
    $offers = $offerRepository->findAll();

    // 2 - Transfert des données récupérées à la vue
    return $this->render('index/index.html.twig', [
      'offers' => $offers,
    ]);
  }
}
