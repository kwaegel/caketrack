<?php
class FundsController extends AppController {

	var $name = 'Funds';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Fund->recursive = 0;
		$this->set('funds', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Fund', true), array('action'=>'index'));
		}
		$this->set('fund', $this->Fund->read(null, $id));
	}

	/*
	function add() {
		if (!empty($this->data)) {
			$this->Fund->create();
			if ($this->Fund->save($this->data)) {
				$this->flash(__('Fund saved.', true), array('action'=>'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Fund', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fund->save($this->data)) {
				$this->flash(__('The Fund has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fund->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Fund', true), array('action'=>'index'));
		}
		if ($this->Fund->del($id)) {
			$this->flash(__('Fund deleted', true), array('action'=>'index'));
		}
	}
	*/


	function admin_index() {
		$this->Fund->recursive = 0;
		$this->set('funds', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Fund', true), array('action'=>'index'));
		}
		$this->set('fund', $this->Fund->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Fund->create();
			if ($this->Fund->save($this->data)) {
				$this->flash(__('Fund saved.', true), array('action'=>'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Fund', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fund->save($this->data)) {
				$this->flash(__('The Fund has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fund->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Fund', true), array('action'=>'index'));
		}
		if ($this->Fund->del($id)) {
			$this->flash(__('Fund deleted', true), array('action'=>'index'));
		}
	}

}
?>