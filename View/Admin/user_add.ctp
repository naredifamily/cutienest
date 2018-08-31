<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">User</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Add User</li>
                        </ol>
                    </div>
                   
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
              
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                               
                                <?php $states=$this->Common->getState();?>

 <?php echo $this->Form->create('User',array('class'=>'form-horizontal form-material')); ?>
 
 
 
 <div class="form-group">
 <label class="col-md-12">Full Name<span class="__required">*</span></label>
<div class="col-md-12"><?php echo $this->Form->input('name', ['required' => true,'class' => 'form-control form-control-line', 'label' => false]); ?>
	 </div>
 </div>
                                        
<div class="form-group">
<label class="col-md-12">Phone<span class="__required">*</span></label>
<div class="col-md-12"><?php echo $this->Form->input('phone', ['required' => true,'class' => 'form-control form-control-line',  'label' => false]); ?>
	</div>
</div>
<div class="form-group">
 <label class="col-md-12">Email<span class="__required">*</span></label>
 <div class="col-md-12"><?php echo $this->Form->input('email', ['required' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
 	</div>
 </div>
<div class="form-group">
<label class="col-md-12">Password<span class="__required">*</span></label>
 <div class="col-md-12"><?php echo $this->Form->input('password', ['required' => true, 'class' => 'form-control form-control-line',  'label' => false]); ?>
 	 </div>
 </div>
<div class="form-group">
<label class="col-md-12">Address<span class="__required">*</span></label>
 <div class="col-md-12"><?php echo $this->Form->input('address', ['type'=>'text','required' => true,'class' => 'form-control form-control-line',  'label' => false]); ?>
 	 </div>
 </div>
<div class="form-group">
<label class="col-md-12">State<span class="__required">*</span></label>
<div class="col-md-12"><?php echo $this->Form->select('state',$states, ['empty' => 'Select State', 'class' => 'form-control form-control-line',  'required' => true]); ?>
	 </div>
 </div>
<div class="form-group">
<label class="col-md-12">Zip<span class="__required">*</span></label>
 <div class="col-md-12"><?php echo $this->Form->input('zip', ['required' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
 	 </div>
 </div>

<div class="form-group">
  <div class="col-md-12"> <?php echo $this->Form->input('SUBMIT', ['type' => 'submit','class'=>'btn btn-success','label' => false]); ?>
  	 </div>
 </div>

 
 
 
 
 
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2017 Monster Admin by wrappixel.com
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>