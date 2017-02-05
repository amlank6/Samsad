function validate_password()
{
var password_regex			=	/^[A-Za-z0-9._@ ]{4,100}$/;

var password				=	document.password_reset_form.npassword;
var password1				=	document.password_reset_form.rpassword;



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

function validate_recharge()
{	
	var mail_regex				=	/^[0-9]{2,7}$/;
	var day_regex				=	/^[0-9]{1,7}$/;
	var new_mail_send_limit		=	document.recharge_account_form.new_mail_send_limit;
	var new_subscription_date	=	document.recharge_account_form.new_subscription_date;
	var new_days_limit			=	document.recharge_account_form.new_days_limit;
	
if(!new_mail_send_limit.value.match(mail_regex) || new_mail_send_limit.value	==	"")
{
	alert("Please enter valid mail send limit");
	return false;
}

if(new_subscription_date.value	==	"")
{
	alert("Please enter subscription date");
	return false;
}

if(!new_days_limit.value.match(day_regex) || new_days_limit.value	==	"")
{
	alert("Please enter valid day limit");
	return false;
}

return true;
}