<?php
class UsersController extends AppController {
   	public  $uses = ['Pricelist','User','Image','Page','Invoice','SocialProfile','Availability','Review','Admissionpack','Provider'];
	public $components = array('Hybridauth.Hybridauth');
    public $paginate = [
        'limit' => 10,
        'order' => [
            'User.id' => 'desc',
        ],
    ];
	function beforeFilter()
	{
    	parent::beforeFilter();
		if($this->Session->check('Auth.User'))
		{
		if($this->User->isSuperAdmin())
		{
			
			return $this->redirect(['controller' => 'admin','action' => 'index']);
			
		}
		else if($this->User->isProvider())
		{
			return $this->redirect(['controller' => 'providers','action' => 'viewMyProfile']);
		}
		}
		
 	}
    public function login() {

        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));
        }
        $title = 'Login | Cutienest';
		$this->set(compact('title'));
        if ($this->request->is('post')) {
			
           if ($this->Auth->login()) {
			   $user=$this->User->findById($this->Auth->User('id'));
				if ($this->Auth->User('verify') == 0) {
						$uuid = md5($this->generate_password());
						$this->User->updateAll(['User.uuid' => "'" . $uuid . "'"], ['User.id' => $this->Auth->User('id')]);
                        $subject = 'Cutienest Verify Email';
                        $message = 'Dear ' . $this->Auth->User('name') . ', <br><br> Please click to below link to verify email address <br><br>';
                        $message .= '<a href="' . Configure::read('SITE_URL') . 'users/verifyemail/' . $uuid . '">Click here to activate Account</a><br><br>';
                        $message .= 'Thanks<br>Cutienest';
                        if (1) {
							$form="<form name='verify_form' id='verify_form' action='/users/reverify' method='post' style='display:inline-block;'> ";
							$form .="<input type='hidden' name='email' id='email' value='".$this->Auth->User('email')."' >";
							$form .= "<input type='submit' name='submit' value='here' class='reverify-button'>";
							$form .='</form>';
                            $this->Session->setFlash('Your email address not verified yet, Click '.$form.' to resend verification email.', 'default', ['class' => 'error']);
                        	$this->Auth->logout();
					    } else {
                            $this->Session->setFlash('Email not Sent', 'default', ['class' => 'error']);
                        }
                        return $this->redirect(array('controller'=>'users','action'=>'login'));
				}
				
				else if ($this->Auth->user('role') == 0 && strcmp($user['User']['account_status'],'active')==0) {
					$this->redirect(array('controller' => 'admin','action' => 'index'));
				}elseif($this->Auth->user('role') == 1 && strcmp($user['User']['account_status'],'active')==0){
	            	$this->redirect(array('controller' => 'users','action' => 'viewMyProfile'));
   				}
				elseif( $this->Auth->user('role') == 2 && strcmp($user['User']['account_status'],'active')==0)
				{
				    $this->redirect(array('controller' => 'users','action' => 'viewMyProfile'));
				}
				else
				{
					$this->Session->setFlash(__('your account is deleted'));
					$this->Auth->logout();
				}
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
				
            }
        }
    }
	public function deleteaccount()
	{
		$this->loadModel('User');
		$this->User->id=$this->Auth->User('id');                
		$this->User->set(array('account_status'=>'deleted','status'=>'0'));                
		$this->User->save();
		
		die;
	}
	public function profilePicture()
	{
		
    	$title = 'Profile picture | Cutienest';
		$this->set(compact('title'));
		$this->loadModel('Profileimage');
	  
        if ($this->request->is('post')) {
			if(!empty($this->request->data['Profileimage']['image_encode'])){
					$image_parts = explode(";base64,", $this->request->data['Profileimage']['image_encode']);
					$image_type_aux = explode("image/", $image_parts[0]);
					$image_type = $image_type_aux[1];
					$image_base64 = base64_decode($image_parts[1]);
					$file = WWW_ROOT.'uploads/gallery/profile' .$this->Auth->User('id'). '.'.$image_type;
					$arr_ext = ['jpg', 'jpeg', 'gif', 'png','bmp', 'tiff'];
					if(in_array($image_type,$arr_ext)){
						file_put_contents($file, $image_base64);
						
						$file_name='profile' .$this->Auth->User('id'). '.'.$image_type;
						$this->request->data['Profileimage']['path'] = $file_name;
						$this->request->data['Profileimage']['type'] = 'profile';
						$this->request->data['Profileimage']['user_id'] = $this->Auth->User('id');
						$this->Profileimage->create();
						$this->Profileimage->deleteAll(['user_id' => $this->Auth->User('id')]);
						if ($this->Profileimage->save($this->request->data)) {
								$this->Session->setFlash('Profile Picture Successfully Uploaded', 'default', ['class' => 'success']);
								return $this->redirect(array('action' => 'profilePicture'));
						}
					}
					else{
						$this->Session->setFlash('File Extention Not Allowed', 'default', ['class' => 'error']);
						return $this->redirect(array('action' => 'profilePicture'));	
					}
			}				
		  }  	
		   $user = $this->User->findById($this->Auth->User('id'));
	   $data = $this->Profileimage->find('first',['conditions' => ['user_id' =>$this->Auth->User('id')]]);
       $this->set(compact('data','user'));
    
	}
	public function reviewsRating()
	{
		
		$title = 'Reviews | Cutienest';
		$this->set(compact('title'));

$user = $this->User->findById($this->Auth->User('id'));
$this->set('user',$user);
			if (!$this->User->isNotSuperAdmin()) {
				return $this->redirect(['controller' => 'admin','action' => 'index']);
			}
				$data = $this->User->query("select * from reviews  where user_id='".$this->Auth->User('id')."'");
				$this->set(compact('data'));
    
	}
	public function reverify()
	{
		
		if ($this->request->is('post')) {
			
			$email= $this->request->data('email');

		}
				if ($this->Auth->User('verify') == 0) {
						$uuid = md5($this->generate_password());
						$this->User->updateAll(['User.uuid' => "'" . $uuid . "'"], ['User.email' => $email]);
      					$user = $this->User->find('all',['conditions' => ['User.email' =>$email]]);
                        $subject = 'Cutienest Verify Email';
                        $message = 'Dear ' . $user[0]['User']['name'] . ', <br><br> Please click to below link to verify email address <br><br>';
                        $message .= '<a href="' . Configure::read('SITE_URL') . 'users/verifyemail/' . $uuid . '">Click here to activate Account</a><br><br>';
                        $message .= 'Thanks<br>Cutienest';
                       
						try
						{
							if ($this->sendGeneralEmail($email, $subject, $message)) {
								$this->Session->setFlash('Please verify your email by clicking on the link send to your email address.', 'default', ['class' => 'error']);
								//$this->Auth->logout();
							} else {
								$this->Session->setFlash('Email not Sent', 'default', ['class' => 'error']);
							}
                        
						
						}
						catch(SocketException $e)
						{
							$this->Session->setFlash('Email not Sent. Please try later!', 'default', ['class' => 'error']);
						}
						
						return $this->redirect(array('controller'=>'users','action'=>'login'));				
	 	} 
		
		
	}
	 /*



 public function login()



{



    // If it is a post request we can assume this is a local login request



    if ($this->request->isPost()){



        if ($this->Auth->login()){



            $this->redirect($this->Auth->redirectUrl());



        } else {



            $this->Session->setFlash(__('Invalid Username or password. Try again.'));



        }



    } 







    // When facebook login is used, facebook always returns $_GET['code'].



    elseif($this->request->query('code')){







        // User login successful



        $fb_user = $this->Facebook->getUser();          # Returns facebook user_id



        if ($fb_user){



            $fb_user = $this->Facebook->api('/me');     # Returns user information







            // We will verify if a local user exists first



            $local_user = $this->User->find('first', array(



                'conditions' => array('username' => $fb_user['email'])



            ));







            // If exists, we will log them in



            if ($local_user){



                $this->Auth->login($local_user['User']);            # Manual Login



                $this->redirect($this->Auth->redirectUrl());



            } 







            // Otherwise we ll add a new user (Registration)



            else {



                $data['User'] = array(



                    'username'      => $fb_user['email'],                               # Normally Unique



                    'password'      => AuthComponent::password(uniqid(md5(mt_rand()))), # Set random password



                    'role'          => 'author'



                );







                // You should change this part to include data validation



                $this->User->save($data, array('validate' => false));







                // After registration we will redirect them back here so they will be logged in



                $this->redirect(Router::url('/users/login?code=true', true));



            }



        }







        else{



            // User login failed..



        }



    }



}*/
    public function logout() {
		$this->Hybridauth->logout();
        $this->redirect($this->Auth->logout());
    }
    public function index() {
		if (!$this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'admin','action' => 'index']);
        }
        $this->paginate = array(
            'limit' => 6,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }
     

	public function paypalpayment()
	{
		$this->loadModel('User');
		$this->loadModel('Invoice');
		$this->loadModel('paypalpayment');
		$invoices = $this->Invoice->find('all',['conditions' => ['Invoice.id' =>$_GET['invoice']]]);
		$user = $this->User->findById($this->Auth->User('id'));
		$this->set(compact('invoices','user'));
	}
    public function register() 
	{

    	$title = 'Register as provider | Cutienest';
			$this->set(compact('title'));
	   $admin = $this->User->findById(10);
       $user = $this->User->findById($this->Auth->User('id'));
	   $this->set('user', $user);
	   $adminEmail=$this->getAdminOption('admin_email');
    	
        if ($this->request->is('post') || $this->request->is('put')) {
				$this->request->data['User']['status']=1;
if(empty($this->Auth->User('id'))){
				$uuid = md5($this->generate_password());
				$this->request->data['User']['verify']=0;
				$this->request->data['User']['uuid']=$uuid;
				$this->request->data['User']['admin_approve']=0;
}
				$this->request->data['User']['availability']='available';
				$this->request->data['User']['provider_req']=1;
				$this->request->data['User']['role']=1;
				if(!empty($this->request->data['User']['image']['name']))
				 {
				 		$file = $this->data['User']['image']; //put the  data into a var for easy use
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
        $arr_ext = array('jpg', 'jpeg', 'gif','doc','docx','pdf','png'); 
         if(in_array($ext, $arr_ext))
        {
        	if(move_uploaded_file($file['tmp_name'], WWW_ROOT . 'uploads/img/upload_folder' . DS . $file['name']))
            {
			 $this->request->data['User']['licence_image']=$file['name'];
            }
        }
				 }

				if($this->request->data['User']['stage']==0)
				{
					$subject = 'Need Help for licence';
                        $message = 'Dear Admin, <br><br> This Customer request for need help for licence, the details of customer as follows<br><br>';
                      $message.='Name: '.$this->request->data['User']['name'].'<br>'.'Email: '.$this->request->data['User']['email']."<br>".'Phone: '.$this->request->data['User']['phone']."<br>".'Address: '.$this->request->data['User']['address']."<Br><br>";
                        $message .= 'Thanks<br>Cutienest';
						try
						{
							//$this->sendGeneralEmail($adminEmail, $subject, $message);
							
							if ($this->sendGeneralEmail('srishti.thai@gmail.com', $subject, $message)) {
                            $this->Session->setFlash('Request sent to admin. Please wait for admin approval.', 'default', ['class' => 'success']);
							} else {
								$this->Session->setFlash('Request not sent to admin. Please try again.', 'default', ['class' => 'error']);
							}
							
							
						}
						catch(SocketException $e)
						{
							$this->Session->setFlash('Request not sent to admin. Please try again.', 'default', ['class' => 'error']);
						}
						return $this->redirect(array('controller'=>'users','action'=>'login'));
				}
				
				
				
				$this->request->data['User']['username']=$this->request->data['User']['email'];
                if ($this->User->save($this->request->data)) {
	if(empty($this->Auth->User('id'))){
					                       $subject = 'Cutienest Verify Email';
                        $message = 'Dear ' . $this->request->data['User']['name'] . ', <br><br> Please click to below link to verify email address <br><br>';
                        $message .= '<a href="' . Configure::read('SITE_URL') . 'users/verifyemail/' . $uuid . '">Click here to activate Account</a><br><br>';
                        $message .= 'Thanks<br>Cutienest';
                        if ($this->sendGeneralEmail($this->request->data['User']['email'], $subject, $message)) {
                           // $this->Session->setFlash('Registration successful. Please verify your email address by clicking on activation link sent in your email account.', 'default', ['class' => 'success']);
                            $this->Session->setFlash('Registration successful. Please verify your email address by clicking on activation link sent in your email account.', 'default', ['class' => 'success']);

						} else {
                            $this->Session->setFlash('Registration Failed', 'default', ['class' => 'error']);
                        }
                        return $this->redirect(array('controller'=>'users','action'=>'login'));
					/*

					

						$subject = 'New Provider Request';

				$to=$admin['User']['email'];

				$userArray=array('Name'=>'Admin');

				$message='Dear Admin,<br><br>New Provider registered';

				$message.='<br><br>Name : '.$this->request->data['User']['name'].'<br/>';

				$message.='<br><br>Email : '.$this->request->data['User']['email'].'<br/>';

				$message.='<br><br>address : '.$this->request->data['User']['address'].'<br/>';

				if($this->request->data['User']['helplicence']){

				$message.='<br><br>Need Help For licence : Yes<br/>';

				}

				else

				{

				$message.='<br><br>Need Help For licence :No<br/>';

					

					

				}

				$message.='<br><br>Thanks<br>Cutienest';

				$this->sendGeneralEmail($to, $subject, $message);

			



                $this->Session->setFlash('Request sent to admin. Please wait for admin approval.', 'default', ['class' => 'success']);



                return $this->redirect(array('controller'=>'users','action'=>'login'));



                */

				

				}

				else{
				$subject = 'New Provider Request';
				$to=$admin['User']['email'];
				$userArray=array('Name'=>'Admin');
				$message='Dear Admin,<br><br>New Provider registered';
				$message.='<br><br>Name : '.$this->request->data['User']['name'].'<br/>';
				$message.='<br><br>Email : '.$this->request->data['User']['email'].'<br/>';
				$message.='<br><br>address : '.$this->request->data['User']['address'].'<br/>';
				if($this->request->data['User']['helplicence']){
				$message.='<br><br>Need Help For licence : Yes<br/>';
				}
				else
				{
				$message.='<br><br>Need Help For licence :No<br/>';
				}
				$message.='<br><br>Thanks<br>Cutienest';
				$this->sendGeneralEmail('arun.explorer7@gmail.com', $subject, $message);
                $this->Session->setFlash('Request sent to admin. Please wait for admin approval.', 'default', ['class' => 'success']);
                return $this->redirect(array('controller'=>'users','action'=>'login'));		
					}
				}
        }
    }
	
	
	public function updateUserProfile() {
       $user = $this->User->findById($this->Auth->User('id'));
	   $this->set('user', $user);
        if ($this->request->is('post') || $this->request->is('put')) {
                
					if (!empty($this->request->data['User']['state_id']['name'])) 
					{
						$file = $this->request->data['User']['state_id'];
						$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
						$arr_ext = ['jpg', 'jpeg', 'gif', 'png','bmp', 'tiff', 'doc', 'docx', 'pdf'];
						if(in_array($ext,$arr_ext)){
							move_uploaded_file($file['tmp_name'], WWW_ROOT.'uploads/dl_state_id/' . $file['name']);
						}
						else
						{
							$this->Session->setFlash('File Extention Not Allowed', 'default', ['class' => 'error']);
							return $this->redirect(array('controller'=>'users','action'=>'updateUserProfile'));
						}
					}
					if (!empty($this->request->data['User']['state_id']['name'])) {
					$this->request->data['User']['state_id']=$this->request->data['User']['state_id']['name'];
					}
					else{
						$this->request->data['User']['state_id']=$this->request->data['User']['dl_id'];
					}
				
					if ($this->User->save($this->request->data)) {

							$this->Session->setFlash('Profile Successfully Updated.', 'default', ['class' => 'success']);
							return $this->redirect(array('controller'=>'users','action'=>'updateUserProfile'));
					}
						
					
				
					
					
					
                
        }
    }
    
	 public function viewMyProfile() {

 		$title = 'View Profile | Cutienest';
		$this->set(compact('title'));
		$id=$this->Auth->User('id');
		$this->loadModel('Profileimage');
		$Profileimage = $this->Profileimage->find('first',['conditions' => ['user_id' =>$id]]);
       	$user = $this->User->findById($this->Auth->User('id'));
       	if($this->Auth->user('role')==1)
       	{
       		$user = $this->User->findById($this->Auth->User('id'));
			$invoices = $this->Invoice->find('all',['conditions' => ['Invoice.provider' =>$this->Auth->User('id')]]);
			$providerArray=array();
      		 foreach($invoices as $inv)
       		{
       		array_push($providerArray, $inv['Invoice']['user']);
       		}
       		$data = $this->User->query("select * from reviews  where user_id='".$this->Auth->User('id')."'");
       	}
       	else
       	{
        	$invoices = $this->Invoice->find('all',['conditions' => ['Invoice.user' =>$this->Auth->User('id')]]);
       		$providerArray=array();
       		foreach($invoices as $inv)
       		{
       			array_push($providerArray, $inv['Invoice']['provider']);
       		}
      		$data = $this->User->query("select * from reviews  where user_id='".$this->Auth->User('id')."'");
   		}
	   $this->set(compact('invoices','user','data','providerArray','Profileimage'));
    }
    
	


    public function signin() {
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));
        }
        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
				if ($this->Auth->user('role') == 0) {
        $this->Auth->logoutRedirect = array(
        'controller' => 'users',
        'action' => 'login'
        );
		     $this->Auth->loginRedirect = array(
        'controller' => 'admin',
        'action' => 'index'
        );
   }elseif($this->Auth->user('role') == 1 || $this->Auth->user('role') == 2 ){
        $this->Auth->logoutRedirect = array(
        'controller' => 'users',
        'action' => 'login'
        );
		$this->Auth->loginRedirect = array(
        'controller' => 'users',
        'action' => 'viewMyProfile'
        );
   }
   	if(empty($this->request->data['redirect'])){
                $this->redirect($this->Auth->redirectUrl());
  		 }else{
	      $this->redirect($this->request->data['redirect']);
		 }
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }
    public function verifyemail($uuid) {
           $this->layout=false;
	   if ($uuid) {
            $user = $this->User->find('first', [
                'conditions' => [
                    'User.uuid' => $uuid,
                ],
            ]);
            if (!empty($user)) {
					$this->User->save([
						'id' => $user['User']['id'],
						'uuid' => '',
						'verify' => '1',
					], false);
					$role=$user['User']['role'];
						$subject = 'Welcome Cutienest';
						$to=$user['User']['email'];
						$userArray=array('Name'=>$user['User']['name']);
						$message='';
						if ($this->sendEmail($user['User']['email'], $subject, 'welcome','cutienest',$userArray)) {
							if($role == 1){
								$this->Session->setFlash('Thanks for showing interest to be a provider with us! Give us 24 hours to review your application and We shall get back soon. Happy entrepreneurship!', 'default', ['class' => 'success']);
							}
							else if($role==2){
								$this->Session->setFlash('Account successfully activated. Please Login', 'default', ['class' => 'success']);
							}
						$this->redirect(['action' => 'login']);
  						} else {
						$this->redirect(['action' => 'login']);
						}
            } else {
                if (!$this->request->is('post')) {
                    $error = 'Your link is not valid or expired';
                    $this->Session->setFlash($error, 'default', ['class' => 'error']);
          			$this->redirect(['action' => 'login']);
			    }
            }
        }
    }
    public function edit($id = null) {
            if (!$id) {
                $this->Session->setFlash('Please provide a user id');
                $this->redirect(array('action'=>'index'));
            }
            $user = $this->User->findById($id);
            if (!$user) {
                $this->Session->setFlash('Invalid User ID Provided');
                $this->redirect(array('action'=>'index'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->User->id = $id;
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been updated'));
                    $this->redirect(array('action' => 'edit', $id));
                }else{
                    $this->Session->setFlash(__('Unable to update your user.'));
                }
            }
            if (!$this->request->data) {
                $this->request->data = $user;
            }
    }
    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    public function activate($id = null) {
        if (!$id) {
            $this->Session->setFlash('Please provide a user id');
            $this->redirect(array('action'=>'index'));
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }
		 public function invoice()
		{
				$title = 'Invoices | Cutienest';
				$this->set(compact('title'));
				if (!$this->User->isNotSuperAdmin()) {
					return $this->redirect(['controller' => 'admin','action' => 'index']);
				}
				$user = $this->User->findById($this->Auth->User('id'));
				$invoices = $this->Invoice->find('all',['conditions' => ['Invoice.provider' =>$this->Auth->User('id')]]);
				$this->set(compact('invoices','user'));
		}
		 public function userInvoice() 
	{
			if (!$this->User->isNotSuperAdmin()) {
				return $this->redirect(['controller' => 'admin','action' => 'index']);
			}
			$this->loadModel('enrolldetails');
			$invoices = $this->Invoice->find('all',
												['conditions' => 
													[
														'Invoice.user' =>$this->Auth->User('id')
													],
												 'joins' => array(
        														array(
            														'table' => 'enrolldetails',
            														'alias' => 'enrolldetails',
            														'type' => 'INNER',
            														'conditions' => array(
                														'enrolldetails.id = Invoice.enroll_child_details_id'
            																)
        															)
    															),
						 						'fields' => array('Invoice.*', 'enrolldetails.*'),
												'order' => 'Invoice.id ASC'
												]
											);
			
			$this->set(compact('invoices'));
    }
 	 
	
    public function changePassword()
    {
		$title = 'Change Password | Cutienest';
		$this->set(compact('title'));
        $id = $this->Auth->user('id');
        $userData = $this->User->findById($id);
		$user = $this->User->findById($this->Auth->User('id'));
		$this->set('user',$user);
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
			public function policy(){
			$user = $this->User->findById($this->Auth->User('id'));
	  		 //$this->set('user', $user);
       		$content = $this->Page->find('all',['conditions' => ['Page.slug' =>'policy']]);
			$this->set(compact('content','user'));
		}
		public function reserve(){
		if($this->Auth->user('role') != 2){
            throw new NotFoundException(__('Invalid User'));
        }
		
				 if ($this->request->data['provider']) {
					 try
					 {
					 $tableMsg="<table border='2'>
					 			<tr>
    								<th>Kid's First Name</th>
									<th>Kid's Last Name</th>
    								<th>Kid's Age</th>
    								<th>Gender</th>
    								<th>Start Date</th>
    								<th>End Date</th>
    								<th>Payment</th>
  								</tr>";
  
					 $user2 = $this->User->findById($this->Auth->User('id'));
					 $this->loadModel('enrollachilds');
					 $this->loadModel('enrolldetails');
					 $user = $this->User->findById($this->request->data['provider']);
					 $userArray=array(
					 			'provider_id'=>$this->request->data['provider'],
								'user_id'=>$this->Auth->User('id')
					 );
					$enrollachilds=$this->enrollachilds->save($userArray);
					$enrollId=$enrollachilds['enrollachilds']['id'];
					
					for($i=0;$i<count($this->request->data['User']['childname']);$i++)
					{
						
					
						$childname=$this->request->data['User']['childname'][$i];
						$lastname=$this->request->data['User']['lastname'][$i];
						$age=$this->request->data['User']['age'][$i];
						$gender=$this->request->data['User']['gender'][$i];
						$startdateString=$this->request->data['User']['startdate'][$i];
						$convertedDate = date('Y-m-d', strtotime($startdateString));
						$enddateString=$this->request->data['User']['enddate'][$i];
						$convertedEndDate = date('Y-m-d', strtotime($enddateString));
						$paymentfrequency=$this->request->data['User']['paymentfrequency'][$i];
						if(strcmp($enddateString,'')==0)
						{
							$convertedEndDate='0000-00-00';
						}
						$msgt='Daily';
						if(strcmp($paymentfrequency,'M')==0)
						{
							$msgt='Monthly';
						}
						else if(strcmp($paymentfrequency,'W')==0)
						{
							$msgt='Weekly';
						}
						$tableMsg.='<tr>
									<td>'.$childname.'</td>	
									<td>'.$lastname.'</td>
									<td>'.$age.'</td>	
									<td>'.$gender.'</td>	
									<td>'.$convertedDate.'</td>	
									<td>'.$convertedEndDate.'</td>
									<td>'.$msgt.'</td>	
									</tr>';
						
						$enrollachilds=array(
									'enrollid'=>$enrollId,
									'childname'=>$childname,
									'lastname'=>$lastname,
									'age'=>$age,
									'gender'=>$gender,
									'startdate'=>$convertedDate,
									'enddate'=>$convertedEndDate,
									'paymentfrequency'=>$paymentfrequency			
						);
						$this->enrolldetails->create();
						$this->enrolldetails->save($enrollachilds);
						unset($enrollachilds);
					}
					
					$tableMsg.='</table>';
					 
				   //$this->User->query('INSERT INTO `reserve`(`provider`, `user`, `created`,`seatname`,`seatvalue`) VALUES ("'.$this->request->data['provider'].'","'.$this->Auth->User('id').'","'.date('Y-m-d H:m:s').'","'.implode(',',$this->request->data['seatname']).'","'.implode(',',$this->request->data['seat']).'")');
				   $this->Session->setFlash('Your Reserve Request Successfully Sent.', 'default', ['class' => 'success1']);
				   $subject = 'Reserve a Spot Request';
				   //$userArray=array('name'=>$user['User']['name'],'username'=>$this->Auth->User('name'),'useremail'=>$this->Auth->User('email'));
				   //$message = 'Dear ' . $user['User']['name'] . ', <br><br>';
                     
$message = 'User: '.$user2['User']['name'].' has request for reserve spot.<br><br>';
					  
					  	$message.=$tableMsg."<br><br>";
                        $message .= 'Thanks<br>Cutienest';
				   $this->sendGeneralEmail($user['User']['email'], $subject, $message);
				   //$this->sendEmail($user['User']['email'], $subject, 'reserve','cutienest',$userArray);
				   return $this->redirect(['controller'=>'search','action' => 'detail/'.$this->request->data['provider']]);
				   
				   }
						catch(SocketException $e)
						{
							$this->Session->setFlash('Unable to save Reserve.', 'default', ['class' => 'error']);
						}
				} else {
					$this->Session->setFlash('Unable to save Reserve.', 'default', ['class' => 'error1']);
				}
		}
		
		public function sendMessage()
		{	
			$this->layout=false;
			$user = $this->User->findById($this->request->data['provider']);
			$subject = 'Message From User';
			$userArray=array('Name'=>$user['User']['name'],'UserName'=>$this->request->data['name'],'UserEmail'=>$this->request->data['email'],'UserComment'=>$this->request->data['comment']);
			
			$message ='Dear '. $user['User']['name'].',<br/>';
				
			$message .= 'User: '.$this->request->data['name'].' has request for Message.Here are the details:<br><br>';
			
			$message .= 'Name: '.$this->request->data['name']. '<br>';
			//$message .= 'Email: '.$this->request->data['email']. '<br>';
			$message .= 'Comment: '.$this->request->data['comment']. '<br><br>';
				
			$message .= 'Thanks<br>Cutienest';
			
            //if ($this->sendEmail($user['User']['email'], $subject, 'message','cutienest',$userArray)) {
				if ($this->sendGeneralEmail($user['User']['email'], $subject, $message)) {
                $this->Session->setFlash('Your Message successfully Sent, We will contact you soon', 'default', ['class' => 'success']);
            } else {
                $this->Session->setFlash('Your Message not sent to provider', 'default', ['class' => 'error']);
            }	
			return $this->redirect(['controller'=>'search','action' => 'detail/'.$this->request->data['provider']]);
		}
			public function bookTour()
			{	   
				$this->layout=false;	
				$user = $this->User->findById($this->request->data['provider']);
				
				$subject = 'Book a Tour';
				$userArray=array('Name'=>$user['User']['name'],'UserName'=>$this->request->data['name'],'UserEmail'=>$this->request->data['email'],'Bookdate'=>$this->request->data['book_date'],'UserComment'=>$this->request->data['comment']);
				$message ='Dear '. $user['User']['name'].',<br/>';
				
				$message .= 'User: '.$this->request->data['name'].' has request for Book a tour.Here are the details:<br><br>';
				
				$message .= 'Name: '.$this->request->data['name']. '<br>';
				//$message .= 'Email: '.$this->request->data['email']. '<br>';
				$message .= 'Bookdate: '.$this->request->data['book_date']. '<br>';
				$message .= 'BookTime: '.$this->request->data['book_time']. '<br>';
				$message .= 'Comment: '.$this->request->data['comment']. '<br><br>';
				
				
				$message .= 'Thanks<br>Cutienest';
				
            	//if ($this->sendEmail($user['User']['email'], $subject, 'bookatour','cutienest',$userArray)) {
            	if ($this->sendGeneralEmail($user['User']['email'], $subject, $message)) {
					
                $this->Session->setFlash('Your Message successfully Sent, We will contact you soon', 'default', ['class' => 'success1']);
            	} else {
                $this->Session->setFlash('Your Message not sent to provider', 'default', ['class' => 'error1']);
            	}
				return $this->redirect(['controller'=>'search','action' => 'detail/'.$this->request->data['provider']]);
			}
			public function createInvoice()
			{	   
					$customer = $this->User->query("select * from reserve  where provider='".$this->Auth->User('id')."' and status='1'");
					$provider = $this->User->query("select * from users  where id='".$this->Auth->User('id')."'");
					$this->set(compact('customer','provider'));
					if ($this->request->is(['post', 'put'])) {
						$this->request->data['provider']=$this->Auth->User('id');
						if ($this->Invoice->save($this->request->data)) {
					$user = $this->User->findById($this->request->data['user']);
					$subject = 'New Invoice';
					$userArray=array('Name'=>$user['User']['name'],'DueDate'=>$this->request->data['due_date'],'JoiningDate'=>$this->request->data['joining_date'],'Amount'=>$this->request->data['amount'],'EIN No.'=>$this->request->data['ein']);
					if ($this->sendEmail($user['User']['email'], $subject, 'invoice','cutienest',$userArray)) {
						$this->Session->setFlash('Invoice successfully Sent to User.', 'default', ['class' => 'success']);
						  }
									return $this->redirect(['controller'=>'users','action' => 'invoice']);
						}
					}
			}
			public function updateInvoice($id='')
			{	   
					$customer = $this->User->query("select * from reserve  where provider='".$this->Auth->User('id')."' and status='1'");
					$provider = $this->User->query("select * from users  where id='".$this->Auth->User('id')."'");
					$invoice_data  =	$this->User->query("select * from invoices  where id='".$id."'");
					$this->set(compact('customer','provider','invoice_data'));
					if ($this->request->is(['post', 'put'])) {
						$this->request->data['provider']=$this->Auth->User('id');
						$this->request->data['id']=$this->request->data['id'];
						if ($this->Invoice->save($this->request->data)) {
					$user = $this->User->findById($this->request->data['user']);
					$subject = 'Update Invoice';
					$userArray=array('Name'=>$user['User']['name'],'DueDate'=>$this->request->data['due_date'],'JoiningDate'=>$this->request->data['joining_date'],'Amount'=>$this->request->data['amount'],'EIN No.'=>$this->request->data['ein']);
					if ($this->sendEmail($user['User']['email'], $subject, 'invoice','cutienest',$userArray)) {
						$this->Session->setFlash('Updated Invoice successfully Sent to User.', 'default', ['class' => 'success']);
						  }
									return $this->redirect(['controller'=>'users','action' => 'invoice']);
						}
					}
			}
	
	
    		
			public function reserveProvider() 
			{
				$title = 'Reserved Provider | Cutienest';
				$this->set(compact('title'));
					if (!$this->User->isNotSuperAdmin()) {
						return $this->redirect(['controller' => 'admin','action' => 'index']);
					}
						$this->loadModel('enrollachilds');
					 	$user = $this->User->findById($this->Auth->User('id'));
						$enrollachilds = $this->enrollachilds->find('all',
										['conditions' => ['enrollachilds.user_id' =>$this->Auth->User('id')],
										'joins' => array(
        														array(
            														'table' => 'enrolldetails',
            														'alias' => 'enrolldetails',
            														'type' => 'INNER',
            														'conditions' => array(
                														'enrollachilds.id = enrolldetails.enrollid'
            																)
        											 				),
																	array(
            														'table' => 'users',
            														'alias' => 'users',
            														'type' => 'INNER',
            														'conditions' => array(
                														'enrollachilds.provider_id = users.id'
            																)
        											 				)
    															),
						 						'fields' => array('enrollachilds.*', 'enrolldetails.*','users.*'),
												'order' => 'users.id ASC'
												]);
												
												
					
						$data1 = $this->User->query("select * from users  where id=".$this->Auth->User('id'));
						//$data = $this->User->query("select * from reserve  where user=".$this->Auth->User('id'));	
						$this->set(compact('enrollachilds','data1'));
			}
	
	
			public function reserveChangestatus($user_id) 
	{
		 $this->layout=false;	
		if (!$this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'admin','action' => 'index']);
        }
		$data = $this->User->query("select * from reserve  where provider='".$this->Auth->User('id')."' and user='".$user_id."'");
			if(sizeof($data) == 0){
				 throw new NotFoundException(__('Invalid User'));
		}
       $this->User->query("UPDATE `reserve` SET  status='1' where provider='".$this->Auth->User('id')."' and user='".$user_id."'");
		return $this->redirect(['controller' => 'users','action' => 'reserveRequest']);	
    }
			public function reserveDelete($user_id)
   {
		 $this->layout=false;
		if (!$this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'admin','action' => 'index']);
        }
		 $data = $this->User->query("select * from reserve  where provider='".$this->Auth->User('id')."' and user='".$user_id."'");
		if(sizeof($data) == 0){
				 throw new NotFoundException(__('Invalid User'));
		}
       	$data = $this->User->query("delete  from reserve  where provider='".$this->Auth->User('id')."' and user='".$user_id."'");
		return $this->redirect(['controller' => 'users','action' => 'reserveRequest']);	
    }
		public function getjoiningdate($id)
	{
	$this->layout=false;	
	$data = $this->User->query("select created from reserve  where provider='".$this->Auth->User('id')."' and user='".$id."'");
	$date=explode(' ',$data[0]['reserve']['created']);
	echo $date[0];
	exit;
	}
	
	public function forgot_password($uuid = null)
    {
        $this->set('uuid', $uuid);
        if ($uuid) {
            $user = $this->User->find('first', [
                'conditions' => [
                    'User.uuid' => $uuid,
                ],
            ]);
            if (!empty($user)) {
                $this->set('showResetPassord', true);
            } else {
                if (!$this->request->is('post')) {
                    $error = 'Your link is not valid or expired';
                    $this->Session->setFlash($error, 'default', ['class' => 'error']);
                }
            }
        }
        if ($this->request->is('post')) {
            if (isset($this->request->data['User']['new_password'])) {
                // reset password
                if (empty($this->request->data['User']['new_password']) || empty($this->request->data['User']['confirm_password'])) {
                    $error = 'Please enter New Password and Confirm Password';
                    $this->Session->setFlash($error, 'default', ['class' => 'error']);
                } else if ($this->request->data['User']['new_password'] != $this->request->data['User']['confirm_password']) {
                    $error = 'New Password and Confirm Password does not match';
                    $this->Session->setFlash($error, 'default', ['class' => 'error']);
                } else {
                    $this->User->save([
                        'id' => $user['User']['id'],
                        'uuid' => '',
                        'password' => $this->request->data['User']['new_password'],
                    ], false);
                    $this->Session->setFlash('Password reset successfully', 'default', ['class' => 'success']);
                    $this->redirect(['action' => 'login']);
                }
            } else {
                $user = $this->User->find('first', ['conditions' => ['User.email' => $this->request->data['User']['email']]]);
                if (empty($this->request->data['User']['email']) || empty($user)) {
                    $error = 'Please enter registered valid email address';
                    $this->Session->setFlash($error, 'default', ['class' => 'error']);
                } else if (!empty($user)) {
                    if (!$user['User']['status']) {
                        $error = 'Your account is not active please contact to admin';
                        $this->Session->setFlash($error, 'default', ['class' => 'error']);
                    } else {
                        $uuid = md5($this->generate_password());
                        $this->User->save(['id' => $user['User']['id'], 'uuid' => $uuid], false);
                        $subject = 'Cutienest Forgot Password';
                        $message = 'Dear ' . $user['User']['name'] . ', <br><br> Please click to below link to reset your password <br><br>';
                        $message .= '<a href="' . Configure::read('SITE_URL') . 'users/forgot_password/' . $uuid . '">Click here to reset password</a><br><br>';
                        $message .= 'Thanks<br>Cutienest';
                        if ($this->sendGeneralEmail($user['User']['email'], $subject, $message)) {
                            $this->Session->setFlash('Forgot password email has been sent', 'default', ['class' => 'success']);
                        } else {
                            $this->Session->setFlash('Forgot password email was not sent', 'default', ['class' => 'error']);
                        }
                        $this->redirect(['action' => 'login']);
                    }
                }
            }
        }
    }
	 public function signup() {
		$title = 'Sign up | Cutienest';
			$this->set(compact('title'));
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));      
        }
        if ($this->request->is('post')) {
            if ($this->User->validates()) {
				$uuid = md5($this->generate_password());
				$this->request->data['User']['status']=1;
				$this->request->data['User']['verify']=0;
				$this->request->data['User']['admin_approve']=0;
				$this->request->data['User']['role']=2;
				$this->request->data['User']['provider_req']=0;
				$this->request->data['User']['uuid']=$uuid;
				$this->request->data['User']['username']=$this->request->data['User']['email'];     
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                        $subject = 'Cutienest Verify Email';
                        $message = 'Dear ' . $this->request->data['User']['name'] . ', <br><br> Please click to below link to verify email address <br><br>';
                        $message .= '<a href="' . Configure::read('SITE_URL') . 'users/verifyemail/' . $uuid . '">Click here to activate Account</a><br><br>';
                        $message .= 'Thanks<br>Cutienest';
                        if ($this->sendGeneralEmail($this->request->data['User']['email'], $subject, $message)) {
                            $this->Session->setFlash('Registration successful. Please verify your email address by clicking on activation link sent in your email account.', 'default', ['class' => 'success']);
                        } else {
                            $this->Session->setFlash('Registration Failed', 'default', ['class' => 'error']);
                        }
                        return $this->redirect(array('controller'=>'users','action'=>'login'));
                }
            }
		}
    } 
	 /* social login functionality */

    public function social_login($provider) {
		 if( $this->Hybridauth->connect($provider) ){
			 
            $this->_successfulHybridauth($provider,$this->Hybridauth->user_profile);
			if ($this->Auth->user('role') == 0) {
					$this->redirect(array('controller' => 'admin','action' => 'index'));
				}elseif($this->Auth->user('role') == 1 ){
	            	$this->redirect(array('controller' => 'users','action' => 'viewMyProfile'));
   				}
				elseif( $this->Auth->user('role') == 2)
				{
				    $this->redirect(array('controller' => 'users','action' => 'viewMyProfile'));
				}
			
			
			
			
        }else{
			
            // error
            $this->Session->setFlash($this->Hybridauth->error);
            $this->redirect($this->Auth->loginAction);
        } 
		
    }
    public function social_endpoint($provider) {
		
        $this->Hybridauth->processEndpoint();
    }
    private function _successfulHybridauth($provider, $incomingProfile){
		
        // #1 - check if user already authenticated using this provider before
        $this->SocialProfile->recursive = -1;
        $existingProfile = $this->SocialProfile->find('first', array(
            'conditions' => array('social_network_id' => $incomingProfile['SocialProfile']['social_network_id'], 'social_network_name' => $provider)
        ));
        if ($existingProfile) {
            // #2 - if an existing profile is available, then we set the user as connected and log them in
            $user = $this->User->find('first', array(
                'conditions' => array('id' => $existingProfile['SocialProfile']['user_id'])
            ));
			//echo $this->element('sql_dump');
			
          return  $this->_doSocialLogin($user,true);
        } else {
            // New profile.
			
            if ($this->Auth->loggedIn()) {
				
                // user is already logged-in , attach profile to logged in user.
                // create social profile linked to current user
                $incomingProfile['SocialProfile']['user_id'] = $this->Auth->user('id');
                $incomingProfile['SocialProfile']['role'] = '2';
                $this->SocialProfile->save($incomingProfile);
                $this->Session->setFlash('Your ' . $incomingProfile['SocialProfile']['social_network_name'] . ' account is now linked to your account.');
                $this->redirect($this->Auth->redirectUrl());
            } else {
                // no-one logged and no profile, must be a registration.
                $user = $this->User->createFromSocialProfile($incomingProfile);
                $incomingProfile['SocialProfile']['user_id'] = $user['User']['id'];
                $this->SocialProfile->save($incomingProfile);
                // log in with the newly created user
               return $this->_doSocialLogin($user);
            }
        }
    }
    private function _doSocialLogin($user, $returning = false) {
        if ($this->Auth->login($user['User'])) {
            if($returning){
               return $this->Session->setFlash(__('Welcome back, '. $this->Auth->user('username')));
            } else {
               return $this->Session->setFlash(__('Welcome to our community, '. $this->Auth->user('username')));
            }
            $this->redirect($this->Auth->loginRedirect);
        } else {
            return $this->Session->setFlash(__('Unknown Error could not verify the user: '. $this->Auth->user('username')));
        }
		
		
    }

		public function addReview()
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
                return $this->redirect(array('controller'=>'users','action'=>'detail/'.$this->request->data['Review']['provider']));
                }
            }
        }
	}
	   
	public function contact() 
	{
		
    }
	public function provider() 
	{
		$title = 'Register as provider | Cutienest';
			$this->set(compact('title'));
	   $admin = $this->User->findById(10);
       $user = $this->User->findById($this->Auth->User('id'));
	   $this->set('user', $user);
    }

 



}