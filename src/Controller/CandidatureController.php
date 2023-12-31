<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Formation;
use App\Entity\Candidature;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatureController extends AbstractController
{
    #[Route("api/postuler", name:"postuler", methods:["POST"])]
    public function postuler(Request $request, EntityManagerInterface $entityManager): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $candidat = $this->getUser();
        $data = json_decode($request->getContent(), true);

        $user = $this->getUser(); 
        $formationId = $data['formation_id'];


        $candidatureExistante = $entityManager->getRepository(Candidature::class)->findOneBy([
            'user' => $user,
            'formation' => $formationId
        ]);

        if ($candidatureExistante) {
            return $this->json(['message' => 'Vous avez déjà postulé à cette formation'], Response::HTTP_BAD_REQUEST);
        }


        // $formation = $entityManager->getRepository(Formation::class)->findOneBy(['nom_formation' => $data['nom_formation']]);

        // if (!$formation) {
        //     return $this->json(['message' => 'Formation non trouvée'], Response::HTTP_NOT_FOUND);
        // }

        $candidature = new Candidature();
        $candidature->setUser($candidat);
        // $candidature->setFormation($formation);

        $entityManager->persist($candidature);
        $entityManager->flush();

        return $this->json(['message' => 'Candidature enregistrée'], Response::HTTP_OK);
    }


    #[Route("api/changerStatut/{candidatureId}", name: "changer_statut", methods: ["PUT"])]
public function changerStatut(int $candidatureId, Request $request, EntityManagerInterface $entityManager): Response
{
    $candidature = $entityManager->getRepository(Candidature::class)->find($candidatureId);

    if (!$candidature) {
        return $this->json(['message' => 'Candidature non trouvée'], Response::HTTP_NOT_FOUND);
    }

    $data = json_decode($request->getContent(), true);

    $nouveauStatut = "refuser";

    // Assurez-vous que $nouveauStatut est une chaîne (string)
    if (!is_string($nouveauStatut)) {
        return $this->json(['message' => 'Le nouveau statut doit être une chaîne (string)'], Response::HTTP_BAD_REQUEST);
    }

    // Utilisez la méthode correcte pour mettre à jour le statut
    $candidature->setStatus($nouveauStatut);

    // Enregistrez les modifications
    $entityManager->flush();

    return $this->json(['message' => 'Statut modifié avec succès'], Response::HTTP_OK);
}

    


}

