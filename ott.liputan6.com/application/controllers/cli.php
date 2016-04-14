<?php
class Cli extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('format');
  }

  public function getTable(){
    $this->load->model('grab_model');
    $this->grab_model->getTable();
  }

  public function getEvent(){
    $this->load->model('match_model');

    $match_id = $this->input->get_post('match_id');
    $data['liveReport'] = $this->match_model->getEvent(array(
      "match_id" => $match_id
    ));

    $this->load->view('pertandingan/event',$data);
  }
}
