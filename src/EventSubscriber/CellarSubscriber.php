<?php
namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Cellar;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class CellarSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    public function onCellarPost(ViewEvent $event): void
    {
        $cellar = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        $user = $this->security->getUser();

        if(!$cellar instanceof Cellar || Request::METHOD_POST !== $method || $cellar->getOwner()) {
            return;
        }

        $cellar->setOwner($user->getId());
    }

    public static function getSubscribedEvents(): array
    {
        return [
//            KernelEvents::VIEW => [
//                ['onCellarPost', EventPriorities::PRE_WRITE],
//            ]
        ];
    }
}
