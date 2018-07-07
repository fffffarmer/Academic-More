<?php
class Home extends CI_Controller {

    public function index()
    {
        $this->load->view('homeview');
    }

    /* Home Page */

    public function hint_author()   
    {
    	$q = strtolower($_GET["term"]);
    	$this->load->model('author_model');
    	$this->author_model->get_hint($q);
    }

    public function hint_paper()    
    {
    	$q = strtolower($_GET["term"]);
    	$this->load->model('paper_model');
    	$this->paper_model->get_hint($q);
    }

    public function hint_conference()   
    {
    	$q = strtolower($_GET["term"]);
    	$this->load->model('conference_model');
    	$this->conference_model->get_hint($q);
    }

    public function about()
    {
        $this->load->view('aboutview');
    }

    /* Visualization */

    public function choose_graph()
    {
        $this->load->view('choose_graph_view');
    }

    public function top_10_authors()
    {
        $this->load->view('top_10_authors_views');
    }

    public function map()
    {
        $this->load->view('mapview');
    }

    public function conference_graph()
    {
        $this->load->view('conference_graph_view');
    }

    /* Result Page of Conference */

    public function conference()
    {
		$conference = $_GET["conference"];
		$list = array('ECCV', 'NIPS', 'SIGKDD','WWW','SIGIR','CVPR','ICCV','NAACL',
            'ICML','AAAI','ACL','EMNLP','IJCAI');
		if (!in_array($conference, $list))
		{
			$this->load->view('errors/error_404');
		}
		else
		{
			$this->load->model('conference_model');
	    	$data = $this->conference_model->get_result($conference);
	    	$this->load->view('conferenceview', $data);
		}
    }

    /* Result Page of Paper */

    public function paper() 
    {
		$papertitle = $_GET["papertitle"];
    	$this->load->model('paper_model');
    	$num = $this->paper_model->get_num($papertitle);
    	$data['papertitle'] = $papertitle;
    	$data['num'] = $num;
    	$this->load->view('paperview', $data);
    }

    public function paper_data()    
    {
        $papertitle = $_GET["papertitle"];
        $page = $_GET["page"];
        $start = ($page - 1) * 10;
        $this->load->model('paper_model');
        $this->paper_model->get_last_ten_entries($papertitle, $start);
    }

    public function paper_graph()   
    {
        $papertitle = $_GET["papertitle"];
        $data['papertitle'] = $papertitle;
        $this->load->view('paper_year_graph_view', $data);
    }

    public function paper_graph_data()  
    {
        $papertitle = $_GET["papertitle"];
        $this->load->model('paper_model');
        $this->paper_model->get_year_data($papertitle);
    }

    /* Result Page of Author */

    public function author()   
    {
        $scholarname = $_GET["scholarname"];
        $this->load->model('author_model');
        $num = $this->author_model->get_num($scholarname);
        $data['scholarname'] = $scholarname;
        $data['num'] = $num;
        $this->load->view('authorview', $data);
    }

    public function author_data() 
    {
        $name = $_GET["scholarname"];
        $page = $_GET["page"];
        $start = ($page - 1) * 10;
        $this->load->model('author_model');
        $this->author_model->get_last_ten_entries($name, $start);
    }

    /* Paper Page */

    public function paper_ind()
    {
    	$paperid = $_GET["id"];
    	$this->load->model('paper_model');
    	$data = $this->paper_model->get_ind_data($paperid);
   		$this->load->view('paper_ind_view', $data);
    }

    public function paper_bubble_chart()
    {
    	$paperid = $_GET["id"];
    	$this->load->model('paper_model');
    	$paperdata = $this->paper_model->get_ind_data($paperid);
    	$authors = $paperdata['authorinfo'];
    	$this->load->model('author_model');
    	foreach ($authors as $author) {
    		$data['authorinfo'][$author['authorsequence']] = $this->author_model->get_ind_data($author['authorid']);
    	};
    	$this->load->view('bubble_chart_view', $data);
    }

    public function paper_tag_recommendation_data()
    {
    	$paperid = $_GET["id"];
    	$this->load->model('paper_model');
		$this->paper_model->get_tag_recommendation_data($paperid);
    }

    public function paper_author_recommendation_data()
    {
    	$paperid = $_GET["id"];
    	$this->load->model('paper_model');
		$this->paper_model->get_author_recommendation_data($paperid);
    }

    public function year_data()
    {
    	$papertitle = $_GET["papertitle"];
    	$page = $_GET["page"];
    	$start = ($page - 1) * 10;
    	$this->load->model('paper_model');
		$this->paper_model->get_last_ten_entries($papertitle, $start);
    }

    public function force_graph()
    {
    	$authorid = $_GET["id"];
    	$data['authorid'] = $authorid;
    	$this->load->view('force_graph_view', $data);
    }

    /* Paper Page */

    public function author_ind()
    {
    	$authorid = $_GET["id"];
    	$this->load->model('author_model');
    	$data = $this->author_model->get_ind_data($authorid);
   		$this->load->view('author_ind_view', $data);
    }

    public function author_paper_data()
    {
    	$authorid = $_GET["id"];
    	$this->load->model('author_model');
		$this->author_model->get_paper_data($authorid);
    }

    public function author_student_tree()
    {
    	$authorid = $_GET["id"];
    	$data['authorid'] = $authorid;
    	$this->load->view('author_student_tree_view', $data);
    }

    public function author_teacher_tree()
    {
    	$authorid = $_GET["id"];
    	$data['authorid'] = $authorid;
    	$this->load->view('author_teacher_tree_view', $data);
    }

    public function author_student_tree_data()
    {
    	$authorid = $_GET["id"];
		$this->load->model('author_model');
		$this->author_model->get_student_tree_data($authorid);
    }

    public function author_teacher_tree_data()
    {
    	$authorid = $_GET["id"];
		$this->load->model('author_model');
		$this->author_model->get_teacher_tree_data($authorid);
    }

    public function author_graph_data()
    {
    	$authorid = $_GET['authorid'];
    	$this->load->model('author_model');
    	$this->author_model->get_graph_data($authorid);
    }

    /* Tag Page */

    public function tag()
    {
        $tag = $_GET['tag'];
        $data['tag'] = $tag;
        $this->load->view('tagview', $data);
    }

    public function tag_paper_data()
    {
        $tag = $_GET['tag'];
        $this->load->model('tag_model');
        $this->tag_model->get_result($tag);
    }

    public function tag_graph()
    {
        $tag = $_GET["tag"];
        $data['tag'] = $tag;
        $this->load->view('tag_graph_view', $data);
    }

    public function tag_graph_data()
    {
        $tag = $_GET['tag'];
        $this->load->model('tag_model');
        $this->tag_model->get_year_data($tag);
    }
}