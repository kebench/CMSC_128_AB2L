<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title><?php 
$base = base_url();
echo $page_title;?></title>
</head>
<body>
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
			<input type="button" value="Confirm Reservation" id="confirmButton">
			
		</div>
	</form>
</body>
</html>