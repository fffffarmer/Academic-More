<?php
use Elasticsearch\ClientBuilder;
require 'C:/elastic/vendor/autoload.php';

class Paper_model extends CI_Model {

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
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'prefix' => [
                        'title.keyword' => $q
                    ]
                ],
                'sort' => [
                    'cites' => [
                        'order' => 'desc'
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res[] = array(
                'id' => $item['_source']['id'],
                'label' => $item['_source']['title']
            );
        }

        echo json_encode($res);  
    }

    public function get_num($title)
    {
        $params = [
            'size' => 10000,
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'match_phrase'=> [
                        "title" => $title
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $total =  $response['hits']['total'];
        return $total;
    }

    public function get_last_ten_entries($title, $start)
    {
    	$params = [
            'size' => 10,
            'from' => $start,
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'match_phrase'=> [
                        "title" => $title
                    ]
                ],
                'sort'=> [
                    'cites'=> [
                        'order'=> 'desc'
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
            $item['_source']['title'] = $item['highlight']['title'];
            $res[] = $item['_source'];
        }
        echo json_encode($res);
    }

    public function get_graph1_data($id)
    {
    	$params = [
            'size' => 10,
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'term' => [
                        'id.kerword' => $id
                    ]
                ],
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res[] = array(
                'id' => $item['_source']['id'],
                'label' => $item['_source']['title']
            );
        }
    }

    public function get_graph2_data($title)
    {
    	$params = [
            'size' => 10,
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'match' => [
                        'title' => $title
                    ]
                ],
                'filter' => [
                    'cites' => [
                        'order' => 'desc'
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res[] = array(
                $res[] = $item['_source']
            );
        }

        echo json_encode($res); 
    }

    public function get_year_data($title)
    {
    	$params = [
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'bool'=> [
                    	'must' => [
                    		['match' => [
                    			'title' => $title
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

    public function get_ind_data($paperid)
    {
         $params = [
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'term'=> [
                        "id.keyword" => $paperid
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

    public function get_tag_recommendation_data($paperid)
    {
        $params = [
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'term'=> [
                        "id.keyword" => $paperid
                    ]
                ]
            ]
        ];


        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $tags = $item['_source']['tags'];
        }

        foreach ($tags as $tag) {
            $params = [
                'index' => 'papers',
                'type' => 'test-type',
                'body' => [
                    'size' => 5,
                    'query'=> [
                        'match'=> [
                            "tags" => $tag
                        ]
                    ],
                    'sort' => [
                        'cites' => [
                            'order' => 'desc'
                        ]
                    ]
                ]
            ];

            $response = $this->client->search($params);
            $data = $response['hits']['hits'];
            foreach ($data as $item) {
                $recommendation[] = $item['_source'];
            }
        }

        echo json_encode($recommendation);
    }

    public function get_author_recommendation_data($paperid)
    {
        $params = [
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'term'=> [
                        "id.keyword" => $paperid
                    ]
                ]
            ]
        ];


        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $firstauthor = $item['_source']['authorinfo'][0];
        }

        $params = [
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'size' => 5,
                'query'=> [
                    'match'=> [
                        "authorinfo.authorid" => $firstauthor['authorid']
                    ]
                ],
                'sort' => [
                    'cites' => [
                        'order' => 'desc'
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $recommendation[] = $item['_source'];
        }

        echo json_encode($recommendation);
    }
}