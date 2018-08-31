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



/**

 * This controller does not use a model

 *

 * @var array

 */

	public $uses = array();



/**

 * Displays a view

 *

 * @return CakeResponse|null

 * @throws ForbiddenException When a directory traversal attempt.

 * @throws NotFoundException When the view file could not be found

 *   or MissingViewException in debug mode.

 */
	public function display() {

		$path = func_get_args();
 		$body = $this->Page->find('first',['field'=>'body','conditions' => ['Page.slug' =>reset($path)]]);
		if(isset($body['Page']['title']))
		{
			$title=$body['Page']['title'];
		}
		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;
		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		if(strcmp($page,'ipnpaypal')==0)
		{
			$this->loadModel('Invoice');
			//$user = $this->Invoice->findById($_POST['custom']);
			$this->Invoice->query("UPDATE `invoices` SET  status='1' WHERE id=".$_POST['custom']);
			die;
		}
		
		if(strcmp($page,'feedback')==0)
		{
			//$adminEmail=$this->getAdminOption('admin_email');
		   $adminEmail='srishti.thai@gmail.com';
			
			if ($this->request->is('post') || $this->request->is('put')) {
				
					
					
						$subject = 'Feedback';
							$message = 'Dear Admin, <br><br> This Customer request for Feedback.<br><br>';
						  $message.='Name: '.$this->request->data['username'].'<br>'.'Email: '.$this->request->data['useremail']."<br>".'Phone: '.$this->request->data['userphone']."<br>".'Message: '.$this->request->data['usermessage']."<Br><br>";
							$message .= 'Thanks<br>Cutienest';
							if ($this->sendGeneralEmail($adminEmail, $subject, $message)){
								$this->Session->setFlash('Feedback send successfully.', 'default', ['class' => 'success']);
							} else {
								$this->Session->setFlash('Feedback not send.Please try later!', 'default', ['class' => 'error']);
							}
							return $this->redirect(array('controller'=>'users','action'=>'login'));
					
					
			}
			
		}
		
		if(strcmp($page,'searcharea')==0)
		{
			$adminEmail=$this->getAdminOption('admin_email');
		   //$adminEmail='srishti.thai@gmail.com';
			
			if ($this->request->is('post') || $this->request->is('put')) {
				
					//echo $this->request->data['start_date'];
					//print_r($this->request->data['userages']);
					$ages='';
					foreach($this->request->data['userages'] as $age){
						$ages.='<br/>'.$age.' Year';
					}
					
					
					
						$subject = 'Childcare home request in a new area';
							$message = 'Dear Admin, <br><br> This Customer request for new area.<br><br>';
						  $message.='Name: '.$this->request->data['username'].'<br>'.'Email: '.$this->request->data['useremail']."<br>".'Phone: '.$this->request->data['userphone']."<br>".'Address: '.$this->request->data['useraddress']."<br>".'City: '.$this->request->data['usercity']."<br>".'Zip: '.$this->request->data['userzip']."<br>".'Ages of children: '.$ages."<br>".'Start date: '.$this->request->data['start_date']."<br>".'Message: '.$this->request->data['usermessage']."<Br><br>";
							$message .= 'Thanks<br>Cutienest';
							if ($this->sendGeneralEmail($adminEmail, $subject, $message)){
								$this->Session->setFlash('Request for new area send successfull.', 'default', ['class' => 'success1']);
							} else {
								$this->Session->setFlash('Request for new area not send.Please try later!', 'default', ['class' => 'error1']);
							}
							return $this->redirect(array('controller'=>'search'));
					
					
			}
			
		}
		if(strcmp($page,'contact')==0)
		{
			$adminEmail=$this->getAdminOption('admin_email');
		   //$adminEmail='meghasharma27@gmail.com'; 
			$this->loadModel('Pagecontact');
			if ($this->request->is('post') || $this->request->is('put')) {
				$this->Pagecontact->set($this->request->data);
					 if($this->Pagecontact->validates())
					 {
						$subject = 'Childcare home request for contact';
							$message = 'Dear Admin, <br><br> This Customer request for contact.<br><br>';
						  $message.='Name: '.$this->request->data['Pagecontact']['username'].'<br>'.'Email: '.$this->request->data['Pagecontact']['useremail']."<br>".'Phone: '.$this->request->data['Pagecontact']['userphone']."<br>".'Address: '.$this->request->data['Pagecontact']['useraddress']."<br>".'Zip: '.$this->request->data['Pagecontact']['userzip']."<br>".'Message: '.$this->request->data['Pagecontact']['usermessage']."<Br><br>";
							$message .= 'Thanks<br>Cutienest';
							if ($this->sendGeneralEmail($adminEmail, $subject, $message)){
								$this->Session->setFlash('Thank you for contacting us. We will get back to you shortly!', 'default', ['class' => 'success']);
							} else {
								$this->Session->setFlash('An error occured. Please try again later!', 'default', ['class' => 'error']);
							}
							return $this->redirect(array('controller'=>'pages','action'=>'contact'));
					 }
					
							//return $this->redirect(array('controller'=>'pages','action'=>'contact'));
					
					
			}
			
		}
		
		
		
		
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->set('body', $body);
		if(isset($body['Page']['title']))
		{
			$title = $title.' | Cutienest';
			$this->set(compact('title'));
		}
		else
		{
			$title = 'Home | Cutienest';
			$this->set(compact('title'));
		}
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
		
		
	}
	


}