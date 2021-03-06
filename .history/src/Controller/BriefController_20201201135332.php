<?php

namespace App\Controller;

use DateTime;
use App\Entity\EtatBrief;
use App\Services\ApiService;
use App\Repository\TagsRepository;
use App\Repository\BriefRepository;
use App\Repository\PromoRepository;
use App\Repository\GroupeRepository;
use App\Repository\NiveauRepository;
use App\Repository\EtatBriefRepository;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/api/formateur")
*/
class BriefController extends AbstractController
{
    /**
     * @Route("/promo/{id}/groupe/{di}/briefs", name="promo_id_groupe_id_briefs", methods={"GET"})
     */
    public function getPromoIdGroupeIdBriefs(int $id, int $di, PromoRepository $repo_promo, SerializerInterface $serializer): Response
    {

        $promo_groups = $repo_promo->findOneByPomoIdGroupeId($id,$di);

        if (!$promo_groups) {
            return $this->json([
                'message' => 'not found!!!'
            ]);
        }

        $reslt = $serializer->serialize($promo_groups, "json", ["groups"=>"groupe_briefs:read"]);
        return $this->json([
            'message' => 'oki',
            'code' => 200,
            'result' => $reslt
        ]);
    }

    /**
     * @Route("/promos/{id}/briefs", name="promo_id_briefs", methods={"GET"})
     */
    public function getPromoIdBriefs(int $id, PromoRepository $repo_promo, SerializerInterface $serializer): Response
    {

        $promo = $repo_promo->findOneById($id);

        if (!$promo) {
            return $this->json([
                'message' => 'not found!!!'
            ]);
        }

        $reslt = $serializer->serialize($promo, "json", ["groups"=>"groupe_briefs:read"]);
        return $this->json([
            'message' => 'oki',
            'code' => 200,
            'result' => $reslt
        ]);
    }

    /**
     * @Route("/{id}/briefs/broullons", name="getFormateurIdBriefsBroullon", methods={"GET"})
     */
    public function getFormateurIdBriefsBroullon(int $id, BriefRepository $repo_brief, EtatBriefRepository $repo_etat, SerializerInterface $serializer): Response
    {

        $etat = $repo_etat->findOneByLibelle("BROULLON");

        $brief = $repo_brief->findByEtatBrief($id, $etat->getId());

        if (!$etat or !$brief) {
            return $this->json([
                'message' => 'not found!!!'
            ]);
        }

        $reslt = $serializer->serialize($brief, "json", ["groups"=>"brief:read"]);
        return $this->json([
            'message' => 'oki',
            'code' => 200,
            'result' => $reslt
        ]);
    } 
    
    /**
     * @Route("/{id}/briefs/valide", name="getFormateurIdBriefsValider", methods={"GET"})
     */
    public function getFormateurIdBriefsValider(int $id, BriefRepository $repo_brief, EtatBriefRepository $repo_etat, SerializerInterface $serializer): Response
    {

        $etat = $repo_etat->findOneByLibelle("VALIDE");

        $brief = $repo_brief->findByEtatBrief($id, $etat->getId());

        if (!$etat or !$brief) {
            return $this->json([
                'message' => 'not found!!!'
            ]);
        }

        $reslt = $serializer->serialize($brief, "json", ["groups"=>"brief:read"]);
        return $this->json([
            'message' => 'oki',
            'code' => 200,
            'result' => $reslt
        ]);
    }     


    /**
     * @Route("/promo/{id}/briefs/{di}", name="getPromoIdBriefsId", methods={"GET"})
     */
    public function getPromoIdBriefsId(int $id, int $di, PromoRepository $repo_promo, SerializerInterface $serializer): Response
    {
        $promo_groups = $repo_promo->findOneByPomoIBriefId($id,$di);
        if (!$promo_groups) {
            return $this->json([
                'message' => 'not found!!!'
            ]);
        }

        $reslt = $serializer->serialize($promo_groups, "json", ["groups"=>"groupe_briefs:read"]);
        return $this->json([
            'message' => 'oki',
            'code' => 200,
            'result' => $reslt
        ]);
    }


    /**
     * @Route("/briefs/{di}", name="postBriefsId", methods={"POST"})
     */
    public function postBriefsId(int $id, BriefRepository $repo_brief, SerializerInterface $serializer, EntityManagerInterface $em): Response
    {
        $brief = $repo_brief->findOneById($id);

        if (!$brief) {
            return $this->json([
                'message' => 'not found!!!'
            ]);
        }

        $new_brief = $brief;

        $new_brief->setId(null);

        $em->persist($new_brief);
        $em->flush();

        $reslt = $serializer->serialize($new_brief, "json", ["groups"=>"briefs:read"]);

        return $this->json([
            'message' => 'oki',
            'code' => 200,
            'result' => $reslt
        ]);
    }

    /**
     * @Route("/briefs", name="postBriefs", methods={"POST"})
     */
    public function postBriefs(Request $request, ValidatorInterface $validate, BriefRepository $repo_brief, ApiService $apiService, SerializerInterface $serializer, EntityManagerInterface $em, NiveauRepository $repo_niv, TagsRepository $repo_tag, FormateurRepository $repo_forma, EtatBriefRepository $repo_etaBrief, GroupeRepository $repo_groupe): Response
    {

        $data = json_decode($request->getContent(), true);
        if (!$data) {
            $data = $request->request->all();
        }

        foreach ($request->files as $key => $file) {
            if($key=="ressource"){
                foreach ($file as $key => $value) {
                    $ress = fopen($value->getRealPath(), "rb");  
                    $data["ressource"]["pieceJointe"] = $ress;
                }
            }else{
                $img = fopen($file->getRealPath(), "rb");
                $data["image"] = $img;
            }
        }

        $data = $apiService->unsetter($data, ["niveauCompetences", "tags", "formateur", "etatBrief", "groupes"]);

        $new_brief = $serializer->denormalize($data[0], "App\Entity\Brief");

        $new_brief = $apiService->assigned($new_brief ,"niveauCompetences", $data[1]["niveauCompetences"], $repo_niv);
        $new_brief = $apiService->assigned($new_brief ,"tags", $data[1]["tags"], $repo_tag);
        $new_brief = $apiService->assigned($new_brief ,"groupes", $data[1]["groupes"], $repo_groupe);
        $new_brief->setFormateur($repo_forma->findOneById($data[1]["formateur"]));
        $new_brief->setEtatBrief($repo_etaBrief->findOneById($data[1]["etatBrief"]));
        $new_brief->setDateCreation(new DateTime());

        foreach ($new_brief->getGroupes() as $key => $groupe) {
            $new_brief->addPromo($groupe->getPromo());
        }

        $errors = $validate->validate($new_brief);
        if (count($errors) != 0) {
            $errors = $this->serializer->serialize($errors, "json");
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
        } 

        $em->persist($new_brief);
        $em->flush();

        $reslt = $serializer->serialize($new_brief, "json", ["groups"=>"brief:read"]);

        return $this->json([
            'message' => 'created',
            'code' => 201,
            'result' => $reslt
        ]);
    }    

}
