<?php
namespace App\Services;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $serializer;
    private $validator;
    private $encoder;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, UserPasswordEncoderInterface $encoder)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->encoder = $encoder;
    }

    
    function addUserService($request, $entity)
    {
        //recupéreation de tout les attribut de la requette post
        $object = $request->request->all();
        
        //verification  si l'email existe au niveau de la base de donnée return object ou null
        $avatar = $request->files->get("avatare");

        dd($object['profile']);

        if (!$object['profile']) {
            dd("pas de profile");
        }

        
        if ($avatar){
            $avatar = fopen($avatar->getRealPath(), "rb");
            $object["avatare"] = $avatar;
        }
        $object = $this->serializer->denormalize($object, $entity);

        $errors = $this->validator->validate($object);
        // dd($errors);
        if (count($errors) != 0) {
            $errors = $this->serializer->serialize($errors, "json");
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST, [], true);
        }

        $object->setPassword($this->encoder->encodePassword($object, "passer_1234"));


       return  $object;

    }


}