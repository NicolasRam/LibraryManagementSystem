<?php

namespace App\Elasticsearch;

use App\Entity\Member;
use Symfony\Component\Yaml\Yaml;

class IndexBuilder
{
    private $client;

    public function __construct(Member $client)
    {
        $this->client = $client;
    }

    public function create()
    {
        // We name our index "blog"
        $index = $this->client->getBookings();

        $settings = Yaml::parse(
            file_get_contents(
                __DIR__.'/../../config/elasticsearch.yaml'
            )
        );

        // We build our index settings and mapping
        $index->create($settings, true);

        return $index;
    }
}
