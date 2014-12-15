<?php
require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'ProjectDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'FunctiesDAO.php';

class ProjectsController extends Controller {

	private $projectDAO;
	private $functieDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
		$this->functieDAO = new FunctiesDAO();
	}

	public function index() {
	  	$projects = $this->projectDAO->selectAll();

	    // $id = "25";
	    // $usersOnProject = $this->projectDAO->selectAllUsers($id);

	    if(!empty($_POST['name'])){
			$data = $_POST;
			$TitelToevoegen = $this->projectDAO->insertTitle($data);
		}

		if(!empty($_POST['description'])){
			$data = $_POST;
			$TitelToevoegen = $this->projectDAO->insertDescription($data);
		}

	    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('projects' => $projects));
	    	die();
		}
	}

	public function whiteboard(){
		$project_id = $_GET['id'];
		$existing = $this->projectDAO->selectById($_GET['id']);

		if($project_id){
			if(!empty($existing)){
				//doorsturen naar js (this set moet er niet meer bij)
				$stickyNotes = $this->functieDAO->selectByProjectId_stickyNote($project_id);
				$todos = $this->functieDAO->selectByProjectId_todo($project_id);

				//doorsturen naar html (this set moet er nog bij)
				$project = $this->projectDAO->selectById($project_id);
				$this->set('project', $project);
			}else{
				$this->redirect('index.php?page=projects');
			}
		}else{
			$this->redirect('index.php?page=projects');
		}

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('stickyNotes' => $stickyNotes, 'todos' => $todos));
	    	die();
		}
	}

	public function addNote(){
		$this->_handleAddStickyNote();
	}

	public function addTodo(){
		$this->_handleAddTodo();
	}

	public function addProject(){
		$this->_handleAddProject();
	}

	public function deleteProject(){
		print_r($_POST);
		if($_POST['action'] = 'delete'){
			$ProjectId_verwijderd = $this->projectDAO->selectById($_POST['id_project']);
			$ProjectVerwijderen = $this->projectDAO->deleteById($_POST['id_project']);
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		     	echo json_encode(array('Verwijderde_project' => $ProjectId_verwijderd));
		    	die();
			}
		}
	}

	private function _handleAddProject() {
		$confirm = true;
	  	$data = $_POST;

	  	if($data){
		  	$insertedproject = $this->projectDAO->insert($data);
		  	$projects_last = $this->projectDAO->selectLast();

	    	$this->set('projects_last', $projects_last);
	    	$this->set("data", $data);
	  		$this->set("confirm", $confirm);

	        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true, 'projects_last'=>$projects_last));
		        die();
			}
	  	}
	}

	private function _handleAddStickyNote(){

		if(!empty($_POST)){
			$data['project_id'] = $_POST['id'];
			$data['user_id'] = $_SESSION['user']['id'];
			$data['xPos'] = '0';
			$data['yPos'] = '0';
			$data['text'] = $_POST['text'];

			$insertedNote = $this->functieDAO->insert_stickyNote($data);
			$stickyNote_last = $this->functieDAO->selectLast_stickyNote();

			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true, 'stickyNote_last'=>$stickyNote_last));
		        die();
			}
		}
	}

	private function _handleAddTodo(){

		if(!empty($_POST)){
			$data['project_id'] = $_POST['project_id'];
			$data['user_id'] = $_SESSION['user']['id'];

			$insertedTodo = $this->functieDAO->insert_todo($data);
			$todo_last = $this->functieDAO->selectLast_todo();

			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true, 'todo_last'=>$todo_last));
		        die();
			}
		}
	}
}