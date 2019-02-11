function myfun()
{
    var UserName=document.getElementsByName('username').value;
    var UserEmail=document.getElementsByName('email').value;
    var UPass=document.getElementsByName('password_1').value;
    var UCPass=document.getElementsByName('password_2').value;

    if(UserName=="")
    {
        document.getElementsByClassName('erroru').innerHTML="Please Enter the User Name";
    }
    else if (UserName!="")
    {
        document.getElementsByClassName('erroru').innerHTML="";
    }
    if(UserEmail=="")
    {
        document.getElementsByClassName('errore').innerHTML="Please Enter Ur Email";
    }
    else if (UserEmail!="")
    {
        document.getElementsByClassName('errore').innerHTML="";
    }

    if(UPass=="")
    {
        document.getElementsByClassName('errorp').innerHTML="Please Enter UR Password";
    }
    else if(UPass!="")
    {
        document.getElementsByClassName('errorp').innerHTML="";
    }

    if(UCPass=="")
    {
        document.getElementsByClassName('errorps').innerHTML="Please Enter Confirm Pass";
    }
    else if(UCPass!="")
    {
        document.getElementsByClassName('errorps').innerHTML="";
    }

    if(UPass!=UCPass)
    {
        document.getElementsByClassName('errorps').innerHTML="Please Enter Confirm Password"
    }
   // else if(UserName!="" && UserEmail!="" && UPass!="" && UCPass!="")
   // {
     //   document.getElementById('Success').innerHTML=" You Have Successfully Register";
     //   window.location=('index.php');
   // }
}