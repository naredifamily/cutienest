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







App::uses('Controller', 'Controller');







/**



 * Application Controller



 *



 * Add your application-wide methods in the class below, your controllers



 * will inherit them.



 *



 * @package		app.Controller



 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller



 */



class AppController extends Controller {



	



	



	



	/*public $components = array(



    'DebugKit.Toolbar',



    'Session',



    'Auth' => array(



        'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),



        'authError' => 'You must be logged in to view this page.',



        'loginError' => 'Invalid Username or Password entered, please try again.'



 



    ));*/



	



 



 public $components = [



        'Session',



        'RequestHandler',



        /* add Auth component and set the urls that will be loaded after the login and logout actions is performed */



        'Auth' => [



            'authenticate' => [



                'Form' => [



                    // Allow users to login only when they have status 1



                    'scope' => ['User.status' => 1]



                ]



            ]



        ]



    ];



 



 



		 public function beforeFilter()



	{



        parent::beforeFilter();



		$this->Auth->allow('login','display','signin','signup','detail','forgot_password','verifyemail','social_login','social_endpoint','fblogin', 'fb_login', 'google_login', 'googlelogin', 'register', 'forget_password','latest', 'check_email', 'check_email_exists', 'check_password','reverify','contact','provider');



		$this -> set('uuid', $this->Auth->user('uuid')); 



	}



	/*function _setErrorLayout() {



    if ($this->name == 'CakeError') { 



        $this->layout = '404';



    }



	}



function beforeRender () {



    $this->_setErrorLayout();



}*/







/*public function beforeRender() {



    $this->set('fb_login_url', $this->Facebook->getLoginUrl(array('redirect_uri' => Router::url(array('controller' => 'users', 'action' => 'login'), true))));



    $this->set('user', $this->Auth->user());



}*/














    function getAdminOption($option)
    {
        $this->loadModel('Option');
        $adminEmail=$this->Option->find('first',['conditions' => ['option_key' =>$option]]);
        return $adminEmail['Option']['option_value'];
    }
    function updateAdminOption($option,$value)
    {
        $this->loadModel('Option');
        $this->Option->updateAll(array('option_value'=>$value),['conditions' => ['option_key' =>$option]]);
 	}
    function sendEmail($to, $subject,$template_view,$template_layout,$userDataArr)
    {
    App::uses('CakeEmail', 'Network/Email');
    $Email = new CakeEmail('smtp');
	$Email->emailFormat('html');
    $Email->viewVars(compact('userDataArr'));
    $Email->template($template_view,null);
    
    $Email->from('no-reply@cutienest.com');
	$Email->subject($subject);

    try {
    $Email->to('naredid@gmail.com');
	return $Email->send();
    }catch(SocketException $e) {
        return 0;
    }

    }



		function generate_password($length = 8)



    {



        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*?";



        return substr(str_shuffle($chars), 0, $length);



    }



	    function sendGeneralEmail($to, $subject, $message)
    {
        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail();

        $Email->to($to);
        $Email->emailFormat('html');
        $Email->from('no-reply@cutienest.com');
        $Email->subject($subject);
		//$Email->viewVars(compact('html'));
		//$Email->template('welcome')->viewVars( array('Name'=>"Hi this is a mail from cakePHP"));
         
        return $Email->send($message);
   }



		public function isAuthorized($user) {



		// Here is where we should verify the role and give access based on role



		



		return true;



	}



}



