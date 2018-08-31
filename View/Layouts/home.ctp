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

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		
		<?php echo $this->fetch('title'); ?>
	</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<?php
	
    echo $this->Html->meta('icon');
    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('colors/blue');
    echo $this->Html->css('style');
    //echo $this->Html->css('developer');
   
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
<?php //echo $this->element('sql_dump'); ?>


</body>
</html>
