 <div class="page-wrapper">
 <div class="container-fluid">
<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Invoices</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">Invoices</li>
                        </ol>
                    </div>
                    
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                              
                                <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Provider Name</th>
                                                <th>User Name</th>
												<th>Amount</th>
												<th>Kid's Name</th>
                                                <th>Joining Date</th>
												<th>Due Date</th>
												<th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        
                                        <?php 
										$index=1;
										foreach($invoices as $invoice)
										{?>
											<tr>
                                            <td><?php echo $index; ?></td>
                                            	<td><?php echo $invoice['usp']['name']; ?></td>
                                                <td><?php echo $invoice['usU']['name']; ?></td>
                                                <td><?php echo $invoice['Invoice']['amount']; ?></td>
                                                <td><?php echo $invoice['Invoice']['kids_name']; ?></td>
                                                <td><?php $joiningDate=strtotime($invoice['Invoice']['joining_date']);
													echo date('m-d-Y',$joiningDate);
												 ?></td>
                                                 <td><?php $joiningDate=strtotime($invoice['Invoice']['due_date']);
													echo date('m-d-Y',$joiningDate);
												 ?></td>
                                                
                                                <td><?php if($invoice['Invoice']['status']==0)
												{
													echo "Payment Pending";
												}
												else 
												{
													echo "Payment Done";
												}?></td>
                                            </tr>
										<?php $index++; }?>
                                        </tbody>
                                 </table>
                                
                                
                                
                                
                                
                                
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>