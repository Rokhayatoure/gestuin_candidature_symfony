<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    #[Route('/api/formation', name: 'app_formation', methods:['GET'])]
    public function getAllFormation(FormationRepository $formationRepository,SerializerInterface $serializer): JsonResponse
    {
        $formationList= $formationRepository->findAll();
        $jsonformationList = $serializer->serialize($formationList, 'json');
        return new JsonResponse($jsonformationList, Response::HTTP_OK, [], true);
    }
    //sup formation
//     #[Route('/api/formation/{id}', name: 'deleteFormation', methods: ['DELETE'])]
//     public function deleteFormation(Formation $formation, EntityManagerInterface $em): JsonResponse 
//     {
//         $em->remove($formation,);
//         $em->flush();

//         return new JsonResponse(null, Response::HTTP_NO_CONTENT);
//     }
    
//     //ajout formation
    
//     #[Route('/formationcreat', name: "createFormation", methods: ['POST'])]
//     public function createFormation(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
//     {
//         try {
//             $formation = $serializer->deserialize($request->getContent(), Formation::class, 'json');
//             // Enregistrement
//             $em->persist($formation);
//             // Confirmer
//             $em->flush();
    
//             $jsonFormation = $serializer->serialize($formation, 'json', ['groups' => 'getFormations']);
    
//             return new JsonResponse($jsonFormation, Response::HTTP_CREATED);
//         } catch (\Exception $e) {
//             // Gérer d'autres types d'exceptions si nécessaire
//             $error = ['error' => $e->getMessage()];
//             return new JsonResponse($error, Response::HTTP_BAD_REQUEST);
//         }
//     }
//     //modifi formation

//    #[Route('/api/formation/{id}', name:"updateFormation", methods:['PUT'])]

//     public function updateFormation(Request $request, SerializerInterface $serializer, Formation $currentFormation, EntityManagerInterface $em, ): JsonResponse 
//     {
//         $updatedFormation = $serializer->deserialize($request->getContent(), 
//                 Formation::class, 
//                 'json', 
//                 [AbstractNormalizer::OBJECT_TO_POPULATE => $currentFormation]);
//         // $content = $request->toArray();
//         // $idAuthor = $content['idAuthor'] ?? -1;
//         // $updatedFormation->setAuthor($authorRepository->find($idAuthor));
        
//         $em->persist($updatedFormation);
//         $em->flush();
//         return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
// }
}