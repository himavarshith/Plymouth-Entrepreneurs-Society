<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Blowfish' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'posts', 'action' => 'index'),
            'authorize' => array('Controller')
        )
    );

    public function beforeFilter() {
        $this->loadModel('User');
        $this->loadModel('Profile');
        $this->loadModel('Event');
        $this->loadModel('Sponsor');
        $this->loadModel('Category');

        // Used in views to easily check if a user is logged in
        $this->set('authed', $this->Auth->user());
        
        if($this->Auth->user()) {
            // Also make it easy to grab user/profile information in views
            $this->set('user', $this->User->find('first', array(
                'conditions' => array('User.id' => $this->Auth->user('id'))
            )));
        }

        // Latest members
        $latestUsers = $this->Profile->find('all', array(
            'order'     => array('User.created DESC'),
            'conditions' => array('User.activated' => 1),
            'limit'     => 5
        ));
        $this->set('latestUsers', $latestUsers);

        // Latest events
        $latestEvents = $this->Event->find('all', array(
            'order'     => array('Event.date ASC'),
            'limit'     => 5
        ));
        $this->set('latestEvents', $latestEvents);

        $this->set('navElements', $this->Category->find('all'));

        // Sponsors
        $this->set('sponsors', $this->Sponsor->find('all'));
    }

    public function isAuthorized($user) {
        // Check if admin
        if(!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            if($this->Auth->user('admin') != 1) {
                // User is not an admin, deny
                return false;
            }
        }

        return true;
    }

}