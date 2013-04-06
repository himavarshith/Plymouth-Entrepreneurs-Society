<?php
class EventsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function  admin_index() {
        $this->set('events', $this->Event->find('all'));
        $this->layout = 'admin';
    }

    public function  index() {
        $this->set('events', $this->Event->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid event'));
        }

        $event = $this->Event->findById($id);
        if (!$event) {
            // TODO: route to 404
            throw new NotFoundException(__('Invalid event'));
        }
        $this->set('event', $event);
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $this->Event->create();
            if ($this->Event->save($this->request->data)) {
                $this->Session->setFlash('Your event has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your event.');
            }
        }
        $this->layout = 'admin';
    }

//    public function admin_edit($id = null) {
//        if (!$id) {
//            throw new NotFoundException(__('Invalid event'));
//        }
//
//        $event = $this->Event->findById($id);
//        $this->set('event', $event);
//        if (!$event) {
//            throw new NotFoundException(__('Invalid event'));
//        }
//
//        if ($this->request->is('post') || $this->request->is('put')) {
//            $this->Event->id = $id;
//            if ($this->Event->save($this->request->data)) {
//                $this->Session->setFlash('Your event has been updated.');
//                $this->redirect(array('action' => 'index'));
//            } else {
//                $this->Session->setFlash('Unable to update your event.');
//            }
//        }
//
//        if (!$this->request->data) {
//            $this->request->data = $event;
//        }
//        $this->layout = 'admin';
//    }

    public function admin_edit($id = null) {
        if($this->request->is('post') || $this->request->is('put')) {
            if($this->Event->save($this->request->data)) {
                $this->Session->setFlash('Your event has been updated.', 'default', array('class' => 'success'));
                $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash('There was a problem saving your event. Please try again.', 'default', array('class' => 'error'));
        }

        $event = $this->Event->findById($id);

        $this->set('event', $event);

        // Auto populate form fields
        if(!$this->request->data) {
            $this->request->data = $event;
        }
        $this->layout = 'admin';
    }

    public function admin_delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Event->delete($id)) {
            $this->Session->setFlash('The event with id: ' . $id . ' has been deleted.');
            $this->redirect(array('action' => 'index'));
        }
        $this->layout = 'admin';
    }
}