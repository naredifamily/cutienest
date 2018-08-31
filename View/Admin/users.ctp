 <div class="page-wrapper">
 <div class="container-fluid">
<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Users</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo Configure::read('ADMIN_URL') ?>userAdd" class="btn pull-right hidden-sm-down btn-success"> + Add User</a>
                    </div>
                </div>
<div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                              
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                 <th>Created</th>
                                                <th>Phone</th>
												 <th>State</th>
												<th>Zip</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										 <?php
                                $i = 1;
                                foreach ($users as $user): ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?php echo $user['User']['name']; ?></td>
                                                <td><?php echo $user['User']['email']; ?></td>
                                                <td> <?php $createdDate=strtotime($user['User']['created']);
														echo date('m-d-Y',$createdDate);
												 ?></td>
                                                <td><?php echo $user['User']['phone']; ?></td>
												<td><?php echo  $this->Common->stateName($user['User']['state']); ?></td>
												<td><?php echo $user['User']['zip']; ?></td>
												<td>
                                               <?php
                                                
                                              echo $this->Form->postLink($this->Html->tag('i', '', 
												array('class' => 'fa fa-edit')). "",
												array('action' => 'userEdit', $user['User']['id']),
												array( 'title' => 'Edit',
        												  'class'  => 'tooltip','escape'=>false)    
												); 
												?>
                                                
                                                
                                                |
                                                 <?php if( $user['User']['status']=='1'){
													 
													 echo $this->Form->postLink($this->Html->tag('i', '', 
												array('class' => 'fa fa-times-circle')). "",
												array('action' => 'activateAccount', $user['User']['id']),
												array( 'title' => 'Deactivate',
        												  'class'  => 'tooltip','escape'=>false),    
												__('Are you sure you want Deactivate # %s?', $user['User']['name']),
											   array('class' => 'btn btn-mini')
												); 
												 }
													  
													 else{
												 echo $this->Form->postLink($this->Html->tag('i', '', 
												array('class' => 'fa fa-check')). "",
												array('action' => 'activateAccount', $user['User']['id']),
												array( 'title' => 'Activate',
        												  'class'  => 'tooltip','escape'=>false),    
												__('Are you sure you want to Activate # %s?', $user['User']['name']),
											   array('class' => 'btn btn-mini')
												); 		  
													 }?>   
                                                |
                                               <?php
                                                
                                              echo $this->Form->postLink($this->Html->tag('i', '', 
												array('class' => 'fa fa-trash-o')). "",
												array('action' => 'userDelete', $user['User']['id']),
												array( 'title' => 'Delete',
        												  'class'  => 'tooltip','escape'=>false),
												__('Are you sure you want to delete # %s?', $user['User']['name']),
											   array('class' => 'btn btn-mini')
												); 
												?>
                
        </td>
                                            </tr>
                                           <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="pagination">
                   <?php if($this->Paginator->hasPrev()){?>               
                    <?php echo $this->Paginator->prev('«'); ?>
                    <?php }?>
                    <?php echo $this->Paginator->numbers(array('separator' => '')); ?>
                    <?php if($this->Paginator->hasNext()){?>
                    <?php echo $this->Paginator->next('»'); ?>
                    <?php }?>
                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</div></div>