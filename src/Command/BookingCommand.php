<?php

namespace App\Command;

use App\Entity\Booking;
use App\Entity\Library;
use App\Entity\Member;
use App\Entity\PBook;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Workflow\Registry;


class BookingCommand extends ContainerAwareCommand
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var SymfonyStyle
     */
    private $io;

    /**
     * @var Registry
     */
    private $registry;


    public function __construct(
        EntityManagerInterface $entityManager
        , $name = null
    )
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;

        $this->registry = new Registry();
    }

    protected function configure()
    {
        $this
            ->setName('app:booking')
            ->setDescription('Create booking from specified date to now')
            ->setHelp('Create booking from specified date to now')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $libraries = $this->entityManager->getRepository( Library::class )->findAll();

        $this->io = new SymfonyStyle($input, $output);

        $this->io->title('Create booking');

        $libraryNames = array_map(function ( $library ){ return $library->getName(); }, $libraries);
        array_unshift($libraryNames, 'Tous');

        $libraryName = $this->io->choice( 'Librairie', $libraryNames );

        $pbooks = ( $libraryName === 'Tous' )
            ? $this->entityManager->getRepository( PBook::class )->findAll()
            : $this->entityManager->getRepository( PBook::class)
                ->findBy( ['library' => $this->entityManager->getRepository(Library::class)->findOneBy( ['name' => $libraryName] )] )
        ;
        $members = $this->entityManager->getRepository( Member::class )->findAll();

        $days = intval($this->io->ask( 'From how many day(s) ?' ));

        $daysProgressBar = $this->io->createProgressBar($days);
        $daysProgressBar->setMessage( 'SubCategories' );
        $daysProgressBar->display();
        $daysProgressBar->start();

        $this->io->newLine(2);

        $date = new DateTime( 'now' );
        $k = 0;

        for ( $i = 0; $i < $days; $i++ ) {
            $date->modify("-$k day");
            $k++;

            foreach ( $members as $member ) {
                $bookingCounr = $this->entityManager->getRepository(Booking::class )->countBooking(false, $member->getId(), true, false, $date );

                dd($bookingCounr);
                foreach ( $pbooks as $pbook ) {
//                    $workflow = $this->get('workflow.pbook_status');
                    $workflow = $this->registry->get($pbook, 'pbook_status');

                    $this->io->text($pbook->getBook()->getTitle());
                    $this->io->text($workflow->getEnabledTransitions($pbook));
                }
            }
            $daysProgressBar->advance(1);
        }

        $daysProgressBar->finish();

        $this->io->newLine(2);
        $this->io->section('yo');

        $this->io->success( 'Days : ' . $days );
//        $this->io->success( 'Categories : ' . count($categories) . ' - SubCategories : '  . count($subCategories) . ' - Books : ' . count($books) );
    }
}
