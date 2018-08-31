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
                        <h3 class="text-themecolor m-b-0 m-t-0">Provider</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">View Provider</li>
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
              
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                               
                                <?php $states=$this->Common->getState();?>

 <?php echo $this->Form->create('User',array('class'=>'form-horizontal form-material')); ?>
 
 
 <div class="form-group">
 <label class="col-md-12">Full Name</label>
<div class="col-md-12"><?php echo $this->Form->input('name', ['readonly' => true,'class' => 'form-control form-control-line', 'label' => false]); ?>
	 </div>
 </div>
                                        
<div class="form-group">
<label class="col-md-12">Phone</label>
<div class="col-md-12"><?php echo $this->Form->input('phone', ['readonly' => true,'class' => 'form-control form-control-line',  'label' => false]); ?>
	</div>
</div>
<div class="form-group">
 <label class="col-md-12">Email</label>
 <div class="col-md-12"><?php echo $this->Form->input('email', ['readonly' => true,'required' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
 	</div>
 </div>

<div class="form-group">
<label class="col-md-12">Address</label>
 <div class="col-md-12"><?php echo $this->Form->input('address', ['type'=>'text','readonly' => true,'class' => 'form-control form-control-line',  'label' => false]); ?>
 	 </div>
 </div>
<div class="form-group">
<label class="col-md-12">State</label>
<div class="col-md-12"><?php echo $this->Form->select('state',$states, ['empty' => 'Select State', 'class' => 'form-control form-control-line',  'readonly' => true]); ?>
	 </div>
 </div>
<div class="form-group">
<label class="col-md-12">Zip</label>
 <div class="col-md-12"><?php echo $this->Form->input('zip', ['readonly' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
 	 </div>
 </div>

 
 <div class="form-group">
<label class="col-md-12">EIN No.</label>
 <div class="col-md-12"><?php echo $this->Form->input('ein', ['readonly' => true, 'class' => 'form-control form-control-line', 'label' => false]); ?>
 	 </div>
 </div>
 
 
 
 
 
<!--<div class="form-group">
 <label class="col-md-12">Yard<span class="__required">*</span></label>
 <div class="col-md-12"><?php echo $this->Form->select('yard', array('Yes' => 'Yes','No' => 'No'), ['empty' => '--Yard--','class' => 'foms-inputs']); ?></div>
 </div> -->
 
 

<!-- <div class="form-group">
 <label class="col-md-12">Latitude<span class="__required">*</span></label>
 <div class="col-md-12"><?php echo $this->Form->input('lat', ['placeholder' => 'Latitude', 'class' => 'MapLat foms-inputs', 'label' => false]); ?></div>
 </div> -->
 
 
<!-- <div class="form-group">
 <label class="col-md-12">Longitude</label>
 <div class="col-md-12"><?php echo $this->Form->input('long', ['placeholder' => 'Longitude', 'class' => 'MapLon foms-inputs', 'label' => false]); ?></div>
 </div> -->
 
 <div class="form-group businesstype">
 <label class="col-md-12">Stage</label>
 <div class="col-md-12"><?php echo $this->Form->select('stage', array('Working for license','Have license','In business'), ['empty' => 'Select Stage', 'class' => 'foms-inputs', 'readonly' => true]); ?></div>
 </div>
 
 
 <div class="form-group">
 <label class="col-md-12">Years in Business</label>
 <div class="col-md-12"><?php echo $this->Form->input('howmanyyears', ['placeholder' => 'Years in Business', 'class' => 'form-control form-control-line', 'label' => false, 'readonly' => true]); ?></div>
 </div>
 
 
 
 
 <div class="form-group licnoout" >
 <label class="col-md-12">Licence No.</label>
 <div class="col-md-12"><?php echo $this->Form->input('licenceno', ['readonly' => true,'placeholder' => 'Licence Number','class' => 'licno foms-inputs', 'label' => false]); ?></div>
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