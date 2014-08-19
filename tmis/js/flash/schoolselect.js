// autocomplete arrays
var currentSchoolNameList = new Array();
var currentSchoolCodeList = new Array();

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

function schoolTypeV(obj){

	// check if checked class is valid or not
	
	var currenttype=parseInt(obj.name.substring(3,4));
	var currentclass=parseInt(obj.name.substring(5));
	
	var str="";
	// unchecked		
	if (obj.checked == false){
	

		for (i=currentclass+1;i<=12;++i){
		
			for (j=1;j<=9;++j){
				//str+=(" st_"+j+"_"+i);
		
				document.getElementById("st_"+j+"_"+i).checked = false;
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
		
	for (i=1;i<=12;++i){
		classes[i]=0;				
		for (j=1;j<=9;++j){
			
			if (document.getElementById("st_"+j+"_"+i).checked == true){
				classes[i]=j;
				break;			
			}
					
		}	
	}
	
	navigation();
}

function initialize(){
	ajaxRequest('flash1backend.php?req=distlist',distCallback);

	for (i=0;i<=12;++i) classes[i]=0;
	
	//schAutoComplete = new AutoSuggestControl(document.getElementById("sch_name"), schSuggest);
	
	//resetAll();
	
	//navigation();
	
}

function distCallback(t){
	document.getElementById('divdistrict').innerHTML = t.responseText;
	
	if (currentSchoolCode!=''){
		document.getElementById('distlist').value = currentSchoolCode.substring(0,2);
		districtChange();
	}
	else{
	
		if (prevdcode!=''){
			document.getElementById('distlist').value = prevdcode;
			districtChange();
		}
	}

}

function vdcCallback(t){
	document.getElementById('divvdc').innerHTML = t.responseText;
	
	if (currentSchoolCode!=''){
		document.getElementById('vdclist').value = currentSchoolCode.substring(2,5);
		vdcChange();
	}
	else{
		
		if (prevvcode!=''){
			document.getElementById('vdclist').value = prevvcode;
			vdcChange();
		}	
	}

}


function districtChange(){
	
	ajaxRequest('flash1backend.php?req=vdclist&distcode='+document.getElementById('distlist').value, vdcCallback);
	
	document.getElementById('sch_dcode').value=document.getElementById('distlist').value;
	
	resetAll();
}

function vdcChange(){
	

	
	document.getElementById('sch_vcode').value=document.getElementById('vdclist').value;
	
	if (currentSchoolCode=='') ajaxText('flash1backend.php?req=newschoolcode&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value, 'sch_code');

	var o='';
	if (document.getElementById('ordername').checked) o='name';
	if (document.getElementById('ordercode').checked) o='code';
	
	ajaxDiv('flash1backend.php?req=schoollist_e&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&order='+o, 'schoollist_e');
	ajaxDiv('flash1backend.php?req=schoollist_ne&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&order='+o, 'schoollist_ne');
	
	/*
	ajaxRequest('flash1backend.php?req=schoolsuggest&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value, 
		function(t){
			schSuggest.fillSchool(t.responseText);
			if (currentSchoolCode!=''){
				loadSchool(currentSchoolCode);
				currentSchoolCode='';
			}
		}
	);	
	*/	
	
	//resetAll();
	

}

function sortOrderChange(){

	if (document.getElementById('distlist').value!='' && document.getElementById('vdclist').value!=''){
		var o='';
		if (document.getElementById('ordername').checked) o='name';
		if (document.getElementById('ordercode').checked) o='code';
		
		ajaxDiv('flash1backend.php?req=schoollist_e&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&order='+o, 'schoollist_e');
		ajaxDiv('flash1backend.php?req=schoollist_ne&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value+'&order='+o, 'schoollist_ne');
		
	}
}

function loadSchool(a){

	resetAll();
	document.getElementById('schoollist').className='divhide';

	// load page1
	ajaxRequest('flash1backend.php?req=loadschool&schoolcode='+a, loadSchoolMain);
	
	currentSchoolNameList = [];
	currentSchoolCodeList = [];
	
	document.getElementById('sch_name').readOnly=true;
	
}

function loadSchoolMain(t){

	var data=t.responseText.split('~');
	document.getElementById('sch_name').value=data[0];
	document.getElementById('sch_add').value=data[1];
	document.getElementById('sch_ward').value=data[2];
	document.getElementById('sch_region').value = data[3];
	document.getElementById('sch_phone').value=data[4];
	document.getElementById('sch_email').value=data[5];
	document.getElementById('sch_code').value=data[6];
	
	// school type data
	for (i=0;i<=12;++i){
		if (data[7+i]>0 && data[7+i]<=9) document.getElementById("st_"+data[7+i]+"_"+i).checked = true;
	}
	
	updateclasses();
	
	beautify(document.getElementById('sch_name'));
	beautify(document.getElementById('sch_add'));
	

	document.getElementById('sch_add').focus();
	document.getElementById('sch_add').select();
	

}

function resetAll(){
	var d, v, d1, v1, s;
	
	return;
	
	d=document.getElementById('distlist').value;
	v=document.getElementById('vdclist').value;
	d1=document.getElementById('sch_dcode').value;
	v1=document.getElementById('sch_vcode').value;	
	s=document.getElementById('sch_code').value;
	
	document.forms[0].reset();
	
	document.getElementById('distlist').value=d;
	document.getElementById('vdclist').value=v;
	document.getElementById('sch_dcode').value=d1;
	document.getElementById('sch_vcode').value=v1;	
	document.getElementById('sch_code').value=s;
	
	document.getElementById('sch_name').readOnly = false;
	
	document.getElementById('sch_name').focus();
	if (document.getElementById('sch_name').readOnly == true) document.getElementById('sch_add').focus();
	
	
}


function schoolSelect(o){
	
	if (o.id=='slist_e') document.getElementById('slist_ne').selectedIndex = '-1';
	if (o.id=='slist_ne') document.getElementById('slist_e').selectedIndex = '-1';
	
	document.getElementById('s').value = o.value;
	
	document.getElementById('submitbtn').disabled = false;
	
}

function showExisting(){
	document.getElementById('existingschool').className='';
	document.getElementById('newschool').className='divhide';
	document.getElementById('sorttype').className='';
	
	// change menu colors
	document.getElementById('menuexistingschool').className='activenavitab';
	document.getElementById('menunewschool').className='navitab';
	
	
}

function showAddNewSchool(){
	document.getElementById('existingschool').className='divhide';
	document.getElementById('newschool').className='';
	document.getElementById('sorttype').className='divhide';
	document.getElementById('sn').focus();
	
	// change menu colors
	document.getElementById('menuexistingschool').className='navitab';
	document.getElementById('menunewschool').className='activenavitab';	
	
	
	
}

function newSchoolValid(){
	if (document.getElementById('distlist').value =='') {alert('Select District'); return false;}
	if (document.getElementById('vdclist').value =='') {alert('Select VDC'); return false;}
	if (document.getElementById('sn').value =='') {alert('Enter School Name'); document.getElementById('sn').focus(); return false;}
	
	return true;
}