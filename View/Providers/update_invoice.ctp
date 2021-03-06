<div class="page_title_bar">
<div class="wrapper">
<h1>Update Invoice</h1>
</div>
</div>
<div class="page_content">
<div class="wrapper afclr">
<?php echo $this->element('usersection'); ?>

<div class="login_tab afclr">
<div class="tab_left">
<?php echo $this->element('menu-provider'); ?>

</div>
<div class="tab_right create_invoice">

<div class="title_heading afclr">
<h3>Update Invoice</h3>
</div>
<?php echo $this->Form->create('User', ['class'=>'care_search','type'=>'post','url' => [ 'controller' => 'users', 'action' => 'updateInvoice']]); ?>

<?php foreach($invoice_data as $invoice){ ?>

<input type="hidden" name="id"  value="<?=$invoice['invoices']['id']; ?>">
<div class="invoice_detail afclr">
<div class="list_one">
<h3>Customer Name</h3>
<select name="user" class="select-input" required="required" onchange="getJoiningDate(this.value)">
<option value="">--select Cutomer--</option>
<?php foreach($customer as $customers){?>
<option <?php if($invoice['invoices']['user'] == $customers['reserve']['user']){ echo 'selected';}  ?> value="<?=$customers['reserve']['user']?>"><?=$this->Common->getUserName($customers['reserve']['user'])?></option>
<?php }?>
</select>

</div>

<div class="list_two">
<h3>Payment Due</h3>
<input type="text" name="amount" required="required" autocomplete="off"  placeholder="Amount" value="<?=$invoice['invoices']['amount']; ?>">
</div>
<div class="list_one">
<h3>Kids Name </h3>
<input type="text" name="kids_name" required="required" autocomplete="off"  value="<?=$invoice['invoices']['kids_name']; ?>" placeholder="Kids Name*">
</div>

<div class="list_two">
<h3>Joining Date</h3>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="<?php echo Configure::read('SITE_URL') ?>js/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker();
  } );
  </script>

 
<input type="text" name="joining_date" autocomplete="off" required="required" id="joiningdate" class="datepicker"  placeholder="Join Date" value="<?=date('Y-m-d',strtotime($invoice['invoices']['joining_date'])); ?>">
</div>

<div class="list_one">
<h3>Due Date</h3>
<input type="text" name="due_date" required="required" autocomplete="off" class="datepicker"  placeholder="Due Date" value="<?=date('Y-m-d',strtotime($invoice['invoices']['due_date'])); ?>">
</div>

<div class="list_two">
<h3>Ein No.</h3>
<input type="text" name="ein" placeholder="EIN" value="<?=$invoice['invoices']['ein']; ?>">
</div>

<div class="list_two">
<div class="s_label afclr inv_lbs" style="display: none">
<span class="inv_select"><input type="radio" name="status" value="1" checked><label>Paid</label></span>
<span class="inv_select"><input type="radio" name="status" value="0" checked><label>Due</label></span>
</div></div>
<div class="clr"></div>
<div class="create_invoice_btn">
<button type="submit" class="submit-btns">Update Invoice</button>
</div>
</div>
<?php } ?>
</form>
</div>
</div>
</div>
</div>
