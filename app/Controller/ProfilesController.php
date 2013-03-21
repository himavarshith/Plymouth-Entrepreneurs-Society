<?php

class ProfilesController extends AppController {

    public $helpers = array('Html', 'Form');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view');
    }


    public function view($id = null) {
        // Find profile using $id
        $profile = $this->Profile->find('first', array(
            'conditions' => array('Profile.id' => $id)
        ));

        if(!$profile) {
            // Profile doesn't exist, return 404
            // TODO: route to 404 page // redirectUrl(array('controller' => 'pages', 'action' => '404'));
            throw new NotFoundException();
        }

        $this->set('profile', $profile);
    }

    public function edit() {
        if($this->request->is('post') || $this->request->is('put')) {
            if($this->Profile->save($this->request->data)) {
                $this->Session->setFlash('Your profile has been updated.');
                $this->redirect(array('action' => 'edit'));
            }
            
            $this->Session->setFlash('There was a problem saving your profile. Please try again.');
        }

        $profile = $this->Profile->find('first', array(
            'conditions' => array('User.id' => $this->Auth->user('id'))
        ));

        // Get the skills corresponding to this profile
        $skills = array();
        foreach($profile['Skill'] as $skill) {
            $skills[] = $skill['name'];
        }
        $this->set('skills', $skills);

        // Auto populate form fields
        if(!$this->request->data) {
            $this->request->data = $profile;
        }
    }

}
