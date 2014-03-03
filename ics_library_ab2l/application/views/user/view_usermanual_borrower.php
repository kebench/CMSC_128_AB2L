<!DOCTYPE html>
<html>
	<head>
		<title>User Manual</title>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/build-full.css" media="all"/>
		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/main-template.css" media="all"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>style/jquery-ui.css"><!--source: http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css-->
  		<link rel="stylesheet" href="<?php echo base_url(); ?>style/user/slider.css" type="text/css" media="screen" />
  		<link rel="stylesheet" href="<?php echo base_url(); ?>default/default.css" type="text/css" media="screen" />
  		<link rel="icon" href="<?php echo base_url(); ?>images/ics_icon.png"/>
  		<link rel="stylesheet" type="text/css" href="<?php echo  base_url() ?>style/user/edit.css" media="all"/>
		<style type="text/css">
			* {font-family: Arial;}
			span {font-size: 20px;}
			h2, span, hr, .sub {color: #BF0A0A;}
			h2 {font-weight: bold;}
			body{
				margin: 30px;
			}
		</style>
	</head>
	<body>
		<a name="top"></a>
		<h2>Features</h2>
		<a href="<?php echo base_url(); ?>" class="tiny">Back to Home</a>	<!-- Cla, palagay na lang nung link :D -->
		<hr><br/>
		<span>Table of Contents</span>
		<ul>
			<li><a href="#search">Search</a></li>
			<li><a href="#viewBooks">View Books</a></li>
			<li><a href="#bookStat">Book Statistics</a></li>
			<li><a href="#faqs">FAQs</a></li>
			<li><a href="#contact">Contact Us</a></li>
			<li><a href="#borrowedBooks">Borrowed Books</a>
				<ul>
					<li><a href="#borBooks">List of Borrowed Books</a></li>
					<li><a href="#retBooks">List of Returned Books</a></li>
				</ul>
			</li>
		</ul>			

		<br/><hr><br/>
		<a name="search"></a>
		<span>Search</span>
		<ul>
			<li>Displays a list of all books present in database according to search preference.</li>
			<li>Allows user to see which books are available for reservation.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="viewBooks"></a>
		<span>View Books</span>
		<ul>
			<li>Displays a list of all books present in database.</li>
			<li>Allows user to see the books' details and their current state in the library.</li>
			<li>Also allows the user to reserve his book of preference as he sees it in the list.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="bookStat"></a>
		<span>Book Statistics</span>
		<ul>
			<li>Displays in a chart the top 10 most borrowed books.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="faqs"></a>
		<span>Frequently Asked Questions (FAQs)</span>
		<ul>
			<li>Shows answers or solutions to questions frequently asked by the users about the system.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="contact"></a>
		<span>Contact Us</span>
		<ul>
			<li>Shows the location of ICS Library on map.</li>
			<li>Shows the contact information of the Library.</li>
			<li>Allows the user to raise questions or give suggestions about the system.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>
		
		<a name="borrowedBooks"></a>
		<span>Borrowed Records</span>
		<ul>
			<a name="borBooks"></a>
			<li><span>List of Borrowed Books</span>
				<ul>
					<li>Shows the list of books currently in the possession of the user.</li>
					<li>Shows the details of the transaction and the details of the book.</li>
				</ul>
			</li>
			<a name="retBooks"></a>
			<li><span>List of Returned Books</span>
				<ul>
					<li>Shows the list of books previously borrowed by the user.</li>
					<li>Shows the details of the transaction and the details of the book.</li>
				</ul>
			</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>
	</body>
</html>