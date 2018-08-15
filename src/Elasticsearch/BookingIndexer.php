<?php

namespace App\Command;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use Elastica\Client;
use Elastica\Document;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BookingIndexer
{
    private $client;
    private $bookingRepository;
    private $router;

    public function __construct(Client $client, BookingRepository $bookingRepository, UrlGeneratorInterface $router)
    {
        $this->client = $client;
        $this->bookingRepository = $bookingRepository;
        $this->router = $router;
    }

    public function buildDocument(Booking $booking)
    {
        return new Document(
            $booking->getId(), // Manually defined ID
            [
                'title' => $booking->getTitle(),
                'summary' => $booking->getSummary(),
                'author' => $booking->getAuthor()->getFullName(),
                'content' => $booking->getContent(),

                // Not indexed but needed for display
                'url' => $this->router->generate('blog_post', ['slug' => $booking->getSlug()], UrlGeneratorInterface::ABSOLUTE_PATH),
                'date' => $booking->getPublishedAt()->format('M d, Y'),
            ],
            'article' // Types are deprecated, to be removed in Elastic 7
        );
    }

    public function indexAllDocuments($indexName)
    {
        $allBookings = $this->bookingRepository->findAll();
        $index = $this->client->getIndex($indexName);

        $documents = [];
        foreach ($allBookings as $booking) {
            $documents[] = $this->buildDocument($booking);
        }

        $index->addDocuments($documents);
        $index->refresh();
    }
}
