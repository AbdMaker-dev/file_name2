<?php
 namespace App\DataPersisters;


use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Profile;

class ProfileDataPersister implements ContextAwareDataPersisterInterface
 {
    public function supports($data, array $context = []): bool
    {
        // TODO: Implement supports() method.

        return $data instanceof Profile;
    }

    public function persist($data, array $context = [])
    {
        // TODO: Implement persist() method.
    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.

        $data->setDeleted(true);
        
    }


 }