<?php

namespace RecipeBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class LastRecipes
{
    private $repository;

    public function __construct(ObjectManager $objectManager)
    {
        $this->repository = $objectManager->getRepository('RecipeBundle:Recipe');
    }

    public function findLastRecipes()
    {
        return $this->repository->findLastRecipes();
    }
}
