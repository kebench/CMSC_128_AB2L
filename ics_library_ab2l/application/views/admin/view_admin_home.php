<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      google.load("visualization", "1", {packages:["corechart"]});

      google.setOnLoadCallback(drawChart);
      function drawChart() {
       var data = new google.visualization.DataTable();
        data.addColumn('string', 'foo');
        data.addColumn('number', 'bar');
            

        <?php
          // query MySQL and put results into array $results
          foreach ($stat as $row) {
              echo "data.addRow(['{$row->title}', {$row->book_stat}]);";
          }
        ?>

        var options = {
          title: 'Book Statistics'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>

<div id="thisbody" id="thisbody" class="body width-fill background-white">
    <div class="cell">
        <div class="page-header cell">
           <h1>Admin <small>Home Page</small></h1>
        </div>
        <div class="cell">
        	<?php
                            if($overdue != NULL){
                        ?>
						<div class="panel datasheet cell">
	                        <div class="header background-red">
	                            List of overdue books
	                        </div>
	                        <table class="body">
                                <thead>
                                    <tr>
                                        <th style="width: 2%;">#</th>
                                        <th style="width: 15%;">Borrower's Acct no</th>
                                        <th style="width: 15%;">Borrower's Name</th>
                                        <th style="width: 15%;">Book Call Number</th>
                                        <th style="width: 15%;">Date Borrowed</th>
                                        <th style="width: 15%;">Due Date</th>
                                        <th style="width: 15%;"></th>
                                        <th style="width: 15%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                <?php
                                    $date = date("Y-m-d");
                                    $count = 1;
                                    foreach($overdue as $row){
                                        echo "<tr>
                                                <td>$count</td>
                                                <td>{$row->account_number}</td>
                                                <td>{$row->first_name} {$row->middle_initial} {$row->last_name}</td>
                                                <td>{$row->call_number}</td>
                                                <td>{$row->date_borrowed}</td>
                                                <td>{$row->due_date}</td>";
                                        echo "<td><form action='controller_reservation/extend' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='extend' value='Extend' />
                                                </form></td>
											<td><form action='controller_outgoing_books/return_book/' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='return' value='Return' />
                                            </form></td>";
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
                                <form action='controller_outgoing_books/send_email' method='post' class="float-right">
                                   <input type='submit' name='notify_all' value='Notify All' enabled/>
                                </form>
	                    </div>

	                    <?php
                            }
                            else{
                                echo "<hr>";
                                echo "<h4 class='color-grey'>There is no currently overdue books!</h4>";
                                echo "<hr>";
                            }
                        ?>

                        <?php
                            if($reserved != NULL){
                        ?>
						<div class="panel datasheet cell">
	                        <div class="header background-red">
	                            List of outgoing books
	                        </div>
	                        <table class="body">
	                            <thead>
	                                <tr>
	                                    <th style="width: 2%;">#</th>
	                                    <th style="width: 10%;">Borrower's Acct No</th>
	                                    <th style="width: 10%;">Borrower's Name</th>
	                                    <th style="width: 10%;">Book Call Number</th>
										<th style="width: 10%;">Status</th>
										<th style="width: 10%;">Due Date</th>
	                                    <th style="width: 10%;"></th>
	                                    <th style="width: 10%;"></th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	<?php
	                            	$count = 1;
	                                foreach($reserved as $row) {
										echo "<tr>
											<td>$count</td>
											<td>{$row->account_number}</td>
											<td>{$row->first_name} {$row->middle_initial} {$row->last_name}</td>
											<td>{$row->call_number}</td>
											<td>{$row->status}</td>
											<td>{$row->due_date}</td>";
										echo "<td><form action='controller_outgoing_books/reserve/' method='post'>
												<input type='hidden' name='res_number' value='{$row->res_number}' />
												<input type='submit' class='background-red' name='reserve' value='Confirm' />
											</form></td>";
										echo "<td><form action='controller_outgoing_books/cancel/' method='post'>
											<input type='hidden' name='res_number' value='{$row->res_number}' />
											<input type='submit' class='background-red' name='cancel' value='Cancel' />
										</form></td>";	
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
	                    </div>
	                    <?php
	                    	}
	                    	else{
	                    		echo "<hr>";
                                echo "<h4 class='color-grey'>There is no currently outgoing books!</h4>";
                                echo "<hr>";
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
				                        foreach ($users as $row) {
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

											if($stat === "approve"){
											echo "<td><a href='".base_url()."index.php/admin/controller_view_users/borrow/$row->account_number'>Click to borrow</a></td>";
											}
											else{
												echo "<form action='controller_view_users/approve_user' method='POST'>";
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
				           </div>

				            <div id="piechart" class="cell" style="width: 900px; height: 500px;"></div>

        </div>
	</div>
</div>
</div>