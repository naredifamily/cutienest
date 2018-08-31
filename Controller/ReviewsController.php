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
class ReviewsController extends AppController 
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
			public function reviewedit()
	{
		
		   if ($this->request->is('post')) {
            if ($this->Review->validates()) {
				$this->request->data['Review']['user_id']=$this->Auth->User('id');
                if ($this->Review->save($this->request->data)) {
				$total = $this->Review->query("select `id` from reviews  where provider='".$this->request->data['Review']['provider']."'");

				$sum = $this->Review->query("select sum(rating) from reviews  where provider='".$this->request->data['Review']['provider']."'");
				$avg_rating=reset($sum)[0]['sum(rating)']/sizeof($total);
				$this->Review->query("update users set rating='".number_format($avg_rating,2)."'  where id='".$this->request->data['Review']['provider']."'");
                $this->Session->setFlash('Review and rating successfully updated.', 'default', ['class' => 'success']);
                return $this->redirect(array('controller'=>'users','action'=>'reviewsRating'));

                }
            }
        }
		
	}
	
}
