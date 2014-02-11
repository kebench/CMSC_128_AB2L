function autosuggest(str, category){
	if (str.length == 0) {
		$('#autosuggest_list').fadeOut(500);
		$('#sinput').removeClass('loading');
	}
	else {
	    // first show the loading animation
	    $('#sinput').addClass('loading');
	    
		// Ajax request to CodeIgniter controller "ajax" method "autosuggest"
	    // post the str parameter value
	    $.ajax({
		url: "http://localhost/ics_library_ab2l/index.php/admin/controller_search_book/autosuggest",					//no need to edit this
		type: 'POST',
		async: false,
		data:{
		'str':str,
		'category':category },
		success: function(result){
			if(result==""){				//hides the list if result is an empty string
				$('#autosuggest_list').hide();
			}else{						//displays result.
				$('#autosuggest_list').html(result);
				$('#autosuggest_list').show();
				$('#sinput').removeClass('loading');
			}
		}
		});
	}
}

// triggered by an onclick from any of the li's in the autosuggest list
// wait and fade the autosuggest list
// then display the activity details
function set_activity(activity_name) {
  $('#sinput').val(activity_name);
  setTimeout("$('#autosuggest_list').fadeOut(500);", 250);
  
  //display_activity_details(master_activity_id);
}

//get the data of the books after clicking the search button
function get_data(str){
	//document.write(str);
	$('#autosuggest_list').fadeOut(500);
	$('#list_area').addClass('loading');
		
		$.ajax({
		//url: "http://localhost/zurbano_module/index.php/controller_search_book/get_book_data",		//EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
		url: "http://localhost/ics_library_ab2l/index.php/admin/controller_search_book/get_book_data",		//EDIT THIS URL IF YOU ARE USING A DIFFERENT ONE. This url refers to the path where search/get_book_data is found
		
//		url: "http://localhost/kebench/index.php/search/get_book_data",
		type: 'POST',
		async: false,
		data: serialize_form(str),
		success: function(result){
			$('#list_area').html(result);
			$('#list_area').fadeIn(1000);
			$('#list_area').removeClass('loading');
		}
		});

}

//serializes the form enebling all the inputs to have a value of an empty string if forms.value is equal to " ".
//This will be used in sending data inputs in Ajax
function serialize_form(str)
{
	return $('#'+str+'').serialize();
}