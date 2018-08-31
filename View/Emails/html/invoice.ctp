
                          
                    	<table cellpadding="0" cellspacing="0" border="0" width="700" style=" padding:10px; margin-bottom:10px;">
                            <tr><td style="font-family: 'Open Sans', sans-serif; font-size:13px; color:#a4a3a3; font-weight:400; padding-top:10px; padding-bottom:15px;">Dear <?php echo $userDataArr['Name']; ?>,</td></tr>
                            <tr><td style="font-family: 'Open Sans', sans-serif; font-size:13px; color:#a4a3a3; padding-bottom:0px; line-height:24px;">Your New Invoice Created. This e-mail confirms that we've received your invoice # (XXXX) placed on <?php echo date('d-m-Y'); ?>. If you        would like to view the status of your invoice , please visit <a href="http://www.cutienest.com/users/login" style=" font-size:13px; color:#fb666d;">My Invoice</a> tab. </td></tr>                          
                        </table>
                   

                    	<table cellpadding="0" cellspacing="0" border="0" width="700" style=" margin-top:20px;">
                        	<tr>
                            	<th align="center" style=" font-size:14px; color:#54565c; font-weight:400; border-bottom:1px solid #ededee; padding:0px 0px 10px 0px;">Invoice No</th>
                                <th align="center" style=" font-size:14px; color:#54565c; font-weight:400; border-bottom:1px solid #ededee; padding:0px 0px 10px 0px; ">Due Date</th>
                                <th align="center" style=" font-size:14px; color:#54565c; font-weight:400; border-bottom:1px solid #ededee; padding:0px 0px 10px 0px; ">Joining Date</th>
                                <th align="center" style=" font-size:14px; color:#54565c; font-weight:400; border-bottom:1px solid #ededee; padding:0px 0px 10px 0px; ">Amount</th>
                            </tr>
                        	<tr> 
                            	<td align="center" style=" margin-top:10px; border-bottom:1px solid #ededee; padding:10px 0px;">014523</td>
                                <td align="center" style=" margin-top:10px;border-bottom:1px solid #ededee; padding:10px 0px; font-size:14px; color:#54565c; font-weight:400;"><?php echo $this->Common->flipdate($userDataArr['DueDate']); ?></td>
                                <td align="center" style=" margin-top:10px;border-bottom:1px solid #ededee; padding:0px 0px; font-size:14px; color:#54565c; width:100px;height:30px; color:#8b8a8a; text-align:center; line-height:30px;"><?php echo $this->Common->flipdate($userDataArr['JoiningDate']); ?></td>
                                <td align="center" style=" color:#fb666d; border-bottom:1px solid #ededee;  padding:10px 0px; font-size:14px;">$<?php echo $userDataArr['Amount']; ?></td>
                            </tr>
                        	
                        </table>
             