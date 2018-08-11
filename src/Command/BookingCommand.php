<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use App\Service\LoggerDependency;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\Booking\BookingProvider;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Psr\Log\LogLevel;

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
            ->addOption('numberGiven', 'g', InputOption::VALUE_REQUIRED, 'pass specific number for top')
        ;
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
            LogLevel::INFO   => OutputInterface::VERBOSITY_NORMAL,
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
                if ($input->getOption('numberGiven'))
                {
                    echo "Number OK! Top " .$selectedNumber. " selected\n";
//                    $selectedNumber = 10;
                }
                if (!$input->getOption('numberGiven'))
                {
                    echo "Number not specified, default top 10 selected\n";
                    $selectedNumber = 10;
                }



                //On sollicite notre service
                $this->bookingProvider->topBookings($selectedNumber);


//                $this->getContainer()->get('app.booking.provider')->sendMessage($input->getOption('send'), 'Votre message');
//                $this->log('info', sprintf('SMS send to %s', $input->getOption('send')));
            } catch (\Exception $e) {
//                $this->log('info', sprintf('Error to send an SMS to %s : %s', $input->getOption('blacklist'), $e->getMessage()));
            }



//        // Exécution de la commande avec l’option ‘list’
//        if ($input->getOption('list')) {
//            $output->writeln('List number from blacklist :');
//            $results = $this->bookingProvider->getHappyMessage();
////            $results = $this->getContainer()->get('app.booking.provider')->getBlacklist();
//            $output->writeln($results);
//        }
//
//        // Exécution de la commande avec l’option ‘blacklist’
//        // et son paramètre (numéro au format +336)
//        if ($input->getOption('blacklist')) {
////            $this->log('info', sprintf('Remove "%s" from blacklist', $input->getOption('blacklist')));
//
//            try {
////                $this->getContainer()->get('app.booking.provider')->removeFromBlacklist($input->getOption('blacklist'));
////                $this->log('info', sprintf('%s removed from blacklist', $input->getOption('blacklist')));
//            } catch (\Exception $e) {
////                $this->log('info', sprintf('Error to remove %s from blacklist : %s', $input->getOption('blacklist'), $e->getMessage()));
//            }
//        }
    }

}