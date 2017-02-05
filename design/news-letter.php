
<script>
function MM_findObj(n, d) { //v4.01
var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
if (val) { nm=val.name; if ((val=val.value)!="") {
if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
} else if (test!='R') { num = parseFloat(val);
if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
min=test.substring(8,p); max=test.substring(p+1);
if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
} if (errors) alert('The following error(s) occurred:\n'+errors);
document.MM_returnValue = (errors == '');
}

</script>
<section class="leftbottom-wrap1">
<div class="leftbox">
<h1>subscribe To our newsletter</h1>
<div class="left-innerbox">
<p class="newsletter">Subscribe to our newsletter to get update news & special offers of our company</p>

<form action="#" method="post" name="news_letter_form" onsubmit="MM_validateForm('Name','','R','Email','','RisEmail');return document.MM_returnValue">
<div class="news-formbox"><input type="text" class="news-inputbox" name="Name" value="Enter Your name"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" /></div>

<div class="news-formbox"><input type="text" class="news-inputbox" name="Email" value="Enter Your Email Id"  onFocus="if(this.value==this.defaultValue)this.value='';" onBlur="if(this.value=='')this.value=this.defaultValue;" /></div>

<div class="news-button"><input type="submit" name="news_letter" class="news-buttonbox" value="subscribe" /></div>
</form>
</div>
</div>

</section>