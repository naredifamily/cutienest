 <div class="page-wrapper">
 <div class="container-fluid">
<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Pages</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">Pages</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="<?php echo Configure::read('ADMIN_URL') ?>pageAdd" class="btn pull-right hidden-sm-down btn-success"> + Add Page</a>
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
                                                <th>Title</th>
                                                 <th>Url</th>
                                               	<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										 <?php
                                $i = 1;
                                foreach ($pages as $page): ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?php echo $page['Page']['title']; ?></td>
                                                 <td><?php echo $page['Page']['slug']; ?></td>
                                              
												<td>
                                               <?php
                                                
                                              echo $this->Form->postLink($this->Html->tag('i', '', 
												array('class' => 'fa fa-edit')). "",
												array('action' => 'pageEdit', $page['Page']['id']),
												array( 'title' => 'Edit',
        												  'class'  => 'tooltip','escape'=>false)    
												); 
												?>
                                                
                                                
                                               <?php /*?> |
                                                 
                                               <?php
                                                
                                              echo $this->Form->postLink($this->Html->tag('i', '', 
												array('class' => 'fa fa-trash-o')). "",
												array('action' => 'pageDelete', $page['Page']['id']),
												array('escape'=>false),
												__('Are you sure you want to delete # %s?', $page['Page']['title']),
											   array('class' => 'btn btn-mini')
												); 
												?><?php */?>
                
        </td>
                                            </tr>
                                           <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</div></div>