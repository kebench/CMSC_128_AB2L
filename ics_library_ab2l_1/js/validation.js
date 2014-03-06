

//validate user login fields (username and password)

function validate_login(){
	
	username= user_login.username.value;
	password= user_login.password.value;
	errorusername= "Invalid characters";
	

	if(username.match(/^[A-Za-z][A-Za-z0-9]+$/)){
	
		return true;
	}
	else{
		document.getElementById('helpusername').innerHTML= errorusername;
		
	}
	
	return false;
}

function validate_admin_key(){
	
	admin_key= admin_login.admin_key.value;
	errorusername= "Invalid characters";
	

	if(admin_key.match(/^[A-Za-z0-9]{8}$/)){
	
		return true;
	}
	else{
		document.getElementById('helpadminkey').innerHTML= errorusername;
		
	}
	
	return false;
}


//validate admin login fields (username and password)

function validate_admin_login(){
	
	username= admin_login.username.value;
	password= admin_login.password.value;
	errorusername= "Invalid characters";
	

	if(username.match(/^[A-Za-z][A-Za-z0-9]+$/)){
		
		return true;
	}
	else{
		
		document.getElementById('helpusername2').innerHTML= errorusername;
	}
	
	return false;
}

//Registration validation
function disabler(){
var courseBox = document.getElementById('course');
var collegeBox = document.getElementById('college');
var NumBox = document.getElementById('stdNum');

courseBox.disabled = true;
collegeBox.disabled = true;
NumBox.disabled = true;
}

function checker(){
var selected = document.getElementById('classi').value;
var collegeBox = document.getElementById('college')
var NumBox = document.getElementById('stdNum');
var NumLabel = document.getElementById('labelNum');


if(selected === 'faculty'){
	collegeBox.disabled = false;
	NumBox.disabled = false;
	NumLabel.innerHTML = 'Faculty Number: ';
}
else{
	collegeBox.disabled = false;
	NumBox.disabled = false;
	NumLabel.innerHTML = 'Student Number: ';
}
//alert(checker);
}
function courseChecker(){
var selected = document.getElementById('college').value;
var obj = document.getElementById('course')
obj.disabled = false;
var length = obj.options.length;

while (obj.hasChildNodes())
    obj.removeChild(obj.firstChild);


if(selected === 'CA'){
	obj.options[obj.options.length] = new Option("BSA","BSA");
	obj.options[obj.options.length] = new Option("BSFT","BSFT");
	obj.options[obj.options.length] = new Option("BSAB","BSAB");
	obj.options[obj.options.length] = new Option("BSAC","BSAC");
	
}
else if(selected === 'CAS'){
	obj.options[obj.options.length] = new Option("BACA","BACA");
	obj.options[obj.options.length] = new Option("BA Philo","BA Philo");
	obj.options[obj.options.length] = new Option("BA Socio","BA Socio");
	obj.options[obj.options.length] = new Option("BS AMATH","BS AMATH");

	obj.options[obj.options.length] = new Option("BS APHY","BS APHY");
	obj.options[obj.options.length] = new Option("BS BIO","BS BIO");
	obj.options[obj.options.length] = new Option("BS CHEM","BS CHEM");
	obj.options[obj.options.length] = new Option("BSCS","BSCS");

	obj.options[obj.options.length] = new Option("BS MATH","BS MATH");
	obj.options[obj.options.length] = new Option("BS MST","BS MST");
	obj.options[obj.options.length] = new Option("BS STAT","BS STAT");
}
else if(selected === 'CDC'){
	obj.options[obj.options.length] = new Option("BSDC","BSDC");
}
else if(selected === 'CEAT'){
	obj.options[obj.options.length] = new Option("BS ABE","BS ABE");
	obj.options[obj.options.length] = new Option("BSChemE","BSChemE");
	obj.options[obj.options.length] = new Option("BSCE","BSCE");
	obj.options[obj.options.length] = new Option("BSEE","BSEE");

	obj.options[obj.options.length] = new Option("BSIE","BSIE");
}
else if(selected === 'CEM'){
	obj.options[obj.options.length] = new Option("BS AE","BS AE");
	obj.options[obj.options.length] = new Option("BSE","BSE");
	obj.options[obj.options.length] = new Option("BSAM","BSAM");

}
else if(selected === 'SESAM'){
	obj.options[obj.options.length] = new Option("PhD EnSci","PhD EnSci");
	obj.options[obj.options.length] = new Option("MS EnSci","MS EnSci");
}
else if(selected === 'CFNR'){
	obj.options[obj.options.length] = new Option("BSF","BSF");

}
else if(selected === 'CHE'){
obj.options[obj.options.length] = new Option("BSHE","BSHE");
obj.options[obj.options.length] = new Option("BSN","BSN");

}
else if(selected === 'GS'){

}
else if(selected === 'CPaf'){

}
else if(selected === 'CVM'){
obj.options[obj.options.length] = new Option("DVM","DVM");
obj.options[obj.options.length] = new Option("MSVM","MSVM");
obj.options[obj.options.length] = new Option("MSV","MSV");
}


//alert(checker);
}