<div id="main-body" class="site-body">
                <div class="site-center">
<div class='cell'>
	<div>
		<p class='tiny'>Book Reservation Details</p>
	</div>
	<div class='col'>
		<div class='cell'>
			<div class='col'>
				<div class='cell'>
					<div class='col'>
						<div class='panel'>
							<div class='header'>Borrower's Information:</div>
							<div class='cell'>
							<form method="post" id="reserve_form" name="reserve_form">
								<div id="info_area">

									<li><b>Borrower: </b><?=$borrower;?></li>
									<li><b>Title: </b><?=$title;
										$title = urldecode($title);
										$tbook = urlencode($title);
									?></li>
									<li><b>Author/s: </b>
									<?php
										foreach ($author as $value) {
											echo $value."<br/>";
										}
									?></li>
									<li><b>Year of Publication: </b><?=$year_of_pub?>
									<li><b>Type: </b><?=$type?></li>
									<li><b>Current Date (DD/MM/YYYY): </b><?=$date_reserved['mday']."/".$date_reserved['mon']."/".$date_reserved['year'];?></li>
									<li><b>Expected Expiration Date of Reservation (if book is reserved now): </b><?=$date_expire['mday']."/".$date_expire['mon']."/".$date_expire['year']?></li><br/>
									<a id="confirmButton" href="<?php echo base_url().'index.php/user/controller_reserve_book/confirm_reservation/'.$tbook; ?>"><input type="button" value="Confirm Reservation"></a>
								</div>
							</form>
						</div>
					</div>
					</div>
				</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

<div id="dialog" title="Book Confirmation Dialog">
  <h5>Do you really wish to reserved this book?</h5>
</div>