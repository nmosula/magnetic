function number_format( number, decimals, dec_point, thousands_sep ) {	// Format a number with grouped thousands
	var i, j, kw, kd, km;

	// input sanitation & defaults
	if( isNaN(decimals = Math.abs(decimals)) ){
		decimals = 2;
	}
	if( dec_point == undefined ){
		dec_point = ",";
	}
	if( thousands_sep == undefined ){
		thousands_sep = ".";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

	if( (j = i.length) > 3 ){
		j = j % 3;
	} else{
		j = 0;
	}

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	//kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


	return km + kw + kd;
}

function valid_zminna(name_pole)
{
	var fff=name_pole;
	var ddd;
	var myRegExp=/[a-zA-Z]/gi;
	ddd = fff.value;
	ddd = ddd.replace(myRegExp,"");
	if (ddd=="") ddd="0";
	
	if ((ddd!="") && (isNaN(ddd)==true)) ddd="0";
	
//	ddd=parseFloat(ddd);
	fff.value = desyata(ddd);
	ddd  = fff.value;
	fff.value = desyata2(ddd);
}

function okrugl_zminna(name_pole)
{
	var fff=name_pole;
	var ddd;
	var myRegExp=/[a-zA-Z]/gi;
	ddd  = fff.value;
	ddd = ddd.replace(myRegExp,"");
	if (ddd=="") ddd="0";
	if ((ddd!="") && (isNaN(ddd)==true)) ddd="0";
	new_ddd = ddd.indexOf(",");
	if (new_ddd!="-1") 
	{
		ddd  = ddd.replace(",",".");
	}
	fff.value=Math.round(ddd);
}


function desyata (zminna)
{
	var ddd, new_ddd;
	ddd=zminna;
	new_ddd = ddd.indexOf(",");
	if (new_ddd!="-1") 
	{
		ddd  = ddd.replace(",",".");
	}
	
	ddd=Math.round(ddd*100) / 100;
	return ddd;
}

function desyata2 (zminna)
{
	var ddd, new_ddd;
	ddd=zminna;

	new_ddd = ddd.indexOf(".");
		if (new_ddd=="-1")
			ddd = ddd + ".00";
		else
			ddd = ddd + "00";
	new_ddd = ddd.indexOf(".");
	new_ddd=new_ddd+3;
	ddd = ddd.substr(0,new_ddd);

	return ddd;
}

function valid_cina()
{
	var fff=document.changeinfo;
	var ddd, popalo, new_ddd, new_d;
	ddd  = fff.cina.value;
	fff.cina.value=desyata(ddd);
	
	ddd  = fff.cina.value;
	fff.cina.value=desyata2(ddd);

}


function CH_garbage(){
for (i=0;i<forma_garbage.length;i++)
{
	if(forma_garbage.elements[i].name=="newid[]")
	{
		if (forma_garbage.elements[i].checked == true)
		{
			forma_garbage.elements[i].checked = false;
		}
		else
		{
			forma_garbage.elements[i].checked = true
		};
	}

}
}

function CH(){
for (i=0;i<forma.length;i++)
{
	if(forma.elements[i].name=="newid[]")
	{
		if (forma.elements[i].checked == true)
		{
			forma.elements[i].checked = false;
		}
		else
		{
			forma.elements[i].checked = true
		};
	}

}
}


function textCounter(field, countfield, maxlimit)
{
if (field.value.length > maxlimit)
field.value = field.value.substring(0, maxlimit);
else 
countfield.value = maxlimit - field.value.length;
}


function check_kilk_in_garbage(kilk, max_kilk)
{
if (kilk.value=="")
	{
	kilk.value="0";
	}
if ((kilk.value!="") && (isNaN(kilk.value)==true))
	{
		alert ("Кількість введіть числом");
		window.document.listing.kilk.focus();
		window.document.listing.kilk.select();
		return false;
	}

if (kilk.value>max_kilk)
	{
		alert ("Максимальна кількість товару - " + max_kilk);
		kilk.focus();
		kilk.select();
		return false;
	}
return true;
}

function addgarbage(id_tovar)
{
	var winTop = (screen.height / 2) - 250;
	var winLeft = (screen.width / 2) - 300;
	window.open('/garbage_short.php?status=short&new='+id_tovar+'&kilk_in_garbage='+document.listing.elements['kilk_in_garbage['+id_tovar+']'].value+'','koshk','status=yes,scrollbars=yes,width=600,height=450, left=' + winLeft + ', top=' + winTop + ', resizable=no','alwaysRaised');
}

function check_garbage_submit()
{
	if (confirm ("Оформити замовлення?")) {
		document.location.replace ("/insert_order.php");
	}
}
