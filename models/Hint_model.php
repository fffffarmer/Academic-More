<?php
use Elasticsearch\ClientBuilder;
require 'C:/elastic/vendor/autoload.php';

class Hint_model extends CI_Model {

    private $client;   

    public function __construct()
    {
        parent::__construct();
        $this->client = ClientBuilder::create()->build();
    }

    public function get_result($q)
    {
        $query = $this->db->query(
            "SELECT authors.authorid, authors.authorname
            FROM
            authors
            INNER JOIN
            (SELECT authorid, COUNT(*) AS num
            FROM paper_author_affiliation
            GROUP BY authorid) AS table1
            ON authors.authorid = table1.authorid
            WHERE authors.authorname LIKE '$q%'
            ORDER BY table1.num DESC
            LIMIT 0,10");

        foreach ($query->result_array() as $row)
        {
            $result[] = array(
                'id' => $row['authorid'],
                'label' => $row['authorname']
            );
        }

        echo json_encode($result);  
    }

}