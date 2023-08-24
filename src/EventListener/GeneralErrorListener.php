<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Event listener for handling and logging exceptions.
 */
class GeneralErrorListener implements EventSubscriberInterface
{
    private $logger;

    /**
     * Constructs a new GeneralErrorListener instance.
     *
     * @param LoggerInterface $logger The logger for error logging
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Returns the subscribed events for the listener.
     *
     * @return array The subscribed events and corresponding methods
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    /**
     * Handles and logs exceptions.
     *
     * @param ExceptionEvent $event The exception event
     * @return void
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $this->logger->error('An error occurred: ' . $exception->getMessage());
    }
}
