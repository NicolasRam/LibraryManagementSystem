<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 17:31
 */

namespace App\Service\Source\Entity;


class Firebase
{
    private $url              = 'https://lms-library-management-system.firebaseio.com/';
    private $authentification = 'ZHUIPtGkIq0kWig6zsgB1NiOA5vXKYRRyesCiLAz';

    public function __construct() {

    }

    public function send( Book $book = null )
    {
        // Data for PATCH
        // Matching nodes updated
        $data = [
            "url" => $book->getUrl() ?? '',
            "author" => $book->getAuthor() ?? '',
            "image" => $book->getImage() ?? '',
            "price_new" => $book->getPriceNew() ?? '',
            "price_used" => $book->getPriceUsed() ?? '',
            "resume" => $book->getResume() ?? '',
            "title" => $book->getTitle() ?? '',
            "contribs" => [],
            "details" => [],
        ];

        // JSON encoded
        $json = json_encode($data);
        // Initialize cURL
        $curl = curl_init();

//        dd( $this->url . 'books/' . $book->getIsbn() . '.json?auth=' . $this->authentification );

        // Create
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, 32 );
        // Read
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
        // Update
        curl_setopt($curl, CURLOPT_URL, $this->url . 'books/' . $book->getIsbn() . '.json?auth=' . $this->authentification);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

        // Delete
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_DELETE );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
        // Get return value
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        // Make request
        // Close connection
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}