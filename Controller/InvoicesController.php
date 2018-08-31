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
class InvoicesController extends AppController 
{
	public  $uses = ['User','Review'];

	public function index()
	{
		
		$this->paginate = array(
            'limit' => 6,
            'order' => array('Review.id' => 'asc' )
        );
        $users = $this->paginate('Review');
        $this->set(compact('review'));
		
	}
		public function add()
	{
		
		   if ($this->request->is('post')) {
            if ($this->Review->validates()) {
				$this->request->data['Review']['user_id']=$this->Auth->User('id');
                if ($this->Review->save($this->request->data)) {
				$total = $this->Review->query("select `id` from reviews  where provider='".$this->request->data['Review']['provider']."'");

				$sum = $this->Review->query("select sum(rating) from reviews  where provider='".$this->request->data['Review']['provider']."'");
				$avg_rating=reset($sum)[0]['sum(rating)']/sizeof($total);
				$this->Review->query("update users set rating='".number_format($avg_rating,2)."'  where id='".$this->request->data['Review']['provider']."'");
                $this->Session->setFlash('You has been successfully Review  Provider.', 'default', ['class' => 'success']);
                return $this->redirect(array('controller'=>'search','action'=>'detail/'.$this->request->data['Review']['provider']));

                }
            }
        }
		
	}
			public function changestatus($id) 
	{
		 $this->layout=false;	
		if (!$this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'admin','action' => 'index']);
        }
		
		
		$data = $this->User->query("select * from invoices  where id='".$id."' and provider=".$this->Auth->User('id'));

			if(sizeof($data) == 0){
				 throw new NotFoundException(__('Invalid User'));
		}
		if($data[0]['invoices']['status']==0){
      		$this->User->query("UPDATE invoices SET  status='1' where provider='".$this->Auth->User('id')."' and id='".$id."'");
			
			$user = $this->User->findById($data[0]['invoices']['user']);
			$subject = 'Invoice Paid';
			$userArray=array('Name'=>$user['User']['name'],'DueDate'=>$data[0]['invoices']['due_date'],'JoiningDate'=>$data[0]['invoices']['joining_date'],'Amount'=>$data[0]['invoices']['amount']);

            if ($this->sendEmail($user['User']['email'], $subject, 'invoice_status','cutienest',$userArray)) {
                $this->Session->setFlash('Invoice successfully Sent to User.', 'default', ['class' => 'success']);
            }

			
			
			
			
			
				$this->Session->setFlash('Invoice Status Updated!', 'default', ['class' => 'success']);
	
			
		}else{}

		return $this->redirect(['controller' => 'users','action' => 'invoice']);	
    }
			public function delete($id)
		   {
				 $this->layout=false;
				if (!$this->User->isNotSuperAdmin()) {
					return $this->redirect(['controller' => 'admin','action' => 'index']);
				}
				$data = $this->User->query("select * from invoices  where id='".$id."' and provider=".$this->Auth->User('id'));
				if(sizeof($data) == 0){
						 throw new NotFoundException(__('Invalid User'));
				}
				$data = $this->User->query("delete  from invoices  where id='".$id."' and provider=".$this->Auth->User('id'));
						$this->Session->setFlash('Invoice Removed Successfully', 'default', ['class' => 'success']);

				return $this->redirect(['controller' => 'users','action' => 'invoice']);	

			}	
		
	
}
