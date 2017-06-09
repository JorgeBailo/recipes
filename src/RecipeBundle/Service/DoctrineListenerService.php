<?php

namespace RecipeBundle\Service;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use RecipeBundle\Entity\Recipe;

class DoctrineListenerService implements EventSubscriber
{

    protected $container;
    protected $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $this->container->get('recipe_logger');
    }

    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
            'preRemove',
            'postRemove'
        );
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Recipe)
        {
            $entity = $args->getEntity();
            $this->logger->info("Recipe created", array("idrecipe" => $entity->getId()));
        }
    }

    /**
     * This method will called on Doctrine postUpdate event
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Recipe)
        {
            $entity = $args->getEntity();
            $this->logger->info("Recipe updated", array("idrecipe" => $entity->getId()));
        }
    }

    /**
     * This method will called on Doctrine preRemove event
     */
    public function preRemove(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Recipe)
        {
            $entity = $args->getEntity();
            $this->logger->info("Deleting Recipe", array("idrecipe" => $entity->getId()));
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Recipe)
        {
            $this->logger->info("Recipe Deleted");
        }
    }
}