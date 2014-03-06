<div id="thisbody" class="body width-fill background-white">
                    <div class="col">
                            <div class="cell">
                                    <div class="page-header cell">
                                        <h1>Admin <small>User Borrow Books</small></h1>
                                    </div>
                                    <div class="col width-fill">
                                    <div class="col">
                                        <div class="cell panel">
	<form action="../controller_reserve_book/confirm_reservation" method="post" id="reserve_form" name="reserve_form">
		<div id="info_area">
			<b>Borrower: </b><?=$borrower;?><br />
			<b>Title: </b><?=$title;?><br />
			<b>Author/s: </b>
			<?php
				foreach ($author as $value) {
					echo $value."; ";
				}
			?><br />
			<b>Year of Publication: </b><?=$year_of_pub?><br />
			<b>Type: </b><?=$type?><br />
			<b>Expiration Date of Reservation (if book is reserved now): </b><?=$date_expire['mday']."/".$date_expire['mon']."/".$date_expire['year']?><br />
			<a id="confirmButton" href="<?php echo base_url().'index.php/admin/controller_reserve_book/confirm_reservation/'.$title; ?>"><input type="button" value="Confirm Reservation"></a>
								
		</div>
	</form>
</div>
</div>
</div>
</div>
</div>
</div>