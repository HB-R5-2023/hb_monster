<?php

namespace App\Controller;

use App\Entity\Offer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfferController extends AbstractController
{
  #[Route('/offer/{id}', name: 'offer_item')]
  public function item(Offer $offer): Response
  {
    return $this->render('offer/item.html.twig', [
      'offer' => $offer,
    ]);
  }
}
