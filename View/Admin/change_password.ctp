 <div class="page-wrapper">
 <div class="container-fluid">
<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Change Password</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                
                </div>
<div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                              
                                <div class="table-responsive">
                                    <div class="register_form_inner">

                        <?php echo $this->Form->create('User'); ?>
 <div class="form-group">
<label class="col-md-12">Admin Email</label>
<div class="col-md-12">
<?php echo $this->Form->input('adminEmail', ['required' => true,'disabled'=>'disabled','value'=>$adminEmail,'class' => 'form-control form-control-line', 'label' => false]); ?>
  </div>
</div>
<div class="form-group">
<label class="col-md-12">Old Password<span class="__required">*</span></label>
<div class="col-md-12">
<?php echo $this->Form->password('old_password', ['required' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
  </div>
</div>
   <div class="form-group">
<label class="col-md-12">New Password<span class="__required">*</span></label>
<div class="col-md-12">
<?php echo $this->Form->password('new_password', ['required' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
  </div>
</div>                                 
   <div class="form-group">
<label class="col-md-12">Confirm Password<span class="__required">*</span></label>
<div class="col-md-12">
<?php echo $this->Form->password('confirm_password', ['required' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
  </div>
</div>


     <div class="form-group">
<div class="col-md-12">
 <?php echo $this->Form->input('SUBMIT', ['type' => 'submit','class'=>'btn btn-success','label' => false]); ?>  </div>
</div>                               
                                    
                                    

						
                           
<?php echo $this->Form->end(); ?>
</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				</div></div>