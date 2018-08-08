<?php
/**
 * Created by PhpStorm.
 * User: moulaye
 * Date: 07/08/18
 * Time: 17:31
 */

namespace App\Service\Source\Entity;


use Behat\Transliterator\Transliterator;

class Firebase
{
    private $url;
    private $authentication;

    public function __construct() {
        $this->url = getenv('FIREBASE_DATABASE_URL');
        $this->authentication = getenv('FIREBASE_AUTHENTICATION_KEY');
    }

    public function saveCategory(Category $category = null, $path = '/category/' )
    {
        // Data for PATCH
        // Matching nodes updated
        $data = [
            "name" => $category->getName() ?? '',
        ];

        // JSON encoded
        $json = json_encode($data);
        // Initialize cURL
        $curl = curl_init();

        $categorySlug = Transliterator::transliterate($category->getName());

        $value = $this->url. $path . $categorySlug . '.json?auth=' . $this->authentication;

        // Create
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, 32 );
        // Read
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
        // Update
        curl_setopt($curl, CURLOPT_URL, $value);
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

    public function saveSubCategory(SubCategory $subCategory = null, $path = '/sub_category/' )
    {
        // Data for PATCH
        // Matching nodes updated
        $data = [
            "name" => $subCategory->getName() ?? '',
            "link" => $subCategory->getLink() ?? '',
        ];

        // JSON encoded
        $json = json_encode($data);
        // Initialize cURL
        $curl = curl_init();

        $subCategorySlug = Transliterator::transliterate($subCategory->getName());

        $value = $this->url. $path . $subCategorySlug . '.json?auth=' . $this->authentication;

        // Create
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, 32 );
        // Read
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
        // Update
        curl_setopt($curl, CURLOPT_URL, $value);
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

    public function saveBook(Book $book = null, $path = '/book/' )
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
            "subCategory" => Transliterator::transliterate($book->getSubCategory()->getName()),
            "contribs" => [],
            "details" => [],
        ];

        // JSON encoded
        $json = json_encode($data);
        // Initialize cURL
        $curl = curl_init();

        $value = $this->url . $path . $book->getIsbn() . '.json?auth=' . $this->authentication;

        // Create
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PUT );
        // curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PUT" );
        // curl_setopt( $curl, CURLOPT_POSTFIELDS, 32 );
        // Read
        // curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_GET );
        // Update
        curl_setopt($curl, CURLOPT_URL, $value);
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