<?php
require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'ProjectDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'ImgDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'StickyNoteDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'TodoDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'TodoItemDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'VideoDAO.php';
require_once WWW_ROOT . 'php-image-resize' . DS . 'ImageResize.php';

class ProjectsController extends Controller {

	private $projectDAO;
	private $imgDAO;
	private $stickyNoteDAO;
	private $todoDAO;
	private $todoItemDAO;
	private $videoDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
		$this->imgDAO = new ImgDAO();
		$this->stickyNoteDAO = new StickyNoteDAO();
		$this->todoDAO = new TodoDAO();
		$this->todoItemDAO = new TodoItemDAO();
		$this->videoDAO = new VideoDAO();
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

	public function UpdateFunctie(){
		if(!empty($_POST['id_stickynote'])){
			$data = $_POST;
			$inhoudToevoegen = $this->stickyNoteDAO->insertText($data);
		}
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('data' => $_POST));
	    	die();
		}
	}

	public function whiteboard(){
		$project_id = $_GET['id'];
		$existing = $this->projectDAO->selectById($_GET['id']);

		if($project_id){
			if(!empty($existing)){

				$stickyNotes = $this->stickyNoteDAO->selectByProjectId($project_id);
				$this->set('stickyNotes', $stickyNotes);

				$todos = $this->todoDAO->selectByProjectId($project_id);
				$this->set('todos', $todos);

				$imges = $this->imgDAO->selectByProjectId($project_id);
				$this->set('imges', $imges);

				$videos = $this->videoDAO->selectByProjectId($project_id);
				$this->set('videos', $videos);

				$project = $this->projectDAO->selectById($project_id);
				$this->set('project', $project);

				if(!empty($_FILES)){
					if(!empty($_FILES['image'])){
						$this->_handleAddImage();
					}
					if(!empty($_FILES['video'])){
						$this->_handleAddVideo();
					}
				}
				if(!empty($_POST['extension'])){
					if($_POST['extension']="mp4"){
						$data = $_POST;
						$positieWijzigen = $this->videoDAO->updatePosition($data);
					}
					if($_POST['extension']="jpg"){
						$data = $_POST;
						$positieWijzigen = $this->imgDAO->updatePosition($data);
					}
					if($_POST['extension']="sticky"){
						$data = $_POST;
						$positieWijzigen = $this->stickyNoteDAO->updatePosition($data);
					}
				}

			}else{
				$this->redirect('index.php?page=projects');
			}
		}else{
			$this->redirect('index.php?page=projects');
		}

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('stickyNotes' => $stickyNotes, 'todos' => $todos, 'imges' => $imges, 'videos' => $videos, 'dataPost' => $_POST));
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
			$ProjectVerwijderen = $this->projectDAO->deleteById($_POST['id_project']);
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		     	echo json_encode(array('ok' => "ok"));
		    	die();
			}
		}
	}

	private function _handleAddProject() {
		$confirm = true;
	  	$data = $_POST;

	  	if($data){
		  	$insertedproject = $this->projectDAO->insert($data);
	    	$this->set("data", $data);
	  		$this->set("confirm", $confirm);

	        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true));
		        die();
			}
	  	}
	}

	private function _handleAddImage(){
		$errors = array();
		$size = array();

		if(!empty($_FILES["image"])){
			if(!empty($_FILES["image"]["error"])){ $errors["image"] = "De foto kon niet geüpload worden."; }

			if(empty($errors["image"])){
				$size = getimagesize($_FILES["image"]["tmp_name"]);
				if(empty($size)){ $errors["image"] = "Upload een foto"; }
			}

			if(empty($errors["image"])){
				if($_FILES["image"]["size"] >=2097152){ 
					$errors["image"] = "De bestandsgrootte is te groot.";
				}
			}
		}

		if(empty($errors)) {

			$name = preg_replace("/\\.[^.\\s]{3,4}$/", "", $_FILES["image"]["name"]);
			$extension = 'jpg';

			$insertImage['user_id'] = $_SESSION['user']['id'];
			$insertImage['project_id'] = $_GET['id'];
			$insertImage['file'] = $name;
			$insertImage['extension'] = $extension;

			$imageresize = new Eventviva\ImageResize($_FILES["image"]["tmp_name"]);
			$imageresize->save(WWW_ROOT."uploads".DS.$name.".".$extension);
			$imageresize->resizeToHeight(200);
			$imageresize->save(WWW_ROOT."uploads".DS.$name."_th.".$extension);

			$this->imgDAO->insert($insertImage);

			if(!empty($insertImage)) {
				$_SESSION['info'] = 'De upload was succesvol!';
				$this->redirect('index.php?page=whiteboard&id=' . $_GET['id']);
			}
		}
		$_SESSION['error'] = 'De upload is mislukt.';
		$this->set('errors', $errors);
	}

	private function _handleAddVideo(){
		$errors = array();
		$size = array();

		if(!empty($_FILES["video"])){
			if(!empty($_FILES["video"]["error"])){ $errors["video"] = "De video kon niet geüpload worden."; }

			// if(empty($errors["video"])){
			// 	$size = getimagesize($_FILES["video"]["tmp_name"]);
			// 	if(empty($size)){ $errors["video"] = "Upload een video"; }
			// }
		}

		if(empty($errors)) {
			$name = preg_replace("/\\.[^.\\s]{3,4}$/", "", $_FILES["video"]["name"]);
			$extension = 'mp4';

			$insertVideo['project_id'] = $_GET['id'];
			$insertVideo['user_id'] = $_SESSION['user']['id'];
			$insertVideo['file'] = $name;
			$insertVideo['extension'] = $extension;

			$target_file = WWW_ROOT."uploads".DS.basename($_FILES["video"]["name"]);

			//$insertVideo->save(WWW_ROOT."uploads".DS.$_FILES['file']['name'].".mp4");
			move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);

			$this->videoDAO->insert($insertVideo);

			if(!empty($insertVideo)) {
				$_SESSION['info'] = 'De upload was succesvol!';
				$this->redirect('index.php?page=whiteboard&id=' . $_GET['id']);
			}
		}
		$_SESSION['error'] = 'De upload is mislukt.';
		$this->set('errors', $errors);
	}

	private function _handleAddStickyNote(){

		if(!empty($_POST['text'])){
			$data['project_id'] = $_POST['id'];
			$data['user_id'] = $_SESSION['user']['id'];
			$data['text'] = $_POST['text'];

			$insertedNote = $this->stickyNoteDAO->insert($data);

			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true));
		        die();
			}
		}
	}

	private function _handleAddTodo(){

		if(!empty($_POST['project_id'])){
			$data['project_id'] = $_POST['project_id'];
			$data['user_id'] = $_SESSION['user']['id'];

			$insertedTodo = $this->todoDAO->insert($data);
			$todo_last = $this->todoDAO->selectLast();

			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true, 'todo_last'=>$todo_last));
		        die();
			}
		}
	}
}