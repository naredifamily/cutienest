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
                                                <th style="display: none;">Email</th>
                                                 <th>Created</th>
                                                <!-- <th>Phone</th> -->
												 <th>State</th>
												<th>Zip</th>
                                                <th>Licence No.</th>
                                                <th>Status</th>
                                                <th>Email Verified</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										 <?php
                                $i = 1;
                                foreach ($users as $user): ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><a href="<?=Configure::read('SITE_URL')?>admin/providerView/<?php echo $user['User']['id']; ?>">
                                                    <?php echo $user['User']['name']; ?>
                                                        </a>
                                                    </td>
                                                <td style="display: none;"><?php echo $user['User']['email']; ?></td>
                                                <td> <?php $createdDate=strtotime($user['User']['created']);
														echo date('m-d-Y',$createdDate);
												 ?></td>
                                                <!-- <td><?php echo $user['User']['phone']; ?></td> -->
												<td><?php echo  $this->Common->stateName($user['User']['state']); ?></td>
												<td><?php echo $user['User']['zip']; ?></td>
                                                <td>
												<?php if(strcmp($user['User']['licence_image'],'')==0)
												{?>
													<?php echo $user['User']['licenceno']; ?>
												<?php }
												else {?>
												<a href="<?=Configure::read('SITE_URL')?>/uploads/img/upload_folder/<?=$user['User']['licence_image'];?>" target="_blank"><?php echo $user['User']['licenceno']; } ?></a>
                                                </td>
                                                <td><?php if($user['User']['provider_req']=='1'){ echo "<span style='color: #c1c109;font-weight: 700;'>PENDING"; } if($user['User']['provider_req']=='3'){ echo "<span style='color: red;font-weight: 700;'>REJECTED"; } if($user['User']['provider_req']=='4'){ echo "<span style='color: blue;font-weight: 700;'>ON HOLD"; } if($user['User']['provider_req']=='5'){ echo "<span style='color: red;font-weight: 700;'>Deleted"; }?></td>
                                                <td><?php if($user['User']['verify']=='1'){ ?> <span style='color: #c1c109;font-weight: 700;'><i class="fa fa-check" aria-hidden="true"></i> </span><?php  } if($user['User']['verify']=='0'){ ?> <span style='color: red;font-weight: 700;'><i class="fa fa-times-circle"></i> </span><?php } ?>
												</td>
												<td>
                                                <select name="action" onchange="window.location='<?=Configure::read('SITE_URL')?>/admin/activateAccountProvider/<?php echo $user['User']['id']; ?>/'+this.value">
                                                <option>--Action--</option>
                                                <option value="2">Approve</option>
                                                <option value="3">Reject</option>
                                                
                                                </select>  
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
                                             
                        <!--                         <?php if( $user['User']['provider_req']=='1'){
													 
													 echo $this->Form->postLink($this->Html->tag('i', '', 
												array('class' => 'fa fa-check')). "",
												array('action' => 'activateAccountProvider', $user['User']['id']),
												array('escape'=>false),    
												__('Are you sure you want to Regsiter user as a provider # %s?', $user['User']['name']),
											   array('class' => 'btn btn-mini')
												); 
												 }
													  
													?>   -->
                                               
                
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