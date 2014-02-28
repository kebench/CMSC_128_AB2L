<div class="cell">
									<br/>
									<div id = "carousel">
										<div class="span13">
											<div id="slider" class="carousel slide">
												<div class="carousel-inner">
													<div class="item active">
														<img src="<?php echo base_url(); ?>images/home/uplb1.jpg" div="imgsize"></img>
													</div>
													<div class="item">
														<img src="<?php echo base_url(); ?>images/home/ics.jpg" div="imgsize"></img>
													</div>
													<div class="item">	
														<img src="<?php echo base_url(); ?>images/home/lib1.jpg" div="imgsize"></img>						
													</div>
													<div class="item">
														<img src="<?php echo base_url(); ?>images/home/lib2.jpg" div="imgsize"></img>
													</div>
													<div class="item">		
														<img src="<?php echo base_url(); ?>images/home/lib3.jpg" div="imgsize"></img>
													</div>
												</div>
											<a class="left carousel-control" href="#slider" data-slide="prev">&lsaquo;</a>
											<a class="right carousel-control" href="#slider" data-slide="next">&rsaquo;</a>
											</div>
										</div>
									</div>


									<h4 id="news">News and Updates</h4>

									<div class="col">
		                                <div class="cell panel">
		                                    <div class="body">
		                                        <div class="cell">
		                                            <div class="col">
		                                                <div class="cell tab-block top-nav">
		                                                    <div class="tabs">
		                                                        <ul class="nav">
		                                                            <li class="active"><a href="#tabcontent1">1</a></li>
		                                                            <li><a href="#tabcontent2">2</a></li>
		                                                            <li><a href="#tabcontent3">3</a></li>
		                                                        </ul>
		                                                    </div>
		                                                    <div class="tab-content">
		                                                        <div class="cell" id="tabcontent1">
		                                                            <h4 id="news1">Not yet registered?</h4>
																	</br><a id="reglinka" href="typography-form.html">Sign up now!</a>
		                                                        </div>

		                                                      <?php

																$counter = 0;
																$count = 2;
																$txt_file = file_get_contents('./application/announcements.txt');
																$rows = explode("*", $txt_file);
																array_shift($rows);

		                                               		
																if($rows != NULL){
																foreach($rows as $row => $data)
																{
																	$counter = $counter + 1;
																	$data1 = explode("^",$data);
																	$info[$row]['date'] = $data1[0]; 
																	$info[$row]['tc'] = $data1[1];

																	if($counter>5) break;
																	//echo 'Date: ' . ($date=$info[$row]['date']) . '<br />';

																	array_shift($data1);

																	foreach($data1 as $row1 => $data2)
																	{
																		$row_data = explode('#', $data2);
																		$info[$row1]['title'] = $row_data[0];
																		$info[$row1]['content'] = $row_data[1];

																		echo "<div class=\"cell hidden-tab\" id=\"tabcontent".$count."\">";
																		echo "<h4 id = \"news1\">{$info[$row1]['title']}</h3>";
																		echo "<p>{$info[$row1]['content']}</p><br/>";
																		echo "</div>";
																		$count++;
																	}
																}
																}
																?>

		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
							</div>