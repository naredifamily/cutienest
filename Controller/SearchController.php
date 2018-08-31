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
class SearchController extends AppController {
		public $uses = ['User','Search','Image','Review','Admissionpack'];
	    public $components = ['Paginator'];

   

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index'); 
}



	public function latest($zip='') {
	if ($this->request->is('get')) {
	if($zip){
		$sql = "SELECT * FROM users where zip  = '".$zip."' and role='1' and provider_req='2' and verify = '1'  order by rand() desc limit 0,3";
$provider = $this->User->query($sql);
$sizeofarr=sizeof($provider);
if($sizeofarr<3){
	$remaining=3-$sizeofarr;
					$another = "SELECT * FROM users where  status='1' and role='1' and provider_req='2' and verify = '1'  order by rand()  limit 0,".$remaining;
$another_arr = $this->User->query($another);
$provider=array_merge($provider,$another_arr);
}
//$this->set(compact('users'));
		//$provider = $this->User->find('all', ['conditions' => ['User.zip' => $zip,'User.status' => 1]],['limit' => 3]);
		}
		else
		{
					$sql = "SELECT * FROM users where  status='1' and  role='1' and provider_req='2' and verify = '1'  order by rand() desc limit 0,3";
$provider = $this->User->query($sql);


		//$provider = $this->User->find('all', ['conditions' => ['User.status' => 1]],['order' => 'rand()'],['limit' => 3]);
			
		}

        $this->set('providers', $provider);
		
		}
	}




	public function index() {
$title = 'Search | Cutienest';
		$this->set(compact('title'));

	if ($this->request->is('get')) {
		
		
		/*get record from date range*/
		$userId='';
		$id_array=array();
		 $usersList = [];
		if(!empty($this->request->query['from'])&&!empty($this->request->query['to']))
		{
				
				
				
				
			
		 $users = $this->User->find('all', ['conditions' => ['role' => 1,'status' => 1, 'provider_req'=>'2' ,'verify' => '1']]);
        if (!empty($users)) {
           
            $i = 0;
            foreach ($users as $user) {
				
				if($user['User']['availability']=='available'||empty($user['User']['availability']))
				{
					
				 array_push($usersList,$user['User']['id']);	
				}
				else
				{
                $availabilityData = unserialize($user['User']['availability']);
				$k=0;
				foreach( $availabilityData as $list){
					
					if(($this->request->query['from']>= $list['from'])&&($this->request->query['to']<= $list['to']))
						{
						
					 array_push($usersList,$user['User']['id']);	
							
						}
					
					$k++;
				}
				
				}
            
			
			}
        }
		$userId=array('User.id' => $usersList);
		//$isavailable='';
		}
		else{
			
			
		//	$isavailable=array('User.availability' => 'available');
			
			
			
			}
		
		
		
		
		
		
		
		
		
		
		
		if(!empty($this->request->query['agegroup']))
		{
		$agegroup = array('Pricelist.agegroup' => $this->request->query['agegroup']);
			
		}
		else
		{
		$agegroup=array();	
			
		}
		
		if(!empty( $this->request->query['zip']))
		{
		$zip = array('User.zip' =>  $this->request->query['zip']);
			
		}
		else
		{
		$zip=array();	
			
		}
		
		if(!empty( $this->request->query['daytype'])){
			if($this->request->query['daytype']=='F'){
			$daytype = array('User.fullday' =>  1);
				
			}
			if($this->request->query['daytype']=='H'){
			$daytype = array('User.halfday' =>  1);
				
			}
		}
		else{
		$daytype=array();	
		}
			if(isset($this->request->query['sort'])&&$this->request->query['sort']=='rating'){
				
			$sortarray=	'User.rating '.$this->request->query['dir'];
			
			
			
			}
			else if(isset($this->request->query['sort'])&&$this->request->query['sort']=='distance'){
				
			$sortarray=	'User.distance '.$this->request->query['dir'];
		
			
			
			
			}
			else{
	
				
					
			$sortarray=	'User.created desc';
				
				
				}
			
				
				if(!empty($this->request->query['long'])&&!empty($this->request->query['lati'])){
		$this->Paginator->settings = 	array( 'fields' => array('*','SQRT(
    POW(69.1 * (User.lat - '.$this->request->query['lati'].'), 2) +
    POW(69.1 * ('.$this->request->query['long'].' - User.long) * COS(User.lat / 57.3), 2)) AS distance'),
		'conditions' => array(array('User.role' => 1),array('User.status' => 1),array('User.provider_req' => 2),array('User.verify' => 1),$zip,$agegroup,$daytype,$userId),
			'joins' => array(
				array(
					'alias' => 'Pricelist',
					'table' => 'pricelists',
					'type' => 'LEFT',
					'conditions' => '`User`.`id` = `Pricelist`.`user_id`'
					 )
			 ),
			'limit' => 6,
			'order' =>$sortarray,
			 'group' => '`User`.`id`',
		);
		
				}
			else{
				
				
					$this->Paginator->settings = 	array( 'fields' => array('*'),
		'conditions' => array(array('User.role' => 1),array('User.status' => 1),array('User.provider_req' => 2),array('User.verify' => 1),$zip,$agegroup,$daytype,$userId), 
			'joins' => array(
				array(
					'alias' => 'Pricelist',
					'table' => 'pricelists',
					'type' => 'LEFT',
					'conditions' => '`User`.`id` = `Pricelist`.`user_id`'
					 )
			 ),
			'limit' => 6,
			'order' =>$sortarray,
			 'group' => '`User`.`id`',
		);
				
				
				
				}
				
				
				
				
				
				
        $data = $this->Paginator->paginate('User');
        $this->set('providers', $data);
		$this->set('zip', @$this->request->query['zip']);
		}
	}
	
	
	public function detail($id) {
			$this->loadModel('Profileimage');
		 $download = $this->Admissionpack->find('all',['conditions' => ['Admissionpack.user_id' =>$id]]);
		   $this->set('download',$download);
		    $Profileimage = $this->Profileimage->find('first',['conditions' => ['user_id' =>$id]]);
	$data = $this->User->find('first',['conditions' => ['User.id' =>$id]]);
	$gallery = $this->Image->find('all',['conditions' => ['Image.user_id' =>$id]]);
	$reviews = $this->Review->find('all',['conditions' => ['Review.provider' =>$id]]);
	$title = ucfirst($data['User']['name']).' Profile | Cutienest';
	
	$this->set(compact('title'));
	$this->set(compact('data','gallery','reviews','Profileimage'));
	}
	
	}
