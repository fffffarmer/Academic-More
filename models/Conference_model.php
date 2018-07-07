<?php
use Elasticsearch\ClientBuilder;
require 'C:/elastic/vendor/autoload.php';

class Conference_model extends CI_Model {

    private $client;   

    public function __construct()
    {
        parent::__construct();
        $this->client = ClientBuilder::create()->build();
    }

    public function get_hint($q)
    {
        $params = [
            'size' => 10,
            'index' => 'venues',
            'type' => 'test-type',
            'body' => [ 
                'query' => [
                    'prefix' => [
                        'name' => $q
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res[] = array(
                'id' => $item['_source']['id'],
                'label' => $item['_source']['name']
            );
        }

        echo json_encode($res);  
    }

    public function get_result($conference)
    {
        $params = [
            'size' => 10,
            'index' => 'venues',
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'term'=> [
                        "name.keyword" => $conference
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res = $item['_source'];
        }

        return $res;
    }

}