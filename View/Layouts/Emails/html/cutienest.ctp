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
 * @package       app.View.Emails.text
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->fetch('title'); ?></title>
</head>

<body> 
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

<table cellpadding="0" cellspacing="0" border="0" width="700" style=" margin:0 auto; font-family: 'Open Sans', sans-serif;">
	<tr>
    	<td>
        	<table cellpadding="0" cellspacing="0" border="0" width="700">
            	<tr>
                	<td style="border-bottom: 1px solid #e7e7e7;padding: 10px;border-top: 1px solid #e7e7e7;"><img src="<?php echo Configure::read('SITE_URL') ?>images/logo.png" width="150" style="padding:14px 0px 7px 9px;"  /></td>
                </tr>
                <tr>
                	<td>
                    	
                       <?php echo $this->fetch('content'); ?>
                    </td>
                </tr>
                
                <tr>
                	<td  align="right">
                    	<table cellpadding="0" cellspacing="0" width="700" style=" background:#ebebeb; padding:10px; margin-top:20px;">
                        	
                            <tr>
                                  	<td colspan="7" style=" padding-top:10px; font-size:12px; color:#76787d; text-align:center;" align="center">&copy; 2018 Cutienest. All Rights Reserved</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>



