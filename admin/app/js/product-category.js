function validate_payment_step1()
{
var name1_regex			=	/^[A-Za-z ]{4,35}$/;
var name2_regex			=	/^[A-Za-z0-9-, ]{4,500}$/;
var username_regex		=	/^[A-Za-z0-9._ ]{4,35}$/;
var password_regex		=	/^[A-Za-z0-9._@ ]{4,100}$/;
var mobile_regex		=	/^[0-9]{6,18}$/;
var email_regex			=	/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

var name1				=	document.p_tabs_1_form.Name;
var Author				=	document.p_tabs_1_form.Author;
var Inventory			=	document.p_tabs_1_form.Inventory;
var Root-Category		=	document.p_tabs_1_form. Root-Category;
var Sub-Category		=	document.p_tabs_1_form.Sub-Category;

if(name1.value	==	"")
{
	alert("Please enter valid full name");
	return false;
}

if(!email_id.value.match(email_regex) || email_id.value	==	"Email Id*")
{
	alert("Please enter valid email id");
	return false;
}

if(!contact_no.value.match(mobile_regex))
{
	alert("Please enter valid phone number");
	return false;
}

if(document.getElementById("address").value == "" || document.getElementById("address").value 	==	"Addresss 1*")
{
	alert("Please enter address");
	return false;
}

if(city.value	==	"" || city.value	==	"City*")
{
	alert("Please enter city");
	return false;
}
if(!postal_code.value.match(mobile_regex))
{
	alert("Please enter valid postal code");
	return false;
}

if(country.value	==	"" || country.value	==	"Country*")
{
	alert("Please enter country");
	return false;
}

if(state.value	==	"" || state.value	==	"State*")
{
	alert("Please enter state");
	return false;
}


return true;
}

function getradiovalue(radio_group) 
{
	for (var i = 0; i < radio_group.length; i++) 
	{
		var button = radio_group[i];
		if (button.checked) 
		{
		return button.value;
		}
	}
	return undefined;
}

