<?php


namespace App\EventSubscriber;

use App\Repository\ClientRepository;
use App\Repository\RdvRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(private RdvRepository $rdsRepo, private ClientRepository $clientRepo)
    {

    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        $rdvs = $this->rdsRepo->findAll();

        foreach ($rdvs as $rdv) {
            $client = $this->clientRepo->find($rdv->getClient());
            $event = new Event(
                $client->getIdentity(),
                $rdv->getDateDebut(),
                $rdv->getDateFin(),
                [
                    'allDay' => false
                ]
            );

            $calendar->addEvent($event);
        }
    }
}