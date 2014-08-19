// autocomplete arrays
var currentSchoolNameList = new Array();
var currentSchoolCodeList = new Array();

function handleChange(obj){
	if (obj.name=='estd_y') {
		var maxYearMinus = 100;
		fixYear(obj);
		blinkConstRange('estd_y',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
	}
	
	if (obj.name=='estd_m') blinkConst('estd_m',12,"Month cant be greater than 12");
	if (obj.name=='estd_d') blinkConst('estd_d',32,"Number of days should be less or equal to 32");
	
	if (obj.name=='hseb_estd_y') {
		var maxYearMinus = 100;
		fixYear(obj);
		blinkConstRange('hseb_estd_y',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
	}
	
	if (obj.name=='hseb_estd_m') blinkConst('hseb_estd_m',12,"Month cant be greater than 12");
	if (obj.name=='hseb_estd_d') blinkConst('hseb_estd_d',32,"Number of days should be less or equal to 32");	
	
	
}

function handleKeyDown(obj, event){
	if (obj.name.indexOf("st")==0){
		
		var firstmark = obj.name.indexOf('_');
		var lastmark = obj.name.lastIndexOf('_');
		
		var currenttype=parseInt(obj.name.substring(firstmark+1,lastmark));
		var currentclass=parseInt(obj.name.substring(lastmark+1));

	
		var keychar;
		
		if(window.event)
			keychar=window.event.keyCode;
		else if(event)
			keychar=event.which;

		switch(keychar) {
			case 38: //up arrow
				currenttype--;
				if (currenttype<1) {currenttype=12; while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currenttype--;}
				while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currenttype--;
				break;
			case 40: //down arrow 
				currenttype++;
				if (currenttype>12) {currenttype=1; while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currenttype++;}		
				while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currenttype++;
				break;
			case 37: //left
				currentclass--;
				if (currentclass<0) {currentclass=12; while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currentclass--;}
				while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currentclass--;
				break;
			case 39: //right 
				currentclass++;
				if (currentclass>12) {currentclass=0; while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currentclass++;}		
				while(document.getElementById("st_"+currenttype+"_"+currentclass).disabled==true) currentclass++;
				break;
		}
		document.getElementById("st_"+currenttype+"_"+currentclass).focus();
		
		
	}
}

function schoolTypeV(obj){

	// check if checked class is valid or not
	
		
	var firstmark = obj.name.indexOf('_');
	var lastmark = obj.name.lastIndexOf('_');
	
	var currenttype=parseInt(obj.name.substring(firstmark+1,lastmark));
	var currentclass=parseInt(obj.name.substring(lastmark+1));


	var str="";
	// unchecked		
	if (obj.checked == false){
	

		for (i=currentclass+1;i<=12;++i){
		
			for (j=1;j<=12;++j){
				if (!document.getElementById("st_"+j+"_"+i).disabled) document.getElementById("st_"+j+"_"+i).checked = false;
			}
				
		}	
		updateclasses();
		obj.focus();
		return true;
	}
	
	//alert(currenttype);
	//alert(currentclass);
	
	// check for boundary classes		
	if (currentclass==0 || currentclass==1 || currentclass==6 || currentclass==9 || currentclass==11){

		// for school starting from 6, 9 or 11, there shouldn't be any classes before			
		if (currentclass==6 || currentclass==9 || currentclass==11){
			if (classes[currentclass-1]==0){
				if (currentclass==6){
					if (classes[1]>0) {return false;}
				}				
				if (currentclass == 9){
					if (classes[1]>0 || classes[6]>0) {return false;}					
				}
				if (currentclass == 11){
					if (classes[1]>0 || classes[6]>0 || classes[9]>0) {return false;}					
				}
			}			
		
		}
		
		
		// if already ticked
		if (classes[currentclass]>0){
			
			// remove it
			document.getElementById("st_"+classes[currentclass]+"_"+currentclass).checked = false;
			
			// also remove all trailing checks
			var en=0;
			for (i=currentclass;i<=12;++i){
				document.getElementById("st_"+classes[currentclass]+"_"+i).checked = false;
			}
			
		}
		updateclasses();
		obj.focus();
		return true;
	}
	else{
		if (classes[currentclass-1]==0 || classes[currentclass-1]!=currenttype) {return false;}
		else{
			updateclasses();
			obj.focus();
			return true;
		} 		
	}

	
	
	return true;
		

}

function updateclasses(){
	var i,j;
		
	for (i=0;i<=12;++i){
		classes[i]=0;				
		for (j=1;j<=12;++j){
			
			if (document.getElementById("st_"+j+"_"+i).checked == true){
				classes[i]=j;
				break;			
			}
					
		}	
	}
	
	
	if (classes[11]>0) document.getElementById("hseb_div").className='divshow ewTable';
	else document.getElementById("hseb_div").className='divhide';
	
	document.getElementById("slc_board_code").disabled = (classes[10]==0?true:false);
	
	
	navigation();
}


function validatePage(){
	if (document.getElementById('sch_region').value=='0'){
		alert('Please select school\'s region.');
		document.getElementById('sch_region').focus();
		return false;
	}
	
	if (document.getElementById('slc_board_code').value!='' && document.getElementById('slc_board_code').value.length!=5){
		alert('Invalid SLC Code. Should be 5 digit.');
		document.getElementById('slc_board_code').focus();
		return false;
		
	}
	
	if (document.getElementById('hseb_code').value!='' && document.getElementById('hseb_code').value.length!=4){
		alert('Invalid HSEB Code. Should be 4 digit.');
		document.getElementById('hseb_code').focus();
		return false;
		
	}	
	
	return true;
}
