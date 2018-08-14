<?php

namespace App\Command;

use Symfony\Component\Console\Helper\TableStyle;
use App\Entity\Booking;
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
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $verbosityLevelMap = array(
            LogLevel::NOTICE => OutputInterface::VERBOSITY_NORMAL,
            LogLevel::INFO => OutputInterface::VERBOSITY_NORMAL,
        );
        $logger = new ConsoleLogger($output, $verbosityLevelMap);

        $LoggerDependency = new LoggerDependency($logger);
        $LoggerDependency->ready();

        try {
//                $LoggerDependency->numberGiven();

            $selectedNumber = $input->getOption('numberGiven');
            if ($input->getOption('numberGiven')) {
                echo 'Number OK! Top '.$selectedNumber." selected\n";
            }
            if (!$input->getOption('numberGiven')) {
                echo "Number not specified, default top 10 selected\n";
                $selectedNumber = 10;
            }
            $progressBar = new ProgressBar($output, 50);
            // starts and displays the progress bar

            $progressBar->start();
            $i = 0;
            while ($i++ < 50) {
                // ... do some work

                //Top des livres loués
                $myQuery = $this->bookingProvider->topBookings($selectedNumber);
                // advances the progress bar 1 unit
                $progressBar->advance();

                // you can also advance the progress bar by more than 1 unit
                // $progressBar->advance(3);
            }
            echo "\n";
            // by default, this is based on the default style
            $tableStyle = new TableStyle();
            // customizes the style
            $tableStyle
                ->setDefaultCrossingChar('<fg=blue>|</>')
                ->setVerticalBorderChars('<fg=blue>-</>')
                //                    ->setDefaultCrossingChar(' ')
            ;

            $table = new Table($output);

            $table
                ->setHeaders(array('ID des livres', 'Titre des livres', 'Nombre de bookings'));

            foreach ($myQuery as $booking) {
                $idbook = $booking->getPbook()->getBook()->getId();
                $valueTitre = $booking->getPbook()->getBook()->getTitle();
                $valueCount = count($booking->getPBook()->getBookings());

                $table
                    ->addRow(
                        [
                            $idbook, $valueTitre, $valueCount, ]
                    );
            }
            $table->setStyle($tableStyle);
            $table->render();

            // ensures that the progress bar is at 100%
            $progressBar->finish();
            echo "\n";
//                $this->getContainer()->get('app.booking.provider')->sendMessage($input->getOption('send'), 'Votre message');
//                $this->log('info', sprintf('SMS send to %s', $input->getOption('send')));
        } catch (\Exception $e) {
//                $this->log('info', sprintf('Error to send an SMS to %s : %s', $input->getOption('blacklist'), $e->getMessage()));
        }
    }
}
