 window.onload=function(){
                regForm.adminkey.onblur=validateAdminkey;
                regForm.fname.onblur=validateFname;
                regForm.minit.onblur=validateMinitial;
                regForm.lname.onblur=validateLname;
                regForm.eadd.onblur=validateEmail;
                regForm.uname.onblur=validateUser;
                regForm.pass.onblur=validatePass;
                regForm.cpass.onblur=validateCpass;
                regForm.onsubmit=validateAll;
            }
            
    function validateFname(){
        str=regForm.fname.value;
        msg="Invalid Input: ";
        
        if (str=="") msg+="First name is required!";
        else if (!str.match(/^[A-Z|a-z|\s]{3,50}$/))  msg+="Must be between 3-50 alpha character!<br/>";
        else if(msg="Invalid input") msg="";
        document.getElementsByName("helpfname")[0].innerHTML=msg;
        if(msg=="") return true;
    }   
    function validateMinitial(){
        str=regForm.minit.value;
        msg="Invalid Input: ";
        
        if (str=="") msg+="Middle Initial is required!";
        else if (!str.match(/^[A-Z]{1,3}\.$/))  msg+="Must be between 1-3 capital alpha character ended by period!<br/>";
        else if(msg="Invalid input") msg="";
        document.getElementsByName("helpmname")[0].innerHTML=msg;
        if(msg=="") return true;
    }
    function validateLname(){
                str=regForm.lname.value;
                msg="Invalid Input: ";
                
                if (str=="") msg+="Last name is required!";
                else if (!str.match(/^[A-Z|a-z\s]{2,50}$/))  msg+="Must be between 2-50 alpha character!<br/>";
                else if(msg="Invalid input") msg="";
                document.getElementsByName("helplname")[0].innerHTML=msg;
                if(msg=="") return true;
            }
    function validateAdminkey(){
                str=regForm.adminkey.value;
                msg="Invalid Input: ";
                
                if (str=="") msg+="Admin key is required!";
                else if (!str.match(/^[A-Za-z0-9]{4,10}$/))  msg+="Must be between 4-10 alphanumeric character!<br/>";
                else if(msg="Invalid input") msg="";
                document.getElementsByName("helpadminkey")[0].innerHTML=msg;
                if(msg=="") return true;
            }
            
    function validateEmail(){
                str=regForm.eadd.value;
                msg="Invalid Input: ";
            
                if (str=="") msg+="Email is required!";
                else if (!str.match(/^(\w|\.){6,30}\@([0,9]|[a-z]|[A-Z]){3,}\./))  msg+="Must be in the form: name@domain.extension!<br/>";
                else if(msg="Invalid input") msg="";
                document.getElementsByName("helpemail")[0].innerHTML=msg;
                if(msg=="") return true;
            }
    function validateUser(){
                str=regForm.uname.value;
                msg="Invalid Input: ";
                
                if (str=="") msg+="Username is required!";
                else if (!str.match(/^[A-Z|a-z|0-9]{3,20}$/))  msg+="Must be between 3-20 alpha numeric character!<br/>";
                else if(msg="Invalid input") msg="";
                document.getElementsByName("helpusername")[0].innerHTML=msg;
                if(msg=="") return true;
            }
    
    function validatePass(){
                str=regForm.pass.value;
                msg="";

                if (str=="") msg+="Password is required!";
                else if (str.match(/^([a-z]+|\d+)$/))  msg+="Invalid Input: Strength: Weak";
                else if (str.match(/^[a-zA-z]+$/))  msg+="Invalid Input: Strength: Medium";
                else if (str.match(/^[a-zA-z0-9]+$/))  msg+="Strength: Strong";
                else if(msg="") msg="";
                document.getElementsByName("helppassword")[0].innerHTML=msg;
                if(msg=="Strength: Strong") return true;
        }       
    function validateCpass(){
            str=regForm.pass.value;
            str2=regForm.cpass.value;
            msg="Invalid Input: ";
            
            if(str2=="") msg+="Confirmation of password is required!";
            else if (str2!=str){
                msg+="Password Mismatch"
            }
            else if(msg="") msg="";
            document.getElementsByName("helpcpassword")[0].innerHTML=msg;
            return true;
        }
    function validateAll(){
        if(validateFname()&&validateMinitial()&&validateLname()&&validateNumber()&&/*validateCollege()&&validateCourse()&&
           validateClassification()&&*/validateEmail()&&validateUser()&&validatePass()&&validateCpass())
        {
            return true;
        }
        else{return false;}
    }

    
       $( document ).ready(function(){   
       
         window.getResult =     function (name){
               // var baseurl = <?php echo base_url()?>;
               var bool= false;
                $('#span_un').append("<span id = 'helpusername'></span>");
                $("#helpusername").text("Checking availability...");
                $.ajax({
                    url : base_url + 'index.php/user/controller_editprofile/check_username/' + name,
                    cache : false,
                    async:false,
                    success : function(response){

                        $('#helpusername').delay(1000).removeClass('preloader');
                        if(response == 'userOk'){
                            $('#helpusername').removeClass('userNo').addClass('userOk');
                            $('#helpusername').text("Username available!");
                            
                          bool= true;
                        }
                        else{
                            $('#helpusername').removeClass('userOk').addClass('color-red');;
                            $("#helpusername").text("Username not available.");
                           bool= false;
                        }
                    }
                })

              
                return bool;

            }
       })
   