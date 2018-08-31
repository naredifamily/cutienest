<?php

App::uses('Helper', 'View');

class CommonHelper extends AppHelper
{
    public function flipdate($dates)
    {
        $arr = explode(' ', $dates);
        $arr = explode('-', $arr[0]);

        return $arr[2] . '-' . $arr[1] . '-' . $arr[0];
    }

    public function isLoggedIn()
    {
        return CakeSession::read('Auth.User.id') ? true : false;
    }

    public function login_userid()
    {
        return CakeSession::read('Auth.User.id') ? true : false;
    }
 	public function loginUserId()
    {
        return CakeSession::read('Auth.User.id') ? CakeSession::read('Auth.User.id') : false;
    }
    public function role()
    {
        return CakeSession::read('Auth.User.role');
    }
	public function userEmail()
    {
        return CakeSession::read('Auth.User.email');
    }
    public function username()
    {
        return CakeSession::read('Auth.User.name');
    }
	 public function userState()
    {
	
        return CakeSession::read('Auth.User.state');
    }
	
	public function state_id()
    {
       
		$id=CakeSession::read('Auth.User.id');
		App::import('Model', 'User');
        $this->User = new User();
        $name = $this->User->find('first', ['fields' => 'state_id', 'conditions' => ['User.id' => $id]]);

        return $name['User']['state_id'];
    }
	
	    public function getState()
    {	
	  App::import('Model', 'State');
      $this->State = new State();
	  $state = $this->State->find('list',array('fields'=>array('stateName')));

        return $state;
    }
	    public function stateName($id)
    {
        App::import('Model', 'State');
        $this->State = new State();
        $name = $this->State->find('first', ['fields' => 'stateName', 'conditions' => ['State.id' => $id]]);

        return !empty($name['State']['stateName']) ? $name['State']['stateName'] : null;
    }
		    public function isProviderRequestSent()
    {
		
        App::import('Model', 'User');
        $this->User = new User();
        $name = $this->User->find('all', ['fields' => 'provider_req', 'conditions' => ['User.id' => CakeSession::read('Auth.User.id')]]);
		
        return $name[0]['User']['provider_req'];
    }

	     public function getUserName($id)
    {
        App::import('Model', 'User');
        $this->User = new User();
        $name = $this->User->find('first', ['fields' => 'name', 'conditions' => ['User.id' => $id]]);

        return !empty($name['User']['name']) ? $name['User']['name'] : null;
    }
		 public function getUserRating($id)
    {
        App::import('Model', 'User');
        $this->User = new User();
        $name = $this->User->find('first', ['fields' => 'rating', 'conditions' => ['User.id' => $id]]);

        return !empty($name['User']['rating']) ? $name['User']['rating'] : null;
    }
	   public function featuredImages($id)
    {
        App::import('Model', 'Image');
        $this->Image = new Image();
        $img = $this->Image->find('all', ['fields' => 'path', 'conditions' => ['Image.user_id' => $id,'Image.type' => 'featured']]);

        return !empty($img) ? $img : null;
    }
   		public function isReserved($provider)
	{
		App::import('Model', 'User');
        $this->User = new User();
		$total_reserved=$this->User->query('select * from reserve where provider="'.$provider.'" and user="'.CakeSession::read('Auth.User.id').'"');
   		return sizeof($total_reserved);
   }
   public function isReservedByProvider($user)
	{
		App::import('Model', 'User');
        $this->User = new User();
		$total_reserved=$this->User->query('select * from enrollachilds INNER JOIN enrolldetails ON enrollachilds.id=enrolldetails.enrollid where enrollachilds.provider_id="'.CakeSession::read('Auth.User.id').'" and enrollachilds.user_id="'.$user.'" and enrolldetails.status LIKE "1"');
		//print_r($total_reserved);
   		return sizeof($total_reserved)?true:false;
   }
   
   
   public function homePageProvider($zip='')
	{
		App::import('Model', 'User');
        $this->User = new User();
		if($zip){
		$provider = $this->User->find('all', ['conditions' => ['User.zip' => $zip,'User.status' => 1]],['limit' => 3]);
		}
		else
		{
			
		$provider = $this->User->find('all', ['conditions' => ['User.zip' => $zip,'User.status' => 1]],['order' => 'rand()'],['limit' => 3]);
			
		}
		
		
   		return $provider;
   }  
   
   
   
      	public function isReviews($provider)
	{
		App::import('Model', 'User');
        $this->User = new User();
		$total_reserved=$this->User->query('select * from reviews where provider="'.$provider.'" and user_id="'.CakeSession::read('Auth.User.id').'"');
   	
		return sizeof($total_reserved)?true:false;
   }
   		public function isReviewsByProvider($User_id,$provider_id)
		{
			
		App::import('Model', 'User');
        $this->User = new User();
		//echo 'select * from reviews where provider="'.$provider_id.'" and user_id="'.$User_id.'"';
		$total_reserved=$this->User->query('select * from reviews where provider="'.$provider_id.'" and user_id="'.$User_id.'"');
   	
		
		return sizeof($total_reserved)?true:false;

		}
   		public function hasUserProvider($provider_id)
   {
		App::import('Model', 'User');
        $this->User = new User();
		if($provider_id==CakeSession::read('Auth.User.id'))
		{
			return false;
		}
		$total_reserved=$this->User->query('select * from enrollachilds INNER JOIN enrolldetails ON enrollachilds.id=enrolldetails.enrollid where enrollachilds.provider_id="'.$provider_id.'" and enrollachilds.user_id="'.CakeSession::read('Auth.User.id').'" and enrolldetails.status LIKE "1"');
   		return sizeof($total_reserved)?false:true;
   }
   		public function distance($lat1, $lon1, $lat2, $lon2, $unit)
		{
			echo 'lat1: '.$lat1.'<br/>';
			echo 'lon1: '.$lon1.'<br/>';
			echo 'lat2: '.$lat2.'<br/>';
			echo 'lon2: '.$lon2.'<br/>';
			echo 'unit: '.$unit.'<br/>';
		die;
		  $theta = $lon1 - $lon2;
		  $dist = sin(floatval($lat1)) * sin(floatval($lat2)) +  cos(floatval($lat1)) * cos(floatval($lat2)) * cos(floatval($theta));
		  $dist = acos($dist);
		  $dist = rad2deg($dist);
		  $miles = $dist * 60 * 1.1515;
		  $unit = strtoupper($unit);
		
		  if ($unit == "K") {
			return number_format(($miles * 1.609344),2);
		  } else if ($unit == "N") {
			  return number_format(($miles * 0.8684),2);
			} else {
				return number_format($miles,2);
			  }
		}
}
