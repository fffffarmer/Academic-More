<?php
use Elasticsearch\ClientBuilder;
require 'C:/elastic/vendor/autoload.php';

class Tag_model extends CI_Model {

    private $client;   

    public function __construct()
    {
        parent::__construct();
        $this->client = ClientBuilder::create()->build();
    }

    public function get_result($tag)
    {
        $params = [
            'size' => 10,
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'term' => [
                        'tags.keyword' => $tag
                    ]
                ],
                'sort' => [
                    'cites' => [
                        'order' => 'desc'
                    ]
                ],
                'highlight' => [
                    'pre_tags' => ["<span class='my_font'>"],
                    'post_tags' => ["</span>"],
                    'fields' => [
                        'title' => new \stdClass()
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res[] = $item['_source'];
        }

        echo json_encode($res);  
    }

    public function get_year_data($tag)
    {
        $params = [
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'bool'=> [
                        'must' => [
                            ['match_phrase' => [
                                'tags' => $tag
                            ]],
                            ['range' => [
                                'publishyear' => [
                                    'gte' => 2006,
                                    'lte' => 2015
                                ]
                            ]]
                        ]            
                    ]
                ],
                'aggs'=> [
                    'years' => [
                        'terms' => [
                            'field' => 'publishyear.keyword'
                        ]
                    ]
                ]
            ]
        ];


        $response = $this->client->search($params);
        $data = $response['aggregations']['years']['buckets'];
        foreach ($data as $year) 
        {
            $yeardata[] = $year['doc_count'];
        }
        echo json_encode($yeardata);
    }

}