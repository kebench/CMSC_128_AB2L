<div id="thisbody" class="body width-fill background-white">
	<div class="cell">
        <div class="page-header cell">
           <h1>Admin <small>View Users</small></h1>
        </div>
        <?php if(isset($message)){ ?>
        <div>
            <?php echo $message ?>
        </div>
        <?php
            }
        ?>
		<div class="panel datasheet cell">
            <div class="header background-red">
                List of Users
            </div>
            <table class="body">
                <thead>
                    <tr>
                        <th style="width: 2%;">#</th>
                        <th style="width: 8%;">Student Number</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 5%;">Course</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 8%;">Classification</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                    	$count = 1;
                        foreach ($results as $row) {
							echo "<tr>";
							echo "<td>$count</td>";
							echo "<td>".$row->account_number."</td>";
							$fullName = $row->first_name." ".$row->middle_initial." ".$row->last_name;
							echo "<td>".$fullName."</td>";
							echo "<td>".$row->course."</td>";
							echo "<td>".$row->email."</td>";
							echo "<td>".$row->classification."</td>";
							$stat = $row->status;

							/*
								If status not yet 'approve', meaning the account was not yet validated,
								a button with a value 'Validate' will be seen in the status column.
								If status is already 'approve', meaning the account was already validated,
								'Registered' will be displayed on the said column. 
							*/
                            $base = base_url();
							if($stat === "approve"){
							echo "<td><a href='".base_url()."index.php/admin/controller_view_users/borrow/$row->account_number'>Click to borrow</a></td>";
							}
							else{
								echo "<form action='$base"."index.php/admin/controller_view_users/approve_user' method='POST'>";
                                echo "<input type='hidden' name='account_number1' value='$row->account_number'/>";
                                echo "<td>"."<input type ='submit' class='background-red' name='approve' value = 'Confirm'>"."</td>";   //'Validate' button. Functionality not included here.
                                echo "</form>";	//'Validate' button. Functionality not included here.
						    }
							
							echo "</tr>";
							$count++;
						}
					?>
                </tbody>
            </table>
            <div class="footer pagination">
                <ul class="nav">
                    <li><a href="#">Prev</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
			<form action='<?php echo base_url();?>index.php/admin/controller_view_users/deactivate' method='POST' class="float-right">
				<input type ='submit' class='background-white' name='deactivate' value = 'Deactivate All User Accounts' onclick="confirm('Are you sure you want to deactivate all user accounts? This cannot be undone!')">
			</form>
        </div>
    </div>
</div>