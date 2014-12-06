<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('posts', $this->Post->find('all',array(
    'order' => array('Post.sum DESC'),
)
));
	if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash("La question a bien été enregistrée","flash");
				return $this->redirect( array('action' => 'index'));
			}
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash("La question a bien été enregistrée","flash");
				return $this->redirect( array('action' => 'index'));
			}
		}
	}
	
	public function like($id = null) {
	    if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		if(!in_array($id,$this->Session->read('Person.liked'))){
			$this->loadModel('Post');
			$post = $this->Post->Find('first',array('conditions'=>array('Post.id'=>$id)));
			$post['Post']['nbLike']=strval(intval($post['Post']['nbLike'])+1);
			$this->Post->save($post);
		}else{
			$this->Session->setFlash("Vous avez déja donné un avis à la question","flash");
			return $this->redirect( array('action' => 'index'));
		}
		if(!$this->Session->read('Person.liked')){
			$liked=[];
		}
		else{
			$liked=$this->Session->read('Person.liked');
		}
		array_push($liked,$id);
		$this->Session->write('Person.liked', $liked);
		$this->Session->setFlash("La question a bien été likée","flash");
		return $this->redirect( array('action' => 'index'));
	}
	
	public function disLike($id = null) {
	    if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if(!in_array($id,$this->Session->read('Person.liked'))){
			$this->loadModel('Post');
			$post = $this->Post->Find('first',array('conditions'=>array('Post.id'=>$id)));
			$post['Post']['nbDislike']=strval(intval($post['Post']['nbDislike'])+1);
			$this->Post->save($post);
		}else{
			$this->Session->setFlash("Vous avez déja donné un avis à la question","flash");
			return $this->redirect( array('action' => 'index'));
		}
		
		if(!$this->Session->read('Person.liked')){
			$liked=[];
		}
		else{
			$liked=$this->Session->read('Person.liked');
		}
		array_push($liked,$id);
		$this->Session->write('Person.liked', $liked);
		
		$this->Session->setFlash("La question a bien été dislikée","flash");
		return $this->redirect( array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		if(!$this->Session->read('authorized')){
			$this->Session->setFlash("Vous n'avez pas accès à ce contenu","flash");
			return $this->redirect( array('action' => 'password'));
		}
		$this->Post->recursive = 0;
		$this->set('posts', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				return $this->flash(__('The post has been saved.'), array('action' => 'index'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->save($this->request->data)) {
				return $this->flash(__('The post has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		if(!$this->Session->read('authorized')){
			$this->Session->setFlash("Vous n'avez pas accès à ce contenu","flash");
			return $this->redirect( array('action' => 'password'));
		}
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete()) {
			$this->Session->setFlash("La question a bien été supprimée","flash");
			return $this->redirect( array('action' => 'index'));
		} else {
			$this->Session->setFlash("Erreur de suppression","flash");
			return $this->redirect( array('action' => 'index'));
		}
	}
	public function admin_password(){
		if($this->request->data){
			if($this->request->data['password']=="fa"){
				$this->Session->write('authorized', "true");
				return $this->redirect( array('action' => 'index'));
			}
		}
	}
	
	public function admin_logout(){
		$this->Session->destroy();
		$this->Session->setFlash("Vous êtes bien déconnecté","flash");
		return $this->redirect( array('action' => 'password'));
	}
}