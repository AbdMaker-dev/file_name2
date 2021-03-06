<?php

namespace App\Controller;

use App\Services\UserService;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


    /**
     * @Route("/api/admins")
     */
class UserController extends AbstractController
{

    private $profile;


    public function __construct(ProfileRepository $profile)
    {
        $this->profile = $profile;

    }
    /**
     * @Route("/apprenants/registre", name="apprenant_registre", methods={"post"})
     */
    public function addApprenant(Request $request, UserService $us_serice,  $entityManager): Response
    {
        $new_apprenant = $us_serice->addUserService($request, "App\Entity\Apprenant");
        
        $prfl = $this->profile->findOneBySomeField("APPRENANT");

        $new_apprenant->setProfile($prfl);
        // dd($new_apprenant);

        $entityManager->persist($new_apprenant);
        $entityManager->flush();

        return $this->json([
            'message' => 'Succes',
        ]);
    }

    /**
     * @Route("/registre", name="admin_registre", methods={"POST"})
     */
    public function addAdmin(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }  
    

    /**
     * @Route("/cm/registre", name="cm_registre", methods={"POST"})
     */
    public function addCm(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }  
    
    
    /**
     * @Route("/formateurs/registre", name="user", methods={"POST"})
     */
    public function addFormateur(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }      
}
