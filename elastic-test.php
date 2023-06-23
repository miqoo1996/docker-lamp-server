<?php

require 'vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()
    ->setHosts(['elastic:9200'])
    ->build();

$response = $client->info();

echo $response->asString(), '<br><br>';

// http://127.0.0.1:9200/jobs/job/[:id]

$indexed = $client->index([
    'index' => 'jobs',
    'type' => 'job',
    'body'  => [
        'title' => 'Full Stack React/PHP developer',
        'summary' => 'Required candidate level: Mid level',
        'description' => 'looking for a Full Stack React/PHP Laravel developer to join our team. If you are a hard working person having 2+ years of experience with the mentioned technologies, we will be happy to welcome you to our team. All the interested candidates should send their CV to hr@smart-corner.org, writing \"React/PHP developer\" on the subject line.',
        'responsibilities' => [
            "Implementation of new functionality and support existing code;",
            "Providing solutions to challenging tasks;"
        ],
        'tags' => [
            'a1',
            'a2',
            'a3',
        ],
    ]
]);

$indexed = $client->index([
    'index' => 'jobs',
    'type' => 'job',
    'body'  => [
        'title' => 'PHP Developer',
        'summary' => 'looking for a Mid PHP Developer in Yerevan, Armenia.',
        'description' => 'iGaming company which provides sports betting and gaming platforms for the gambling business.Our team consists of creative experts with extensive experience in the gaming industry. We focus on developing and providing our partners with unique and innovative solutions that include a wide range of high-quality products and services. The key to our success is our team spirit, innovation and constant attention to the requirements of our partners.',
        'responsibilities' => [
            "Implementation of new functionality and support existing code;",
            "Improve your skills / learning new technologies;"
        ],
        'tags' => [
            'a1',
            'b2',
            'a3',
        ],
    ]
]);


// Search data from the created indexes.

$response = $client->search([
    'body' => [
        'query' => [
            'bool' => [
                "should" => [
                    ["match" => ['title' => 'php']],
                    ["match" => ['title' => 'test-title']],
                ],
                "must" => [
                    ["match" => ["description" => 'iGaming']]
                ],
            ],
        ],
    ],
]);

echo '<br><br>', $response->asString(), '<br><br>';