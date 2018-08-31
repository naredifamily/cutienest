 <div class="page-wrapper">
 <div class="container-fluid">
<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Enrollment</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active">Enrollment</li>
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
                                                <th>Enroll Id</th>
                                                <th>Child Name</th>
                                                <th>Age</th>
												<th>Gender</th>
												<th>Start Date</th>
                                                <th>End Date</th>
												<th>Payment Type</th>
												<th>Amount</th>
                                                <th>Provider Name</th>
                                                <th>User Name</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        		<?php foreach($enrollment as $child)
												{?>
                                                <tr>
													<td><?php echo $child['enrolldetails']['id']; ?></td>
                                                    <td><?php echo $child['enrolldetails']['childname']; ?></td>
                                                    <td><?php echo $child['enrolldetails']['age']; ?></td>
                                                    
                                                    <td><?php if(strcmp($child['enrolldetails']['gender'],'M')==0)
													{
														echo "Male";
													}
													else 
													{
														echo "Female";
													}
													?></td>
                                                    <td><?php $startDate=strtotime($child['enrolldetails']['startdate']);
															echo date('m-d-Y',$startDate);
															
													 ?></td>
                                                      <td><?php 
													  if(strcmp($child['enrolldetails']['enddate'],'0000-00-00')==0)
													  {
														  echo "N/A";
													  }
													  else {
													  $enddate=strtotime($child['enrolldetails']['enddate']);
															echo date('m-d-Y',$enddate);
													  }
													 ?></td>
                                                   
                                                    <td><?php if(strcmp($child['enrolldetails']['paymentfrequency'],'W')==0)
													{
														echo "Weekly";
													}
													else if(strcmp($child['enrolldetails']['paymentfrequency'],'M')==0)
													{
														echo "Monthly";
													}
													else 
													{
														echo "Daily";
													}
													?></td>
                                                    <td><?php echo $child['enrolldetails']['amount']; ?></td>
                                                    <td><?php echo $child['usp']['name']; ?></td>
                                                    <td><?php echo $child['usU']['name']; ?></td>
                                                    <td><?php if($child['enrolldetails']['status']==0)
													{
														echo "Pending";
													}
													else if($child['enrolldetails']['status']==1)
													{
														echo "Accepted";
													}
													else 
													{
														echo "Rejected";
													}
													?></td>
                                                    </tr>
												<?php }?>
                                        	
										</tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>