function validate_user()
{
var name1_regex			=	/^[A-Za-z ]{4,35}$/;
var name2_regex			=	/^[A-Za-z0-9-, ]{4,500}$/;
var username_regex		=	/^[A-Za-z0-9._ ]{4,35}$/;
var password_regex		=	/^[A-Za-z0-9._@ ]{4,100}$/;
var mobile_regex		=	/^[0-9]{6,18}$/;
var email_regex			=	/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

var name1					=	document.create_user_form.fname;
var name2					=	document.create_user_form.lname;
var phone					=	document.create_user_form.phone;
var address					=	document.create_user_form.address;
var user_name				=	document.create_user_form.user_name;
var password				=	document.create_user_form.password;
var email					=	document.create_user_form.email_id;




if(!name1.value.match(name1_regex))
{
	alert("Please enter your first name");
	return false;
}

if(!name2.value.match(name1_regex))
{
	alert("Please enter your last name");
	return false;
}

if(!phone.value.match(mobile_regex))
{
	alert("Please enter your phone number");
	return false;
}

if(!address.value.match(name2_regex))
{
	alert("Please enter your full address");
	return false;
}

if(!user_name.value.match(username_regex))
{
	alert("Please enter valid username");
	return false;
}

if(!password.value.match(password_regex))
{
	alert("Please enter valid password");
	return false;
}

if(!email.value.match(email_regex))
{
	alert("Please enter valid email id");
	return false;
}

return true;
}

function validate_password()
{
var password_regex			=	/^[A-Za-z0-9._@ ]{4,100}$/;

var user_name1				=	document.password_reset_form.user_name;
var password				=	document.password_reset_form.npassword;
var password1				=	document.password_reset_form.rpassword;


if(user_name1.value	==	"")
{
	alert("Please select username");
	return false;
}

if(!password.value.match(password_regex) || password.value	==	"")
{
	alert("Please enter valid password");
	return false;
}

if(!password1.value.match(password_regex) || password1	==	"" || password.value	!=	password1.value)
{
	alert("Password not valid or password do not match");
	return false;
}

return true;
}

