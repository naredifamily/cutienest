<?php
class ProvidersController extends AppController {
   	public $uses = ['Pricelist','User','Image','Page','Invoice','SocialProfile','Availability','Review','Admissionpack','Provider'];
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
		if (!$this->User->isProvider()) {
	
            return $this->redirect(['controller' => 'users','action' => 'viewMyProfile']);
        }
		$this->layout = 'provider';
 	}
	public function deleteaccount()
	{
		$this->loadModel('User');
		$this->User->id=$this->Auth->User('id');                
		$this->User->set(array('account_status'=>'deleted','status'=>'0','provider_req'=>5));                 
		$this->User->save();
		
		die;
	}
	public function rotateimage()
	{
		$this->loadModel('Profileimage');
		$filename=$_GET['filename'];
	    $filename=WWW_ROOT."uploads/gallery/".$filename;
		$type=mime_content_type($filename);
		$degrees = $_GET['rotate'];
		if(strcmp($type,'image/jpeg')==0)
		{
			
			$source = imagecreatefromjpeg($filename);
			$rotate = imagerotate($source, $degrees, 0);
			imagejpeg($rotate,$filename);
		}
		else if(strcmp($type,'image/png')==0)
		{
			$source = imagecreatefrompng($filename);
			$rotate = imagerotate($source, $degrees, 0);
			imagepng($rotate,$filename);
		}
		$this->Profileimage->id=$_GET['profileId'];
		$this->Profileimage->save(array('rotate'=>$degrees));
		die;
	}
	public function bankdetails()
	{
		$this->loadModel('userbankdetails');
		$user = $this->User->findById($this->Auth->User('id'));
		$userbankdetails = $this->userbankdetails->find('first',['conditions' => [
											'userbankdetails.user_id' => $this->Auth->User('id')
										]
									]);
		if ($this->request->is(['post', 'put'])) {
			$data=$this->request->data;
			if($userbankdetails)
			{
				$this->userbankdetails->id=$userbankdetails['userbankdetails']['id'];
				$BankDetails=array(
						'accountnumber'=>$data['userbankdetails']['accountnumber'],
						'accountname'=>$data['userbankdetails']['accountname'],
						'iban'=>$data['userbankdetails']['iban'],
						'swiftcode'=>$data['userbankdetails']['swift']
				);
			}
			else
			{
				$BankDetails=array(
						'user_id'=>$this->Auth->User('id'),
						'accountnumber'=>$data['userbankdetails']['accountnumber'],
						'accountname'=>$data['userbankdetails']['accountname'],
						'iban'=>$data['userbankdetails']['iban'],
						'swiftcode'=>$data['userbankdetails']['swift']
				);
			}
			$this->userbankdetails->save($BankDetails);
			return $this->redirect(['controller' => 'providers','action' => 'bankdetails']);
		}
		$this->set(compact('user','userbankdetails'));
	}
	public function detail($id) {
		if ($this->Auth->user('role') != 1) {
					$this->redirect(Configure::read('SITE_URL'));
				}
$this->loadModel('Profileimage');
$Profileimage = $this->Profileimage->find('first',['conditions' => ['user_id' =>$id]]);
	$data = $this->User->find('first',['conditions' => ['User.id' =>$id]]);
	$gallery = $this->Image->find('all',['conditions' => ['Image.user_id' =>$id]]);
	$reviews = $this->Review->find('all',['conditions' => ['Review.user_id' =>$id]]);
	
	$this->set(compact('data','gallery','reviews','Profileimage'));
	}
	public function reserveRequestAction()
	{
		if(isset($_GET['reserved_id']))
		{
			$this->loadModel('enrolldetails');
			$this->loadModel('Invoice');
			$this->loadModel('enrollachilds');
			$this->loadModel('User');
			
			$enrolldetails=$this->enrolldetails->find('first',['conditions' => [
											'enrolldetails.id' => $_GET['reserved_id']
										]
									]);
			$enrollachilds=$this->enrollachilds->find('first',['conditions' => [
											'enrollachilds.id' => $enrolldetails['enrolldetails']['enrollid']
										]
									]);
			$provider_id=$enrollachilds['enrollachilds']['provider_id'];
			$user_id=$enrollachilds['enrollachilds']['user_id'];					
			$user=$this->User->find('first',[
												'conditions'=> ['User.id' => $user_id]
											]);
			$userProvider=$this->User->find('first',[
												'conditions'=> ['User.id' => $provider_id]
											]);
			
			$this->enrolldetails->id = $_GET['reserved_id'];
			$this->enrolldetails->save(array('status'=>$_GET['type'],'amount'=>$_GET['amount']));
			$invoiceSave=array(
									'provider'=>$provider_id,
									'user'=>$user_id,
									'amount'=>$_GET['amount'],
									'invoice_no'=>'1000'.$_GET['reserved_id'],
									'created'=>date("Y-m-d h:i:sa"),
									'updated'=>date("Y-m-d h:i:sa"),
									'joining_date'=>date("Y-m-d h:i:sa"),
									'due_date'=>date("Y-m-d h:i:sa"),
									'status'=>0,
									'kids_name'=>$enrolldetails['enrolldetails']['childname'],
									'kids_lastname'=>$enrolldetails['enrolldetails']['lastname'],
									'ein'=>'',
									'enroll_child_details_id'=>$_GET['reserved_id']
									);
			$this->Invoice->save($invoiceSave);
			$subject='Your enrollment accepted';
			$message='Your enrollment has been accepted by the provider '.$userProvider['name'].". <a href='".Configure::read('SITE_URL')."users/login'>Pay now</a> to complete the enrollment process!<br>Don't forget to <a href='".Configure::read('SITE_URL')."users/login'>download the admission pack</a>, fill it and bring it to the provider before your child starts his days with your chosen provider.";
			$this->sendGeneralEmail($user['User']['email'], $subject, $message);
		}
		die;
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
			public function imageDelete($id)
    {
        if (!$this->Auth->user('id')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Image->delete($id)) {
            $this->Session->setFlash('Image deleted successfully', 'default', ['class' => 'success']);
        } else {
            $this->Session->setFlash('Image can\'t be deleted', 'default', ['class' => 'error']);
        }
        return $this->redirect(['action' => 'image']);
    }
	public function makeFeatureImg()
    {
       $this->layout=false;
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
		if(isset($this->request->data['isChecked'])&&$this->request->data['isChecked']=='Y'){
			$this->request->data['Image']['type'] = 'featured';
			}
			else{
			$this->request->data['Image']['type'] = 'gallery';
			}
			$this->request->data['Image']['id'] = $this->request->data['id'];
			if ($this->Image->save($this->request->data)) {
			}
			die;
    }
			public function image($id = null) {
		$title = 'Upload Photos | Cutienest';
		$this->set(compact('title'));
		$user = $this->User->findById($this->Auth->User('id'));
	    $data = $this->Image->find('all',['conditions' => ['Image.user_id' =>$this->Auth->User('id')]]);
        $this->set(compact('data','user'));
		
		  if ($this->request->is('post')) {
			
		            if (!empty($this->request->data['Image']['image'])) {
					foreach($this->request->data['Image']['image'] as $file_name)
					{
						$file = $file_name['name'];
						$ext = substr(strtolower(strrchr($file, '.')), 1);
						$arr_ext = ['jpg', 'jpeg', 'png'];
						if(in_array($ext,$arr_ext)){
							move_uploaded_file($file_name['tmp_name'], WWW_ROOT.'uploads/gallery/' . $file);
							$imagepath = $file;
							$target=WWW_ROOT.'uploads/gallery/' . $file;
							$save = WWW_ROOT.'uploads/gallery/thumb/' . $imagepath; //This is the new file you saving
							list($width, $height) = getimagesize($target);
							//echo 'width: '.$width.'<br/>';
							//echo 'height: '.$height.'<br/>';
							$modwidth = 870;
						    //echo 'modwidth: '.$modwidth.'<br/>';
						    //$diff = $width / $modwidth;
						    //echo 'diff: '.$diff.'<br/>';
						    // $modheight = $height / $diff;
						    $modheight =489;
						    //echo 'modheight: '.$modheight.'<br/>';
							if(strcmp($ext,'jpg')==0 || strcmp($ext,'jpeg')==0)
						{
						  $tn = imagecreatetruecolor($modwidth, $modheight) ;
						  $image = imagecreatefromjpeg($target) ;
						  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;
							
						  imagejpeg($tn, $save, 100) ;
						}
						else
						{
							 $tn = imagecreatetruecolor($modwidth, $modheight) ;
						  $image = imagecreatefrompng($target) ;
						  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

						  imagepng($tn, $save) ;
						}
						  //unlink($target); //Delete our uploaded file
						 //echo "Large image: &lt;img src='".$save."'&gt;&lt;br&gt;";
							//die;
							
							
							$this->request->data['Image']['path'] = $file;
							$this->request->data['Image']['type'] = 'gallery';
							$this->request->data['Image']['user_id'] = $this->Auth->User('id');
							$this->Image->create();
							if ($this->Image->save($this->request->data)) {
									
									$msg='Image Successfully Uploaded';
							}
						}
						else{
							$msg='File Extention Not Allowed';
							//$this->Session->setFlash('File Extention Not Allowed', 'default', ['class' => 'error']);
							
							}
							
						
					}
					$this->Session->setFlash($msg, 'default', ['class' => 'success']);
					return $this->redirect(array('action' => 'image'));
                }
		  }
	 }
			 public function availability() {
$title = 'Availability | Cutienest';
		$this->set(compact('title'));
	 if (!$this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'admin','action' => 'index']);
        }
		$user = $this->User->findById($this->Auth->User('id'));
       $data = $this->User->find('first',['fields' =>['availability','careof_weekend','careof_holiday'],'conditions' => ['User.id' =>$this->Auth->User('id')]]);
       $this->set('data',$data['User']['availability']);
	    $this->set('careof_weekend',$data['User']['careof_weekend']);
		 $this->set('careof_holiday',$data['User']['careof_holiday']);
		$this->set('user',$user);
	   if ($this->request->is('post')) {
		 if($this->request->data['type']=='Fullday')
		 	{
				  $this->User->updateAll(['User.availability' => "'available'"], ['User.id' => $this->Auth->User('id')]);
			}
		else{
 $availability=array();
					if(isset($this->request->data['agegroup']))
					{
				   for($i=0;$i<sizeof($this->request->data['agegroup']);$i++){
					   $fromdate_array=explode('-',$this->request->data['from'][$i]);
					   if(empty($this->request->data['to'][$i])){
						   $todate='12-31-2100';
						   $todate_array=explode('-',$todate);
					   }
					   else{
						 $todate_array=explode('-',$this->request->data['to'][$i]);  
					   }
		   $availability[$i]['agegroup']=$this->request->data['agegroup'][$i];
		   $availability[$i]['from']= $fromdate_array[2].'-'. $fromdate_array[0].'-'. $fromdate_array[1];
		   $availability[$i]['to']= $todate_array[2].'-'. $todate_array[0].'-'. $todate_array[1];
		   $availability[$i]['seat']=$this->request->data['seat'][$i];
		   $availability[$i]['provider']=$this->Auth->User('id');
			   }
			   }	   
$careof_weekend=isset($this->request->data['careof_weekend'])?$this->request->data['careof_weekend']:'0';
$careof_holiday=isset($this->request->data['careof_holiday'])?$this->request->data['careof_holiday']:'0';
	   	  $this->User->updateAll(['User.availability' => "'" .serialize($availability) . "'",'User.careof_weekend' => "'" . $careof_weekend. "'",'User.careof_holiday' => "'" .$careof_holiday . "'"], ['User.id' => $this->Auth->User('id')]);
			}
		   $this->Session->setFlash('Availability List Successfully Updated.', 'default', ['class' => 'success1']);
  		   $this->redirect(array('action' => 'availability'));
	   }}
			 public function schedule() {
$title = 'Schedule | Cutienest';
		$this->set(compact('title'));
		 if (!$this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'admin','action' => 'index']);
        }
	   $this->loadModel('User');
	   $user = $this->User->findById($this->Auth->User('id'));
       $data = $this->User->find('all',['conditions' => ['User.id' =>$this->Auth->User('id')]]);
       $this->set(compact('data','user'));
	   if ($this->request->is('post')) {
		   $fullday=isset($this->request->data['fullday'])?$this->request->data['fullday']:'0';
		   $halfday=isset($this->request->data['halfday'])?$this->request->data['halfday']:'0';
		   $fulldaytime_from=isset($this->request->data['fulldaytime_from'])?$this->request->data['fulldaytime_from']:'';
		   $fulldaytime_to=isset($this->request->data['fulldaytime_to'])?$this->request->data['fulldaytime_to']:'';
		   $halfdaytime_from=isset($this->request->data['halfdaytime_from'])?$this->request->data['halfdaytime_from']:'';
		   $halfdaytime_to=isset($this->request->data['halfdaytime_to'])?$this->request->data['halfdaytime_to']:'';
		   $fullday_text=isset($this->request->data['User']['fullday_text'])?$this->request->data['User']['fullday_text']:'';
		   $halfday_text=isset($this->request->data['User']['halfday_text'])?$this->request->data['User']['halfday_text']:'';
		   $this->User->updateAll(['User.fullday' => "'" . $fullday . "'"], ['User.id' => $this->Auth->User('id')]);
		   $this->User->updateAll(['User.halfday' => "'" . $halfday . "'"], ['User.id' => $this->Auth->User('id')]);
		   $this->User->updateAll(['User.fullday_text' => "'" . $fullday_text . "'"], ['User.id' => $this->Auth->User('id')]);
		   $this->User->updateAll(['User.halfday_text' => "'" . $halfday_text . "'"], ['User.id' => $this->Auth->User('id')]);
		   $this->User->updateAll(['User.fulldaytime_from' => "'" . $fulldaytime_from . "'"], ['User.id' => $this->Auth->User('id')]);
		   $this->User->updateAll(['User.fulldaytime_to' => "'" . $fulldaytime_to . "'"], ['User.id' => $this->Auth->User('id')]);
		   $this->User->updateAll(['User.halfdaytime_from' => "'" . $halfdaytime_from . "'"], ['User.id' => $this->Auth->User('id')]);
		   $this->User->updateAll(['User.halfdaytime_to' => "'" . $halfdaytime_to . "'"], ['User.id' => $this->Auth->User('id')]);
	  	   $this->Session->setFlash('Schedule Successfully Updated.', 'default', ['class' => 'success']);
  		   $this->redirect(array('action' => 'schedule'));
		   }
    }
			 public function pricelist() {
		$title = 'Price Sheet | Cutienest';
		$this->set(compact('title'));
		if (!$this->User->isNotSuperAdmin()) {
            return $this->redirect(['controller' => 'admin','action' => 'index']);
        }
		$user = $this->User->findById($this->Auth->User('id'));
       $data = $this->Pricelist->find('all',['conditions' => ['Pricelist.user_id' =>$this->Auth->User('id')]]);
	   $price_path = $this->User->query("select * from Pricelist  where user_id='".$this->Auth->User('id')."'");
	   
       $this->set(compact('data','user','price_path'));
	   if ($this->request->is('post')) {
		    $this->Pricelist->deleteAll(['user_id' => $this->Auth->User('id')]);
			if(!empty($this->request->data['agegroup'])){
	   for($i=0;$i<sizeof($this->request->data['agegroup']);$i++){
		   $priceListArray['Pricelist']['agegroup']=$this->request->data['agegroup'][$i];
		   $priceListArray['Pricelist']['timeslot']=$this->request->data['timeslot'][$i];
		   $priceListArray['Pricelist']['amount']=$this->request->data['amount'][$i];
		//   $priceListArray['Pricelist']['seat']=$this->request->data['seat'][$i];
		$priceListArray['Pricelist']['full_half']=$this->request->data['full_half'][$i];
		   $priceListArray['Pricelist']['user_id']=$this->Auth->User('id');
		   $this->Pricelist->query("INSERT INTO `pricelists`(`agegroup`, `timeslot`, `amount`, `user_id`,`full_half`) VALUES ('".$this->request->data['agegroup'][$i]."','".$this->request->data['timeslot'][$i]."','".$this->request->data['amount'][$i]."','".$this->Auth->User('id')."','".$this->request->data['full_half'][$i]."')");		 
		 }
			}
		  if (!empty($this->request->data['Pricelist']['image']['name'])) {
                    $file = $this->request->data['Pricelist']['image'];
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = ['jpg', 'jpeg', 'gif', 'png','bmp', 'tiff'];
					if(in_array($ext,$arr_ext)){
                        move_uploaded_file($file['tmp_name'], WWW_ROOT.'uploads/pricelist/' . $file['name']);
                        $this->request->data['Pricelist']['path'] = $file['name'];
						$this->request->data['Pricelist']['type'] = 'pricelist';
						$this->request->data['Pricelist']['user_id'] = $this->Auth->User('id');
               			$this->Pricelist->query("DELETE FROM `Pricelist` WHERE `user_id`='".$this->Auth->User('id')."'");
						
						$this->Pricelist->query("INSERT INTO `Pricelist`(`path`, `type`, `user_id`) VALUES ('".$this->request->data['Pricelist']['path']."','".$this->request->data['Pricelist']['type']."','".$this->request->data['Pricelist']['user_id']."')");
               			//$this->Pricelist->create();
						//if ($this->Pricelist->save($this->request->data)) {

								//$this->Session->setFlash('Profile Picture Successfully Uploaded', 'default', ['class' => 'success']);
								//return $this->redirect(array('action' => 'profilePicture'));
						//}
					}
					else{
						//$this->Session->setFlash('File Extention Not Allowed', 'default', ['class' => 'error']);
						//return $this->redirect(array('action' => 'profilePicture'));
						}
                }
		   $this->Session->setFlash('Price List Successfully Updated.', 'default', ['class' => 'success']);
  		   $this->redirect(array('action' => 'pricelist'));
	   }
    }
	 public function logout() {
		$this->Hybridauth->logout();
        $this->redirect($this->Auth->logout());
    }
	public function updateProviderProfile() {
$title = 'Update Profile | Cutienest';
		$this->set(compact('title'));
       $user = $this->User->findById($this->Auth->User('id'));
	   $this->set('user', $user);
        if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Profile Successfully Updated.', 'default', ['class' => 'success']);
                return $this->redirect(array('controller'=>'users','action'=>'updateProviderProfile'));
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
       		$user = $this->User->findById($this->Auth->User('id'));
			$invoices = $this->Invoice->find('all',['conditions' => ['Invoice.provider' =>$this->Auth->User('id')]]);
			$providerArray=array();
      		 foreach($invoices as $inv)
       		{
       			array_push($providerArray, $inv['Invoice']['user']);
       		}
       		$data = $this->User->query("select * from reviews  where user_id='".$this->Auth->User('id')."'");
       
	   $this->set(compact('invoices','user','data','providerArray','Profileimage'));
    }
	
	
public function deletepack($id){
	  if ($this->request->is('get')) {
		         	$data = $this->User->query("delete  from admissionpacks  where user_id='".$this->Auth->User('id')."' and id='".$id."'");
	  	   $this->Session->setFlash('File Successfully Deleted.', 'default', ['class' => 'success']);
		return $this->redirect(['controller' => 'users','action' => 'admissionpack']);	
	  }
}
public function about(){

		$title = 'Update about us | Cutienest';
		$this->set(compact('title'));
        if ($this->request->is(['post', 'put'])) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('About Us updated successfully', 'default', ['class' => 'success']);
                return $this->redirect(['action' => 'about']);
            } else {
                $this->Session->setFlash('Unable to update abou us.', 'default', ['class' => 'error']);
            }
    	    } else {
			$content = $this->User->find('first',['conditions' => ['User.id' =>$this->Auth->User('id')]]);
			$this->set(compact('content'));
      	  }
		$user = $this->User->findById($this->Auth->User('id'));
		$this->set(compact('user'));
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
	public function addReview()
	{
		   if ($this->request->is('post')) {
            if ($this->Review->validates()) {
				$this->request->data['Review']['provider']=$this->Auth->User('id');
                if ($this->Review->save($this->request->data)) {
				$total = $this->Review->query("select `id` from reviews  where user_id='".$this->request->data['Review']['user_id']."'");
				$sum = $this->Review->query("select sum(rating) from reviews  where user_id='".$this->request->data['Review']['user_id']."'");
				$avg_rating=reset($sum)[0]['sum(rating)']/sizeof($total);
				$this->Review->query("update users set rating='".number_format($avg_rating,2)."'  where id='".$this->request->data['Review']['user_id']."'");
                $this->Session->setFlash('You has been successfully Review  Provider.', 'default', ['class' => 'success']);
                return $this->redirect(array('controller'=>'providers','action'=>'detail/'.$this->request->data['Review']['provider']));
                }
            }
        }
	}
		public function reserveRequest() 
			{
				$title = 'Reserved Users | Cutienest';
				$this->set(compact('title'));
					if (!$this->User->isNotSuperAdmin()) {
						return $this->redirect(['controller' => 'admin','action' => 'index']);
					}
					$this->loadModel('enrollachilds');
					$this->loadModel('enrolldetails');
					$this->loadModel('User');
					$arrayfinalReserved=array();
					$options=array(             
        );
					$allUserReserved=$this->enrollachilds->find('all', array(
    					'conditions' => array('enrollachilds.provider_id' => $this->Auth->User('id')),
						'joins' => array(
        								array(
            								'table' => 'enrolldetails',
            								'alias' => 'enrolldetails',
            								'type' => 'INNER',
            								'conditions' => array(
                							'enrolldetails.enrollid = enrollachilds.id'
            								)
        								),
										array(
											'table' => 'users',
            								'alias' => 'users',
            								'type' => 'INNER',
            								'conditions' => array(
                							'enrollachilds.user_id = users.id'
												)
											
        								)
    						),
						 'fields' => array('enrolldetails.*', 'enrollachilds.*','users.*'),
						'order' => 'enrolldetails.status DESC, users.name ASC'
					));
					
					
					  
						$data1 = $this->User->query("select * from users  where id=".$this->Auth->User('id'));
						//$data = $this->User->query("select * from reserve  where provider=".$this->Auth->User('id'));	
						$this->set(compact('allUserReserved','data1'));
			}
			
	public function admissionpack(){
		$title = 'Admission Pack | Cutienest';
		$this->set(compact('title'));
		       $data = $this->Admissionpack->find('all',['conditions' => ['Admissionpack.user_id' =>$this->Auth->User('id')]]);
			   $user = $this->User->findById($this->Auth->User('id'));
		   	   $this->set(compact('data','user'));
		  if ($this->request->is('post')) {
		            if (!empty($this->request->data['Admissionpack']['file']['name'])) {
                    $file = $this->request->data['Admissionpack']['file'];
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = ['pdf','doc','dot','wbk','docx', 'ppt', 'rtf'];
					
					if(in_array($ext,$arr_ext)){
                        move_uploaded_file($file['tmp_name'], WWW_ROOT.'uploads/admissionpack/' . $file['name']);
                        $this->request->data['Admissionpack']['path'] = $file['name'];
						$this->request->data['Admissionpack']['type'] = 'admissionpack';
						$this->request->data['Admissionpack']['user_id'] = $this->Auth->User('id');
						unset($this->request->data['Admissionpack']['file']);
               			$this->Admissionpack->create();
						if ($this->Admissionpack->save($this->request->data)) {
								$this->Session->setFlash('File Successfully Uploaded', 'default', ['class' => 'success']);
								return $this->redirect(array('action' => 'admissionpack'));
						}
					}
					else{
						$this->Session->setFlash('File Extention Not Allowed', 'default', ['class' => 'error']);
						return $this->redirect(array('action' => 'admissionpack'));
						}
                }
		  }
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
						$this->request->data['Profileimage']['rotate']=0;
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
	
}