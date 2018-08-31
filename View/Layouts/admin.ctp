
<!DOCTYPE html>
<html>
<head>
	<title>
Admin Panel	</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('admin/bootstrap.min');
    echo $this->Html->css('colors/blue');
    echo $this->Html->css('admin-style');
    echo $this->Html->css('developer');
	echo $this->Html->css('tooltipster.bundle.min');
   
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    @header("Cache-Control: no-store, no-cache, must-revalidate");
    ?>
</head>
<body>
<?php echo $this->element('Admin/header'); ?>
<?php echo $this->element('Admin/menu'); ?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('Admin/footer'); ?>
<?php echo $this->element('sql_dump'); ?>

<?php
 echo $this->Html->script('assets/plugins/jquery/jquery.min.js');
    echo $this->Html->script('assets/plugins/bootstrap/js/tether.min.js');
	echo $this->Html->script('assets/plugins/bootstrap/js/bootstrap.min.js');
	echo $this->Html->script('jquery.slimscroll.js');
	echo $this->Html->script('waves.js');
	echo $this->Html->script('sidebarmenu.js');
	echo $this->Html->script('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js');
	echo $this->Html->script('custom.min.js');
	echo $this->Html->script('assets/plugins/flot/jquery.flot.js');
	echo $this->Html->script('assets/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js');
    echo $this->Html->script('flot-data.js');
    echo $this->Html->script('assets/plugins/styleswitcher/jQuery.style.switcher.js');
    echo $this->Html->script('common.js');
	echo $this->Html->script('tinymce/tinymce.min.js');
	echo $this->Html->script('tinymce/init-tinymce.js');
	echo $this->Html->script('tooltipster.bundle.min.js');
?>
</body>
</html>
