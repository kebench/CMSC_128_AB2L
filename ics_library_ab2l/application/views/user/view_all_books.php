<div class="cell body">
									<p class="tiny">View Books</p>
								</div>
								 <div class="col">
                                <div class="cell">
                                    <div class="panel datasheet">
                                        <div class="header text-center background-red">
                                            List of all books
                                        </div>
                                        <table class="body fixed">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%;">#</th>
                                                    <th style="width: 15%;" nowrap="nowrap">Course Code</th>
                                                    <th style="width: 35%;" nowrap="nowrap">Title</th>
                                                    <th style="width: 22%;" nowrap="nowrap">Author</th>
                                                    <th style="width: 8%;" nowrap="nowrap">Type</th>
                                                    <th style="width: 10%;" nowrap="nowrap">Availability</th>
                                                    <th style="width: 13%;" nowrap="nowrap">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
                                                    $count = 1;
                                                    foreach($result as $row){//subject,title,author,type,status,call_number
                                                        echo "<tr>";
                                                            echo "<td>$count</td>";
                                                            echo "<td>".$row->subject."</td>";
                                                            echo "<td>".$row->title."</td>";
                                                            echo "<td>".$row->author."</td>";
                                                            echo "<td>".$row->type."</td>";
                                                            echo "<td>".$row->no_of_available. "/" . $row->quantity."</td>";
                                                            echo "<td><input type='button' class='background-red table-button' value='Borrow Book'></td>";
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
                                </div>
                            </div>