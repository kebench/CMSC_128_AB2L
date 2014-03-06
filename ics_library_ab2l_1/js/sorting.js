//get the data of the books after clicking the search button
function get_data1(){	
		$.ajax({
		//url: "http://localhost/zurbano_module/index.php/controller_search_book/get_book_data",		//EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
		url: base_url+"index.php/user/controller_books/get_book_data1",		//EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
		
		type: 'POST',
		async: false,
		data: serialize_form1(),
		success: function(result){
			$('#change_here').html(result);
			$('#change_here').fadeIn(1000);
			$('#change_here').removeClass('loading');
		}
		});

}

function serialize_form1()
{
//	document.write(str);
	return $("#sort_list").serialize();
}


