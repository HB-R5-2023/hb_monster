<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Offer;
use App\Form\ApplicationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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

  #[Route('/offer/{id}/apply', name: 'offer_apply')]
  public function apply(Offer $offer, Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
  {
    $application = new Application();
    $form = $this->createForm(ApplicationType::class, $application);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $application->setOffer($offer);
      $em->persist($application);
      $em->flush();
      $email = (new Email())
        ->from('admin@hb-corp.com')
        ->to($application->getEmail())
        ->subject('Inscription à la newsletter')
        ->text('Merci, votre candidature a bien été enregistrée. Vous serez contacté sous peu.');

      $mailer->send($email);
      return $this->redirectToRoute('application_confirm');
    }

    return $this->renderForm('offer/apply.html.twig', [
      'applicationForm' => $form,
      'offer' => $offer
    ]);
  }

  #[Route('/application/confirm', name: 'application_confirm')]
  public function applicationConfirm(): Response
  {
    return $this->render('offer/apply.confirm.html.twig');
  }
}
