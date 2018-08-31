<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('colors/blue');
    echo $this->Html->css('admin-style.css');
    echo $this->Html->css('developer');
   
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    @header("Cache-Control: no-store, no-cache, must-revalidate");
    ?>
</head>
<body>
<?php echo $this->fetch('content'); ?>
<?php //echo $this->element('sql_dump'); ?>

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

?>
</body>
</html>
