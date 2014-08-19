
function handleKeyDown(obj, event){
	if (obj.name.indexOf("st")==0){
		var currenttype=parseInt(obj.name.substring(3,4));
		var currentclass=parseInt(obj.name.substring(5));

	
		var keychar;
		
		if(window.event)
			keychar=window.event.keyCode;
		else if(event)
			keychar=event.which;

		switch(keychar) {
			case 38: //up arrow
				currenttype--;
				if (currenttype<1) currenttype=9;
				break;
			case 40: //down arrow 
				currenttype++;
				if (currenttype>9) currenttype=1;			
				break;
			case 37: //left
				currentclass--;
				if (currentclass<1) currentclass=12;
				break;
			case 39: //right 
				currentclass++;
				if (currentclass>12) currentclass=1;			
				break;
		}
		document.getElementById("st_"+currenttype+"_"+currentclass).focus();
		
		
	}
}

function loadSelect(f){
	
	$.get("entrybe.php",
		{ r:f },
		function(data){
			var parts = data.split('~');
			
			for (i=0;i<parts.length;i++){
				addToSelect(f,parts[i]);
				
			}
			
						
		}
	);
}

function addToSelect(f,v,file,sel){
	
		
	
	var l=document.getElementById(f);

	var last = l.options.length;
	
	if (sel=="undefined") sel=false;
	
	l.options[last] = new Option(v,v,false,sel);

	//ajaxRequest('flash1backend.php?req=writemenutofile&file='+file+'&val='+v);
	
	focusNext(f);
	
}


function handlechange(o,e){
	
	if (o.id=='first_name') beautify(o);
	if (o.id=='year_of_birth') {
		fixYear(o);
		$('#age').attr('value',currentyear-o.value);
	}
	if (o.id=='adm_year') fixYear(o);
	
	if (o.id.indexOf('Year')>=0 || o.id.indexOf('year')>=0){
		fixYear(o);
		blinkConst(o.id,currentyear,"Invalid year");
	}
	
	if (o.id == 't_firstAppMonth') blinkConst(o.id, 12, "Invalid month");
	if (o.id == 't_firstAppDay') blinkConst(o.id, 32, "Invalid day");
	
	
	
	
}

function handlekeypress(o,e){
	number_fields=" ";
}

function addNew(f,file){
	jQuery.facebox(function() {
		$.get("entrybe.php", { r:"addnewhtml",d:f, w:file}, 
		function(data) {
			$.facebox(data);
			$('#newval').focus();
		})
	});
	
}

