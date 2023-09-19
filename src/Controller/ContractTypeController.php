<?php

namespace App\Controller;

use App\Entity\ContractType;
use App\Repository\ContractTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContractTypeController extends AbstractController
{
  #[Route('/contract/types', name: 'app_contract_type')]
  public function index(ContractTypeRepository $contractTypeRepository): Response
  {
    $types = $contractTypeRepository->findAll();

    return $this->render('contract_type/index.html.twig', [
      'types' => $types,
    ]);
  }

  #[Route('/contract/types/{name}', name: 'contract_type_item')]
  public function item(ContractType $contractType): Response
  {
    return $this->render('contract_type/contract.html.twig', [
      'contract_type' => $contractType
    ]);
  }
}
