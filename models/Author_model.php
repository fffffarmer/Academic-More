<?php
use Elasticsearch\ClientBuilder;
require 'C:/elastic/vendor/autoload.php';

class Author_model extends CI_Model {

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
            'index' => 'my-index',  // The index name of author document.
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'prefix' => [
                        'name.keyword' => $q
                    ]
                ],
                'sort' => [
                    'num_paper' => [
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
                'label' => $item['_source']['name']
            );
        }

        echo json_encode($res);  
    }

    public function get_num($name)
    {
        $params = [
            'size' => 10000,
            'index' => 'my-index',
            'type' => 'test-type',
            'body' => [
                'query' => [
                    'match_phrase'=> [
                        "name" => $name
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $total =  $response['hits']['total'];
        return $total;
    }

    public function get_last_ten_entries($name, $start)
    {
        $params = [
            'size' => 10,
            'from' => $start,
            'index' => 'my-index',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'match_phrase'=> [
                        "name" => $name
                    ]
                ],
                'sort'=> [
                    'num_paper'=> [
                        'order'=> 'desc'
                    ]
                ],
                'highlight' => [
                    'pre_tags' => ["<span class='my_font'>"],
                    'post_tags' => ["</span>"],
                    'fields' => [
                        'name' => new \stdClass()
                    ]
                ]
            ]
        ];


        $response = $this->client->search($params);
        $total =  $response['hits']['total'];
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $item['_source']['name'] = $item['highlight']['name'];
            $res[] = $item['_source'];
        }

        echo json_encode($res);
    }

    public function get_graph_data($authorid)
    {
        $params = [
            'index' => 'my-index',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'term'=> [
                        "id.keyword" => $authorid
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res = $item['_source'];
        }

        $students = $res['student'];
        $teachers = $res['teacher'];
        $coauthors = $res['coauthor'];
        $nodes[] = array(
            'id' => $res['id'],
            'name' => $res['name'],
            'group' => 1
        );

        foreach ($students as $student) {
            $params2 = [
                'index' => 'my-index',
                'type' => 'test-type',
                'body' => [
                    'query'=> [
                        'term'=> [
                            "id.keyword" => $student
                        ]
                    ]
                ]
            ];

            $response2 = $this->client->search($params2);
            $data2 = $response2['hits']['hits'];
            foreach ($data2 as $item2) {
                $res2 = $item2['_source'];
            }

            $nodes[] = array(
                'id' => $res2['id'],
                'name' => $res2['name'],
                'group' => 2
            );

            $links[] = array(
                'source' => $res['id'],
                'target' => $res2['id'],
                'value' => 2
            );
        }

        foreach ($teachers as $teacher) {
            $params3 = [
                'index' => 'my-index',
                'type' => 'test-type',
                'body' => [
                    'query'=> [
                        'term'=> [
                            "id.keyword" => $teacher
                        ]
                    ]
                ]
            ];

            $response3 = $this->client->search($params3);
            $data3 = $response3['hits']['hits'];
            foreach ($data3 as $item3) {
                $res3 = $item3['_source'];
            }

            $nodes[] = array(
                'id' => $res3['id'],
                'name' => $res3['name'],
                'group' => 3
            );

            $links[] = array(
                'source' => $res['id'],
                'target' => $res3['id'],
                'value' => 2
            );
        }

        foreach ($coauthors as $coauthor) {
            $params4 = [
                'index' => 'my-index',
                'type' => 'test-type',
                'body' => [
                    'query'=> [
                        'term'=> [
                            "id.keyword" => $coauthor
                        ]
                    ]
                ]
            ];

            $response4 = $this->client->search($params4);
            $data4 = $response4['hits']['hits'];
            foreach ($data4 as $item4) {
                $res4 = $item4['_source'];
            }

            $nodes[] = array(
                'id' => $res4['id'],
                'name' => $res4['name'],
                'group' => 4
            );

            $links[] = array(
                'source' => $res['id'],
                'target' => $res4['id'],
                'value' => 2
            );
        }

        $len = count($nodes);
        for ($i = 1; $i < $len; $i++){
            $params5 = [
                'index' => 'my-index',
                'type' => 'test-type',
                'body' => [
                    'query'=> [
                        'term'=> [
                            "id.keyword" => $nodes[$i]['id']
                        ]
                    ]
                ]
            ];

            $response5 = $this->client->search($params5);
            $data5 = $response5['hits']['hits'];
            foreach ($data5 as $item5) {
                $res5 = $item5['_source'];
            }

            for ($j = $i + 1; $j < $len; $j++){
                if (in_array($nodes[$j]['id'], $res5['student']) || in_array($nodes[$j]['id'], $res5['teacher']) ||
                 in_array($nodes[$j]['id'], $res5['coauthor']))
                {
                    $links[] = array(
                        'source' => $nodes[$i]['id'],
                        'target' => $nodes[$j]['id'],
                        'value' => 2
                    );
                }
            }
        }

        $result = array('nodes' => $nodes, 'links' => $links);

        echo json_encode($result);
    }

    public function get_ind_data($authorid)
    {
        $params = [
            'index' => 'my-index',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'term'=> [
                        "id.keyword" => $authorid
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

    public function get_paper_data($authorid)
    {
        $params = [
            'index' => 'papers',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'match'=> [
                        "authorinfo.authorid" => $authorid
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
            $res[] = $item['_source'];
        }

        echo json_encode($res);
    }

    public function get_student_tree_data($authorid)
    {
        $params = [
            'index' => 'my-index',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'term'=> [
                        "id.keyword" => $authorid
                    ]
                ]
            ]
        ];


        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res = $item['_source'];
        }

        $students = $res['student'];
        $authorname = $res['name'];

        foreach ($students as $student) {
            $params2 = [
                'index' => 'my-index',
                'type' => 'test-type',
                'body' => [
                    'query'=> [
                        'term'=> [
                            "id.keyword" => $student
                        ]
                    ]
                ]
            ];

            $response2 = $this->client->search($params2);
            $data2 = $response2['hits']['hits'];
            foreach ($data2 as $item2) {
                $res2 = $item2['_source'];
            }

            $result2[] = array('name' => $res2['name']);
        }

        $result = array('name' => $authorname,
                'children' => $result2);

        echo json_encode($result);
    }

    public function get_teacher_tree_data($authorid)
    {
        $params = [
            'index' => 'my-index',
            'type' => 'test-type',
            'body' => [
                'query'=> [
                    'term'=> [
                        "id.keyword" => $authorid
                    ]
                ]
            ]
        ];


        $response = $this->client->search($params);
        $data = $response['hits']['hits'];
        foreach ($data as $item) {
            $res = $item['_source'];
        }

        $teachers = $res['teacher'];
        $authorname = $res['name'];

        foreach ($teachers as $teacher) {
            $params2 = [
                'index' => 'my-index',
                'type' => 'test-type',
                'body' => [
                    'query'=> [
                        'term'=> [
                            "id.keyword" => $teacher
                        ]
                    ]
                ]
            ];

            $response2 = $this->client->search($params2);
            $data2 = $response2['hits']['hits'];
            foreach ($data2 as $item2) {
                $res2 = $item2['_source'];
            }

            $result2[] = array('name' => $res2['name']);
        }

        $result = array('name' => $authorname,
                'children' => $result2);

        echo json_encode($result);
    }
}