<div class="page_title_bar">
<div class="wrapper">
<h1>Invoice Management</h1>
</div>
</div>
<div class="page_content">
<div class="wrapper afclr">
<div class="logout_section afclr">
<div class="lo_left">
<h3><?=$this->Common->username()?></h3>
<h4>In Bussiness</h4>
<h5><?php pr($this->Common->stateName($this->Common->userState()))?></h5>
</div>
<div class="lo_right">
<a href="<?=Configure::read('SITE_URL')?>users/logout">Logout</a>
</div>
</div>
<div class="login_tab afclr">
<div class="tab_left">
            
<?php echo $this->element('menu'); ?>

</div>
<div class="tab_right">

<div class="title_heading">
<h3>Policies</h3>
</div>
<div class="create_invoice_btn">
<a href="#"><i class="fa fa-plus" aria-hidden="true"></i>Create New Invoice</a>
</div>
<div class="invoice_list">
<table style="width:100%;">
<tr>
<td>S.No.</td>
<td>Customer Name</td>
<td>Last Paid Date</td>
<td>Status</td>
<td>Action</td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="pay_btn">Paid</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="due_btn">Due</span></td>
<td data-th="Action"><a  href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="pay_btn">Paid</span></td>
<td data-th="Action"><a href="#"  title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="pay_btn">Paid</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="pay_btn">Paid</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="due_btn">Due</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="pay_btn">Paid</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="pay_btn">Paid</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="due_btn">Due</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
<tr>
<td data-th="S.No.">1</td>
<td data-th="Customer Name">John Andrew</td>
<td data-th="Last Paid Date">24/12/17</td>
<td data-th="Status"><span class="pay_btn">Paid</span></td>
<td data-th="Action"><a href="#" title="Add Payment"><i class="fa fa-plus-circle" aria-hidden="true"></i></a><span>/</span>
					<a href="#" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><span>/</span>
                    <a href="#" title="Resend"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
</tr>
</table>
</div>

<script>
$(document).ready(function () {
    
    // This will automatically grab the 'title' attribute and replace
    // the regular browser tooltips for all <a> elements with a title attribute!
    $('a[title]').qtip();
    
});
</script>



</div>
</div>
</div>
</div>