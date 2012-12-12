<?php
App::uses('AppController', 'Controller');
class BoardsController extends AppController {
	public $name = 'Boards';
	public $uses = array();
	public $helpers = array('Form', 'Html', 'Session');
	public function index() {
        $this->layout = 'default';
        $this->title = 'All Boards';
        $this->set('boards', $this->Board->find('all'));
    }
    public function create() {
    	if(!empty($this->data)){
    		if ($this->Board->validates()) {
    			$this->Board->create();
				$this->Board->save($this->data);
				$id = $this->Board->getLastInsertId();
				$this->redirect('/boards/view/'.$id);
				exit;
			} else {
			    $errors = $this->Board->validationErrors;
			    report($errors);
			}
		}
	}
	public function view($id){
		$this->Board->id = $id;
		$board = $this->Board->read();
		$this->title = $board['Board']['title'];
		$this->set('board',$board);
	}
}