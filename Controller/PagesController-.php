<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
 var $name = 'Pages';
 var $helpers = array('Html', 'Form');

 function index() {
  $this->Page->recursive = 0;
  $this->set('pages', $this->paginate());
 }

 function add() {
  if (!empty($this->data)) {
   $this->Page->create();
   if ($this->Page->save($this->data)) {
    // save a physical copy of the file
    $this->_saveFile($this->data);
    
    $this->Session->setFlash(__('The Page has been saved', true));
    $this->redirect(array('action'=>'index'));
   } else {
    $this->Session->setFlash(__('The Page could not be saved. Please, try again.', true));
   }
  }
  $users = $this->Page->User->find('list');
  $this->set(compact('users'));
 }

 function edit($id = null) {
  if (!$id && empty($this->data)) {
   $this->Session->setFlash(__('Invalid Page', true));
   $this->redirect(array('action'=>'index'));
  }
  if (!empty($this->data)) {
   if ($this->Page->save($this->data)) {
    // save a physical copy of the file
    $this->_saveFile($this->data);
    
    $this->Session->setFlash(__('The Page has been saved', true));
    $this->redirect(array('action'=>'index'));
   } else {
    $this->Session->setFlash(__('The Page could not be saved. Please, try again.', true));
   }
  }
  if (empty($this->data)) {
   $this->data = $this->Page->read(null, $id);
  }
  $users = $this->Page->User->find('list');
  $this->set(compact('users'));
 }

 function delete($id = null) {
  if (!$id) {
   $this->Session->setFlash(__('Invalid id for Page', true));
   $this->redirect(array('action'=>'index'));
  }
  
  // get our file name
  $this->Page->id = $id;
  $page = $this->Page->read();
  
  if ($this->Page->del($id)) {
   // delete our file
   $this->_deleteFile($page);
   
   $this->Session->setFlash(__('Page deleted', true));
   $this->redirect(array('action'=>'index'));
  }
 }
 
 function _saveFile($data) {
  App::import('Sanitize');
  // clean the file name and replace spaces with dashes
  // and save the file locally
  file_put_contents($this->_buildPath($data), $data['Page']['body']);
 }
 
 function _deleteFile($data) {
  App::import('Sanitize');
  // clean the file name and replace spaces with dashes
  // and delete the file locally
  if (file_exists($filepath = $this->_buildPath($data))) {
   unlink($filepath);
  }
 }
 
 function _buildPath($data) {
  return APP . 'views\\pages\\' . Sanitize::paranoid(str_replace(' ', '-', $data['Page']['title']), array('-')) . '.ctp';
 }
 
 /**
  * Displays a view
  *
  * @param mixed What page to display
  * @access public
  */
 function display() {
	 
  $path = func_get_args();

  $count = count($path);
  if (!$count) {
   $this->redirect('/');
  }
  $page = $subpage = $title = null;

  if (!empty($path[0])) {
   $page = $path[0];
  }
  if (!empty($path[1])) {
   $subpage = $path[1];
  }
  if (!empty($path[$count - 1])) {
   $title = Inflector::humanize($path[$count - 1]);
  }
  $this->set(compact('page', 'subpage', 'title','body'));
  $this->render(join('/', $path));
 }

}