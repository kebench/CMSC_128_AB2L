<div id="thisbody" class="body width-fill background-white">
					<div class="cell">
                        <div class="page-header cell">
                                        <h1>Admin <small>View Borrowed Books</small></h1>
                        </div>
                        <div id="tabs" style="border:0px solid black; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 1em;">
                        <ul style="border:0px solid black; border-bottom: 1px solid #aaa; border-radius: 0px;" class="background-white">
                            <li><a href="#tabs-1">Overdue Books</a></li>
                            <li><a href="#tabs-2">Borrowed Books</a></li>
                        </ul>
                        <?php
                            if($overdue != NULL){
                        ?>
                        <div id='tabs-1'>
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
												</form></td>";
										echo	"<td><form action='controller_outgoing_books/return_book/' method='post'>
                                                <input type='hidden' name='res_number' value='{$row->res_number}' />
                                                <input type='submit' class='background-red' name='return' value='Return' />
                                            </form></td>";
                                        echo "</tr>";
                                        $count++;
                                    }
                                ?>
                                </tbody>
                            </table>
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
                                echo "<h2 class='color-grey'>There is no currently overdue books!</h2>";
                                echo "<hr>";
                            }
                            echo "</div>";
                            if($query != NULL){
                        ?>
                        <div id='tabs-2'>
                        <div class="panel datasheet cell">
                            <div class="header background-red">
                                List of borrowed books
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
                                    $base = base_url();
                                    foreach($query as $row){
                                        echo "<tr>
                                                <td>$count</td>
                                                <td>{$row->account_number}</td>
                                                <td>{$row->first_name} {$row->middle_initial} {$row->last_name}</td>
                                                <td>{$row->call_number}</td>
                                                <td>{$row->date_borrowed}</td>
                                                <td>{$row->due_date}</td>";
										if($row->due_date != $date){
											echo "<td></td>";
										}else{
											echo "<td><form action='controller_reservation/extend' method='post'>
												<input type='hidden' name='res_number' value='{$row->res_number}' />
												<input type='submit' class='background-red' name='extend' value='Extend' />
												</form></td>";
										}
                                        echo "<td><form action='$base/index.php/admin/controller_outgoing_books/return_book/' method='post'>
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
                                <!--<form action='' method='post' class="float-right">
                                   <input type='submit' name='notify_all' value='Notify All' enabled/>
                                </form>-->
                        </div>
                        <?php
                            }
                            else{
                                echo "<hr>";
                                echo "<h2 class='color-grey'>There is no currently borrowed books!</h2>";
                                echo "<hr>";

                            }
                            echo "</div>";
                        ?>
	       </div>
</div>
<script>
    $(document).ready(function(){
        $('#tabs').tabs();
    });
</script>