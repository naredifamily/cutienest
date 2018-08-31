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
                            <li class="breadcrumb-item active">Add Provider</li>
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

 <?php echo $this->Form->create('Page',array('class'=>'form-horizontal form-material')); ?>
 
 
 
 <div class="form-group">
 <label class="col-md-12">Title<span class="__required">*</span></label>
<div class="col-md-12"><?php echo $this->Form->input('title', ['required' => true,'class' => 'form-control form-control-line', 'label' => false]); ?>
	 </div>
 </div>
   <div class="form-group">
 <label class="col-md-12">Slug<span class="__required">*</span></label>
<div class="col-md-12"><?php echo $this->Form->input('slug', ['required' => true,'class' => 'form-control form-control-line', 'label' => false]); ?>
	 </div>
 </div>                                      

<div class="form-group">
 <div class="col-md-12"><?php echo $this->Form->textarea('body', ['class' => 'tinymce form-control form-control-line',  'label' => false]); ?>
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