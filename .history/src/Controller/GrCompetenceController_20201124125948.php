<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\GroupeCompetence;
use App\Entity\Niveau;
use App\Repository\CompetenceRepository;
use App\Repository\GroupeCompetenceRepository;
use App\Services\ApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

/**
     * @Route("/api/admins")
     */
class GrCompetenceController extends AbstractController
{
    /**
     * @Route("/groupe_competences", name="add_gr_competence",  methods={"POST"})
     */
    public function addGroupeComptence(Request $request, ApiService $apiService, SerializerInterface $serialize, CompetenceRepository $repo_Competence, EntityManagerInterface $em): Response
    {
        // security du route
        if (in_array("ROLE_APPRENANT", $this->getUser()->getRoles())) {
            return $this->json([
                'message' => 'Acces no autoriser',
            ]);
                }


        $data_gr_competence = json_decode($request->getContent(),true);
        
        $new_gr_competence = new GroupeCompetence();

        $new_gr_competence->setLibelle($data_gr_competence['libelle']);

        $new_gr_competence->setComptences($apiService->getCompetences($data_gr_competence['competences']));

        $em->persist($new_gr_competence);
        $em->flush();
        
        return $this->json([
            'message' => 'Succes'
        ]);
    }


    /**
     * @Route("/groupe_competences/{id}", name="update_gr_competence",  methods={"PUT"})
     */
    public function updateGroupeComptence(int $id,ApiService $apiService, Request $request, SerializerInterface $serialize, CompetenceRepository $repo_Competence, EntityManagerInterface $em, GroupeCompetenceRepository $repo_grC): Response
    {

        // security du route
        if (in_array("ROLE_APPRENANT", $this->getUser()->getRoles())) {
            return $this->json([
                'message' => 'Acces no autoriser',
            ]);
        }        

        $data_gr_competence = json_decode($request->getContent(),true);
        
        $new_gr_competence = $repo_grC->fond($id);

        if (isset($data_gr_competence['libelle'])){
            $new_gr_competence->setLibelle($data_gr_competence['libelle']);
        }

        $new_gr_competence->setComptences($apiService->getCompetences($data_gr_competence['competences']));

        $em->flush();
        
        return $this->json([
            'message' => 'Succes'
        ]);
    }
}