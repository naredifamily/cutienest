<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class UsersController extends AppController {
public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add'); 
    }
	function index()
	{
		
		
		
	}
		
		 public function login()
    {
		
		
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));      
        }
         
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        } 
		
		}
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
	
 public function add()
    {
       

        if ($this->request->is('post')) {
            if ($this->User->validates()) {
				$this->request->data['User']['status']=0;
								$this->request->data['User']['role']=1;

                $this->User->create();
                if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash('You has been registered as a provider. Please wait for admin approval.', 'default', ['class' => 'success']);
                        return $this->redirect(['action' => 'login']);
          
                    
                }
            }
        }
    }

}
