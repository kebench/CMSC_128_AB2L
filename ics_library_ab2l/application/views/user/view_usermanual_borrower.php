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
			<li><a href="#overview">Overview</a></li>
			<li><a href="#search">Search</a></li>
				<ul>
					<li><a href="#basicSearch">Basic Search</a></li>
					<li><a href="#advancedSearch">Advanced Search</a></li>
				</ul>
			<li><a href="#viewBooks">View Books</a></li>
			<li><a href="#bookStat">Book Statistics</a></li>
			<li><a href="#bookReserve">Book Reservation</a></li>
			<li><a href="#faqs">FAQs</a></li>
			<li><a href="#contact">Contact Us</a></li>
			<li><a href="#borrowedBooks">Record of Borrowed Books</a>
				<ul>
					<li><a href="#borBooks">List of Borrowed Books</a></li>
					<li><a href="#retBooks">List of Returned Books</a></li>
				</ul>
			</li>
			<li><a href="#logout">Logout</a></li>
		</ul>			

		<br/><hr><br/>

		<a name="overview"></a>
		<span>Overview</span>
		<ul>
			<li>This is the UPLB Institute of Computer Science e-Library System. This allows UPLB constituents
			 to do library transactions online. Created by CMSC 128 AB-2L A.Y. 2013-2014.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="search"></a>
		<span>Search</span>
		<ul>
			<a name="basicSearch"></a>
			<li><span>Basic Search</span>
				<ul>
					<li>Allows the user to search for a book by choosing a category from the select box and providing the information in the textbox provided.</li>
					<li>Shows the detailed list of books matching the specified query</li>
				</ul>
			</li>
			<a name="advancedSearch"></a>
			<li><span>Advanced Search</span>
				<ul>
					<li>A more specific search capability which allows users to specify more than one field.</li>
					<li>Shows the detailed list of books matching the specified query.</li>
				</ul>
			</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="viewBooks"></a>
		<span>View Books</span>
		<ul>
			<li>Displays a list of all books present in the database.</li>
			<li>Allows the user to see the books' details and their current availability in the library.</li>
			<li>Allows the user to reserve his preferred book as he sees it in the list.</li>
			<li>Allows the user to sort the Subject, Author, Title, Type, or Availability in ascending or descending order. </li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="bookStat"></a>
		<span>Book Statistics</span>
		<ul>
			<li>Displays a chart that shows the top 10 most borrowed books.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>

		<a name="bookReserve"></a>
		<span>Book Reservation</span>
		<ul>
			<li>Allows user to reserve a book. The reserve button can be found in the list of books. </li>
			<li>Reservation function is subjected to the availability of the book.</li>
				<ul>
					<li> If the book is available, the request will be granted and the user will be waiting for the confirmation of the administrator. </li>
					<li> If there is no available copy of the book yet, the user will be waitlisted for the borrowing of that book. </li>
				</ul>
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
			<li>Shows the location of ICS Library on the map.</li>
			<li>Shows the contact information of the ICS Library.</li>
			<li>Allows the user to provide feedback, raise questions or give suggestions about the system.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>
		
		<a name="borrowedBooks"></a>
		<span>Record of Borrowed Books</span>
		<ul>
			<a name="borBooks"></a>
			<li><span>List of Borrowed Books</span>
				<ul>
					<li>Shows the list of books which are currently in the user's possession.</li>
					<li>Shows the details of the transaction(s) and the details of the book.</li>
				</ul>
			</li>
			<a name="retBooks"></a>
			<li><span>List of Returned Books</span>
				<ul>
					<li>Shows the list of books previously borrowed by the user.</li>
					<li>Shows the details of the transaction(s) and the details of the book.</li>
				</ul>
			</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>


		<a name="logout"></a>
		<span>Logout</span>
		<ul>
			<li>The user can logout from his account by clicking the 'Logout' link on the upper left corner of the login screen, beside 
				the user's name.</li>
		</ul>
		<a href="#top" class="tiny">Back to Top</a>
		<br/><hr><br/>
	</body>
</html>