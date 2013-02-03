<?php
class News extends MX_Controller {
	private $mname;             // module name
	public $tpl;                // main template

	function __construct() {
		$this->tpl = 'site.php'; 					// set main template
		$this->mname = strtolower(get_class());                         // set module name
		$this->load->model($this->mname.'/'.$this->mname.'_model');	// load the model
		$this->lang->load('news', 'russian');                           // load lang file
	}

        // Class main-function -------------------------------> 
        //
	public function index() {
		// If function segment is not empty - perform function
		$func = $this->uri->segment(3);
		if($func != '' && method_exists($this->mname, $func) == true) {
			$this->$func($this->uri->segment(4)); 
			return false;
		}
		
		$model = $this->mname.'_model';                                 // var model
		
		$news = $this->$model->get_top_news();
		$this->tp->D['news_top'] = $news;
		$news = $this->$model->get_last_news();
		$this->tp->D['news_last'] = $news;
		
		$this->tp->parse('CONTENT', $this->mname.'/'.$this->mname.'.php');
	}
	
        // User vote for the news -------------------------------> 
        //
        public function newsrate() {
                $id = $this->input->post('id'); 
                $rate = $this->input->post('rate');
                $user_id = $this->input->cookie('user_id');
                if(empty($id)) {
                    echo 0;
                } else {
                    $model = $this->mname.'_model';                             // var model
                    $res = $this->$model->setrate($id, $user_id, $rate);
                    echo $res;
                }
                die();
	}
        
        // Show one news -------------------------------> 
        //
	public function single($id) {
                if(!is_numeric($id)) {
                    show_404('page');
                    return false;
                }

                $model = $this->mname.'_model';                                 //var model
                
                $this->$model->increment_news_value($id, 'news_view');          // news_view + 1
                $single = $this->$model->get_single($id);
		$this->tp->D['single'] = $single;
                

                $this->tp->parse('CONTENT', $this->mname.'/single.php');
                //echo '<pre>';print_r($this->db->queries);echo '</pre>';
	}
}