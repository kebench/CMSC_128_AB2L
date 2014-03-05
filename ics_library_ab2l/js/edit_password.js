    var toggle="false";
       $( document ).ready(function(){   
       if(toggle == "false"){
        $('#form_password').hide();
       }
         //for checking if the new username already exist
          $('#current_password').on('blur', validate_password);
           $('#new_password').on('blur', validate_new_password);
           $('#confirm_password').on('blur', validate_confirm_password);


   window.validate_passwords = function() { 

        if(validate_password() && validate_new_password() && validate_confirm_password()){
            return true;
        }
        else return false;
   }

 
         function validate_password(){
               str=$("#current_password").val();
                msg="";

                if (str=="") msg+="Password is required!";
               
                else if(msg="") msg="";
                $("#helppassword").text(msg);
                if(msg!= "Password is required!") return true;
                else return false;
        }  

        function validate_new_password(){
                str=$("#new_password").val();
                msg="";

                if (str=="") msg+="Password is required!";
                else if (str.match(/^[a-z]{5,20}$/))  msg+="Strength: Weak";
                else if (str.match(/^[a-zA-Z]{5,20}$/))  msg+=" Strength: Medium";
                else if (str.match(/^[a-zA-z0-9]{5,20}$/))  msg+="Strong";
                else if(msg="") msg="";
                $("#helpnewpassword").text(msg);
                if(msg!= "Password is required!") return true;
                else return false;
        }       
    function validate_confirm_password(){
            str=$("#new_password").val();
            str2=$("#confirm_password").val();
            msg="Invalid Input: ";
            
            if(str2=="") msg+="Confirmation of password is required!";
            else if (str2!=str){
                msg+="Password Mismatch"
            }
            else if(msg="") msg="";
            $("#helpcpassword").text(msg);
            return true;
        }     

       
         $("#edit_password").click(function(){      
          
           if(toggle== false){
               $('#form_password').slideDown();
               toggle= true
           }
           else{
                 $('#form_password').slideUp();
                 toggle= false;
           }

        });
         //cancel edit email
         $("#cancel_password").click(function(){
            toggle= false;
             $('#form_password').slideUp();
        
        });


          

      });