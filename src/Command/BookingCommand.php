<?php

namespace App\Command;

use DateTime;
use Symfony\Component\Console\Helper\TableStyle;

use App\Entity\Booking;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use App\Service\LoggerDependency;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\Booking\BookingProvider;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Psr\Log\LogLevel;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Helper\TableCell;

/**
 */
class BookingCommand extends Command
{

    private $bookingProvider;

    public function __construct(BookingProvider $bookingProvider)
    {
        parent::__construct();
        $this->bookingProvider = $bookingProvider;
    }

    protected function configure()
    {
        $this
            ->setName('app:booking:topbookings')
            ->setDescription('Booking Command : parameter -g for number of top | default at 10')
            ->addOption('numberGiven', 'g', InputOption::VALUE_REQUIRED, 'pass specific number for top');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $verbosityLevelMap = array(
            LogLevel::NOTICE => OutputInterface::VERBOSITY_NORMAL,
            LogLevel::INFO => OutputInterface::VERBOSITY_NORMAL,
        );
        $logger = new ConsoleLogger($output, $verbosityLevelMap);
        // Exécution de la commande avec l’option ‘send’
        // et son paramètre (numéro au format +336)


        $LoggerDependency = new LoggerDependency($logger);
//            $LoggerDependency->ready();

        try {
//                $LoggerDependency->numberGiven();

            //$bookingJobs = $ovh->get('/booking/'. $bookingServices[0] . '/jobs/'); print_r($bookingJobs);

            $selectedNumber = $input->getOption('numberGiven');
            if ($input->getOption('numberGiven')) {
                echo "Number OK! Top " . $selectedNumber . " selected\n";
//                    $selectedNumber = 10;
            }
            if (!$input->getOption('numberGiven')) {
                echo "Number not specified, default top 10 selected\n";
                $selectedNumber = 10;
            }
            $progressBar = new ProgressBar($output, 50);
            // starts and displays the progress bar

            //Top des livres loués
            $myQuery = $this->bookingProvider->topBookings($selectedNumber);

            //Nombre de livres avec statut inside pour un livre

            //Nombre de pbook pour un book
            foreach ($myQuery as $key => $value)
            {
                $nombreDePbookPourUnBook[] = $myQuery->getPBook();
            }

            // by default, this is based on the default style
            $tableStyle = new TableStyle();
            // customizes the style
            $tableStyle
                ->setDefaultCrossingChar('<fg=blue>|</>')
                ->setVerticalBorderChars('<fg=blue>-</>')//                    ->setDefaultCrossingChar(' ')
            ;

//                dump ($startdate);


            $table = new Table($output);

            $table
                ->setHeaders(array('ID des livres', 'Titre des livres', 'Nombre de livres disponibles', 'Nombre de livres totale', 'Nombre de bookings'));
//            ->setRows(array(new TableCell('This value spans 3 columns.', array('colspan' => 3))));


            foreach ($myQuery as $key => $value) {

                $startdate = $myQuery[$key]->getStartDate();
                $enddate = $myQuery[$key]->getEndDate();
                $result1 = $startdate->format('Y-m-d');
                $result2 = $enddate->format('Y-m-d');
                $result0 = $myQuery[$key]->getId();

                $table
                    ->addRow([
                        $result0, $result1, $result2]
//
                    );
            }
            $table->setStyle($tableStyle);
//                $table->setStyle('box-double');
            $table->render();

            $progressBar->start();
            $i = 0;
            while ($i++ < 50) {
                // ... do some work

                // advances the progress bar 1 unit
                $progressBar->advance();

                // you can also advance the progress bar by more than 1 unit
                // $progressBar->advance(3);
            }

// ensures that the progress bar is at 100%
            $progressBar->finish();
            //On sollicite notre service


//                dump($myQuery);

//                $this->getContainer()->get('app.booking.provider')->sendMessage($input->getOption('send'), 'Votre message');
//                $this->log('info', sprintf('SMS send to %s', $input->getOption('send')));
        } catch (\Exception $e) {
//                $this->log('info', sprintf('Error to send an SMS to %s : %s', $input->getOption('blacklist'), $e->getMessage()));
        }


    }

}