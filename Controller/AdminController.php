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

class AdminController extends AppController {

	 public $uses = ['User','Page'];

	    public $components = ['Paginator'];

    public $paginate = [

        'limit' => 10,

        'order' => [

            'User.id' => 'desc',

        ],

    ];

	 function beforeFilter()
	  {
    	parent::beforeFilter();
        $this->layout = 'admin';
		 if ($this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'users','action' => 'index']);
        }

 		 }

  	function enrollment()
	{
		$this->loadModel('enrollachilds');
		$childs=$this->enrollachilds->find('all',
				[
					'joins'=>	array(
									array(
										'table'=> 'enrolldetails',
										'alias'=> 'enrolldetails',
										'type'=>'INNER',
										'conditions'=> array(
														'enrollachilds.id = enrolldetails.enrollid'
										)		
									),
									array(
										'table'=>'users',
										'alias'=>'usp',
										'type'=>'INNER',
										'conditions'=> array(
														'enrollachilds.provider_id = usp.id'
													)
									),
									array(
										'table'=>'users',
										'alias'=>'usU',
										'type'=>'INNER',
										'conditions'=> array(
														'enrollachilds.user_id = usU.id'
														) 
									)
								),
					'fields'=> array('enrollachilds.*','enrolldetails.*','usp.name','usU.name'),
					
				]);
				
				
		$this->set('enrollment', $childs);
	}

  

  
	function invoices()
	{
		$this->loadModel('Invoice');
		$invoices = $this->Invoice->find('all',
					['joins' => array(
        							array(
            							'table' => 'enrollachilds',
            							'alias' => 'enrollachilds',
            							'type' => 'INNER',
            							'conditions' => array(
                									'Invoice.enroll_child_details_id = enrollachilds.id'
            						     )
        							),
									array(
            							'table' => 'users',
            							'alias' => 'usp',
            							'type' => 'INNER',
            							'conditions' => array(
                									'enrollachilds.provider_id = usp.id'
            						     )
        							),
									array(
            							'table' => 'users',
            							'alias' => 'usU',
            							'type' => 'INNER',
            							'conditions' => array(
                									'enrollachilds.user_id = usU.id'
            						     )
        							)
    						),
							'fields' => array('Invoice.*', 'enrollachilds.*','usp.name','usU.name'),
							'order' => 'Invoice.id ASC'
					]
		);
		
			 $this->set('invoices', $invoices);
	}
	function index(){

        if(!$this->Session->check('Auth.User')){

            $this->redirect(array('action' => 'login'));      

        }

		$this->Paginator->settings = ['conditions' => ['User.role' =>  1]];

        $data = $this->Paginator->paginate('User');

        $this->set('users', $data);

		

    }

		 public function login(){

		       $this->layout = 'login';

		 if ($this->request->is('post')) {

            if ($this->Auth->login()) {

                return $this->redirect(['controller' => 'users', 'action' => 'admin']);

            }

		 }

		}



    	public function logout()

    {

		$this->Session->destroy();

        return $this->redirect(array('controller'=>'admin','action'=>'login'));

	}

	

	    public function users(){

        

		$this->Paginator->settings = ['conditions' => ['User.role' =>  2]];

        $data = $this->Paginator->paginate('User');

        $this->set('users', $data);

		

    }

	    public function providerRequest(){

        

		$this->Paginator->settings = ['conditions' => ['User.role' =>  1,'User.provider_req !=' =>  2]];

        $data = $this->Paginator->paginate('User');

        $this->set('users', $data);

		

    }



	 public function providers(){

        

		$this->Paginator->settings = ['conditions' => ['User.role' =>  1, 'User.provider_req' => 2,'account_status'=>'active']];

        $data = $this->Paginator->paginate('User');

        $this->set('users', $data);

		

    }

	

	public function userAdd() {

		

       



    if ($this->request->is('post')) {

            if ($this->User->validates()) {

				$this->request->data['User']['status']=1;

				$this->request->data['User']['role']=2;

				$this->request->data['User']['verify']=1;

				$this->request->data['User']['username']=$this->request->data['User']['email'];



                $this->User->create();

                if ($this->User->save($this->request->data)) {

                        $this->Session->setFlash('User Successfully registered.', 'default', ['class' => 'success']);

                        return $this->redirect(['controller' => 'admin','action' => 'users']);

          

                    

                }

            }

        }

    }

	public function providerAdd() {

		

       



    if ($this->request->is('post')) {

            if ($this->User->validates()) {

				$this->request->data['User']['status']=1;

				$this->request->data['User']['verify']=1;

				$this->request->data['User']['provider_req']=2;

				$this->request->data['User']['admin_approve']=1;

				$this->request->data['User']['role']=1;

				$this->request->data['User']['username']=$this->request->data['User']['email'];



                $this->User->create();

                if ($this->User->save($this->request->data)) {

                        $this->Session->setFlash('Provider Successfully registered.', 'default', ['class' => 'success']);

                        return $this->redirect(['controller' => 'admin','action' => 'providers']);

          

                    

                }

            }

        }

    }

	

	public function userEdit($id){

        if ($this->request->is(['post', 'put'])&&isset($this->request->data['User']['name'])&&$this->request->data['User']['name']!='') {

            $this->request->data['id'] = $id;

            if ($this->User->save($this->request->data)) {

                $this->Session->setFlash('User updated successfully', 'default', ['class' => 'success']);

                return $this->redirect(['action' => 'users']);

            } else {

                $this->Session->setFlash('Unable to update user.', 'default', ['class' => 'error']);

            }

        } else {

            $post = $this->User->findById($id);



            if (!$post) {

                throw new NotFoundException(__('Invalid User'));

            }



            $this->request->data = $post;

        }

    

		

		

		}

		public function providerEdit($id){

			if ($this->request->is(['post', 'put'])&&isset($this->request->data['User']['name'])&&$this->request->data['User']['name']!='') {

            $this->request->data['id'] = $id;
			$this->request->data['User']['admin_approve']=1;
            if ($this->User->save($this->request->data)) {

                $this->Session->setFlash('User updated successfully', 'default', ['class' => 'success']);

                return $this->redirect(['action' => 'providers']);

            } else {

                $this->Session->setFlash('Unable to update user.', 'default', ['class' => 'error']);

            }

			} else {

				$post = $this->User->findById($id);



				if (!$post) {

					throw new NotFoundException(__('Invalid User'));

				}
				$this->request->data = $post;

			}

		}
		
		public function providerView($id){

			if ($this->request->is(['post', 'put'])&&isset($this->request->data['User']['name'])&&$this->request->data['User']['name']!='') {

            $this->request->data['id'] = $id;
			$this->request->data['User']['admin_approve']=1;
            

			} else {

				$post = $this->User->findById($id);



				if (!$post) {

					throw new NotFoundException(__('Invalid User'));

				}
				$this->request->data = $post;

			}

		}

	 public function userDelete($id)

    {

       



        if ($this->request->is('get')) {

            throw new MethodNotAllowedException();

        }

		$user = $this->User->findById($id);

        if ($this->User->delete($id)) {

            $this->Session->setFlash('User deleted successfully', 'default', ['class' => 'success']);

        } else {

            $this->Session->setFlash('User can\'t be deleted', 'default', ['class' => 'error']);

        }



         if($user['User']['role']==1){

				return $this->redirect(['action' => 'providers']);

		 }

		 else{

				return $this->redirect(['action' => 'users']);

		 }

    }

    public function activateAccount($id)

    {

       

        if ($this->request->is('get')) {

            throw new MethodNotAllowedException();

        }

		

 		$user = $this->User->findById($id);

	

        if($user['User']['status']==0){

				

		$data = [

            'id' => $id,

            'status' => 1,
			
			'admin_approve'=>1,
			
			'account_status'=>'active'

        ];
			$adminapproval=1;
			$newStatus=1;	

			}

		else{

		

		 $data = [

            'id' => $id,

            'status' => 0,
			
			'admin_approve'=>0,
			
			'account_status'=>'deactivated'

        ];
			$adminapproval=0;
			$newStatus=0;

		}

      


		
        if ($this->User->save($data)) {

			

            $this->User->updateAll(

                ['status' => $newStatus,'verify' => 1,'admin_approve' => $adminapproval],

                ['id' => $id]
				
				
            );





        } else {

            $this->Session->setFlash('User can\'t be activated', 'default', ['class' => 'error']);

        }
		
		 if($user['User']['role']==1){
				
		
				return $this->redirect(['action' => 'providers']);

		 }

		 else{

				return $this->redirect(['action' => 'users']);

		 }

    }

	

    public function activateAccountProvider($id,$action)

    {

      
	/*Commented by ankit for future information:
	 action :: 2=active
	 	"	:: 4=on-hold
		"   :: 5=deleted
	  */
        

		
		
		//if($action){$action_string=2;$role=1;}else{$action_string=3;$role=2;}

		$action_string=$action;

 		$user = $this->User->findById($id);

		$data = [

            'id' => $id,

            'provider_req' => $action_string,

			

        ];

				

			



        if ($this->request->is('get')) {

			
			if($action==2)
			{
				$this->User->id=$id;
				$this->User->set(array('provider_req'=>$action_string,'account_status'=>'active'));
				$this->User->save();
            	
			}
			else if($action==4)
			{
				$this->User->id=$id;
				$this->User->set(array('provider_req'=>$action_string,'account_status'=>'on-hold'));
				$this->User->save();
				
			}
			else if($action==5)
			{
				$this->User->id=$id;
				$this->User->set(array('provider_req'=>$action,'account_status'=>'deleted'));
				$this->User->save();
				
			}





		if($action==3){

			$subject = 'Account Rejected';

			$to=$user['User']['email'];

			$userArray=array('Name'=>$user['User']['name']);

			$message='Dear '.$user['User']['name'].',<br><br>Your Profile Rejected, Please contact to Admin.<br><br>Thanks<br>Cutienest';

			$this->sendGeneralEmail($user['User']['email'], $subject, $message);

 			$this->Session->setFlash('User profile for provider is  Rejected', 'default', ['class' => 'error']);

			return $this->redirect(['action' => 'providerRequest']);

			

			}else if($action==2){

			

			$subject = 'Account Activation';

			$to=$user['User']['email'];

			$userArray=array('Name'=>$user['User']['name']);

			$message='';

			$this->sendEmail($user['User']['email'], $subject, 'activate','cutienest',$userArray);

 			$this->Session->setFlash('User  activated as a provider', 'default', ['class' => 'success']);

			return $this->redirect(['action' => 'providerRequest']);

			}
			
			else if($action==4){

			

			$subject = 'Account Deactivate';

			$to=$user['User']['email'];

			$userArray=array('Name'=>$user['User']['name']);

			$message='';

			$this->sendEmail($user['User']['email'], $subject, 'activate','cutienest',$userArray);

 			$this->Session->setFlash('User  Deactivate as a provider', 'default', ['class' => 'success']);

			return $this->redirect(['action' => 'providerRequest']);

			}
			else if($action==5){

			

			$subject = 'Account Deleted';

			$to=$user['User']['email'];

			$userArray=array('Name'=>$user['User']['name']);

			$message='';

			$this->sendEmail($user['User']['email'], $subject, 'activate','cutienest',$userArray);

 			$this->Session->setFlash('User Deleted as a provider', 'default', ['class' => 'success']);

			return $this->redirect(['action' => 'providerRequest']);

			}
			$this->Session->setFlash('User Deleted as a provider', 'default', ['class' => 'success']);
			return $this->redirect(['action' => 'providerRequest']);
   

        } else {

            $this->Session->setFlash('User can\'t be activated', 'default', ['class' => 'error']);

			return $this->redirect(['action' => 'providerRequest']);

        }

	

    }

	

		    public function pages(){

        $data = $this->Paginator->paginate('Page');

        $this->set('pages', $data);

		

    	}

	public function pageAdd() {

			if ($this->request->is('post')) {

					if ($this->Page->validates()) {

						$this->Page->create();

						if ($this->Page->save($this->request->data)) {

								$this->Session->setFlash('Page Successfully Added.', 'default', ['class' => 'success']);

								return $this->redirect(['controller' => 'admin','action' => 'pages']);

				  

							

						}

					}

				}

    	}

		

		

		

	public function pageEdit($id){

        if ($this->request->is(['post', 'put'])&&isset($this->request->data['Page']['title'])&&$this->request->data['Page']['title']!='') {
			$this->loadModel('Page');
			$this->Page->id=$id;
			$arrayPage=array(
							'body'=>$this->request->data['Page']['body'],
							'title'=>$this->request->data['Page']['title']
			);
            if ($this->Page->save($arrayPage)) {
                $this->Session->setFlash('Page updated successfully', 'default', ['class' => 'success']);
                return $this->redirect(['action' => 'pages']);
            } else {
                $this->Session->setFlash('Unable to update page.', 'default', ['class' => 'error']);
            }

        } else {

            $post = $this->Page->findById($id);


			
            if (!$post) {

                throw new NotFoundException(__('Invalid Page'));

            }



            $this->request->data = $post;

        }

		

		}

	

	

	

	

		public function policy(){

        if ($this->request->is(['post', 'put'])) {

            if ($this->Page->save($this->request->data)) {

                $this->Session->setFlash('Page updated successfully', 'default', ['class' => 'success']);

                return $this->redirect(['action' => 'pages']);

            } else {

                $this->Session->setFlash('Unable to update page.', 'default', ['class' => 'error']);

            }

    	    } else {

			$content = $this->Page->find('all',['conditions' => ['Page.slug' =>'policy']]);

			$this->set(compact('content'));

      	  }

		}

	

		 public function pageDelete($id)

    {

       



			if ($this->request->is('get')) {

				throw new MethodNotAllowedException();

			}

	

			if ($this->Page->delete($id)) {

				$this->Session->setFlash('Page deleted successfully', 'default', ['class' => 'success']);

			} else {

				$this->Session->setFlash('Page can\'t be deleted', 'default', ['class' => 'error']);

			}

	

			return $this->redirect(['action' => 'pages']);

	}

    public function changePassword()

    {

        $id = $this->Auth->user('id');

        $userData = $this->User->findById($id);

         $adminEmail=$this->getAdminOption('admin_email');
         $this->set('adminEmail',$adminEmail);
        if ($this->request->is(['post', 'put'])) {

            // It will generate the hashed password using the Auth component.

            $old_password = $this->Auth->password($this->data['User']['old_password']);

            $new_password = $this->Auth->password($this->data['User']['new_password']);

            $confirm_password = $this->Auth->password($this->data['User']['confirm_password']);



            if ($old_password != $userData['User']['password']) {

                $this->Session->setFlash('Your old password is wrong!', 'default', ['class' => 'error']);



                return $this->redirect(['action' => 'changePassword']);

            }



            if ($new_password != $confirm_password) {

                $this->Session->setFlash('New password and confirm password should be same!', 'default', ['class' => 'error']);



                return $this->redirect(['action' => 'changePassword']);

            }



            if ($this->User->updateAll(['User.password' => "'$new_password'"], ['User.id' => $id])) {

                echo $this->Session->setFlash('Password changed successfully!', 'default', ['class' => 'success']);



                return $this->redirect(['action' => 'changePassword']);

            }

        } else {

            $post = $this->User->findById($id);



            if (!$post) {

                throw new NotFoundException(__('Invalid User'));

            }



            $this->request->data = $post;

        }

    }

}