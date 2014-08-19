var currentid='';
var currentPage = '';
var nextPage = '';
var suppressSchoolCode = false;
var teacherName = '';

var validate=false; // flag 2 prevent validation while loading

var files = new Array(
	'schoolselect.php',
	'teacherlist.php',
	'tmis_general.php',
	'tmis_sec2.php',
	'tmis_sec3.php',
	'tmis_sec4.php'
);
	
var files_desc = new Array(
	'School Selection',
	'Teachers List',
	'General Information',
	'Teaching Details',
	'Education, Training, Award, Leave',
	'Medical, Punishment, Publications, Income'
	);

var files_eval = new Array(
	'true',
	'true',
	'true',
	'true',
	'true'
);


function getRequestBody(oForm) {
    var aParams = new Array();

    for (var i=0 ; i < oForm.elements.length; i++) {
        var sParam = encodeURIComponent(oForm.elements[i].name);
        sParam += "=";
        if (oForm.elements[i].type=='radio'){
        	if (oForm.elements[i].checked==true) sParam += encodeURIComponent(oForm.elements[i].value);
			else sParam += '';
		
        }
		sParam += encodeURIComponent(oForm.elements[i].value);
		
        aParams.push(sParam);
    }
	aParams.push('tid='+currenttid);
	aParams.push('referer='+currentPage);
	

    return aParams.join("&");
}


function sendRequest(callback) {
	
	var XMLHttpRequestObject = false; 
	
	var oForm = document.forms[0];
	var sBody = getRequestBody(oForm);

	if (window.XMLHttpRequest) {
		XMLHttpRequestObject = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		XMLHttpRequestObject = new 
		ActiveXObject("Microsoft.XMLHTTP");
	}

	if(XMLHttpRequestObject) {
		XMLHttpRequestObject.open("POST", "controller.php"); 
		XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 

		XMLHttpRequestObject.onreadystatechange = function() { 
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
				callback(XMLHttpRequestObject);
				delete XMLHttpRequestObject;
				XMLHttpRequestObject = null;
			} 
		}
		XMLHttpRequestObject.send(sBody); 
	}
}

function fixYear(obj){
	if (obj.value.length==2) obj.value='20'+obj.value;
	if (obj.value.length==3) obj.value='2'+obj.value;
}

var nextPageNum = 0;

function navigation(){

	var currentJumps = new Array();
	
	var currentPageNum = 0;
	var po=0;

	for (var i=0;i<files.length;i++){
		if (files[i]==currentPage){
			po=1;
			currentPageNum = i;
			currentJumps.push(i);
			continue;
		}
		
		
		if (eval(files_eval[i])==false) continue;
		currentJumps.push(i);
		
		
		if (po==1){
			nextPageNum=i;
			po=0;
		}
		
		
	}
	
	var str="<select id='jumpmenu' onchange='if (this.value!=\"\") {nextPage=this.value; savePage(); }'>";
	
	for (i=0;i<currentJumps.length;i++){
		if (currentJumps[i]==currentPageNum) str+="<option value='' selected>"+files_desc[currentJumps[i]]+"</option>";
		else str+="<option value='"+files[currentJumps[i]]+"'>"+files_desc[currentJumps[i]]+"</option>";
	}

	str+='</select>';
	
	str += "<span style='float:right;'><strong>"+teacherName+"</strong></span>";
	
	document.getElementById('nav').innerHTML = str;
	
	if (currentPage==files[0]){
		document.getElementById('backbtn').innerHTML = "<input type='button' value='Cancel &amp; Add New' onclick=onclick='location=\"teacherlist.php?s="+currentSchool+"\"'> <input type='button' value='Save &amp; Add New' onclick=='location=\"teacherlist.php?s="+currentSchool+"\"'; if (savePage()) {alert(\"Page Saved.\"); } else alert(\"Save failed.\");'>";
	}
	else{
		document.getElementById('backbtn').innerHTML = "<input type='button' value='Save' onclick='nextPage=\"\"; if (savePage()==true) alert(\"Page saved.\"); else alert(\"Save failed.\");'> <input type='button' value='Save &amp; Add New' onclick='suppressSchoolCode=true; nextPage=\"teacherlist.php?s="+currentSchool+"\"; savePage();'> <input type='button' value='Cancel &amp; Add New' onclick='location=\"teacherlist.php?s="+currentSchool+"\"'>";
	}
	
	if (currentPage==files[files.length-1]){
		// last page
		document.getElementById('nextbtn').innerHTML = "<input id='nextbtnid' type='button' value='Save &amp; Add New' onclick='nextPage=\"teacherlist.php\"; savePage();'>";
	}
	else{
		document.getElementById('nextbtn').innerHTML = "<input id='nextbtnid' type='button' value='Next &gt;&gt;' onclick='nextPage=\""+files[nextPageNum]+"\"; savePage();'>";
	}
	
	
}

function savePage(){
	if (currentPage==files[0]){
		// you can't save page without dcode, vcode scode and school's name
		
		if (document.getElementById('sch_code').value==''){
			alert('Please select school code properly.');
			document.getElementById('sch_code').focus();
			return false;
		}
		
		if (document.getElementById('teacherName').value==''){
			alert('Please enter Name.');
			document.getElementById('teacherName').focus();
			return false;
		}
		
	}
	if((currenttid=='') && (currentPage==files[0])){
		currenttid=document.getElementById('t_id').value;
	}
	
        if(currentPage=="tmis_general.php")
        {       
                if (document.getElementById('teacherName').value==''){
			alert('Please enter Name.');
			document.getElementById('teacherName').focus();
			return false;
		}
                
                //no need to validate entire form if it is a vacant teacher
                if(document.getElementById('teacherName').value!='Vacant')
                {
                    //make name,ethnicity,type,caste,sex,level and head teacher compulsory 
                    if (document.getElementById('t_sex').value=="0"){
			alert('Please enter Sex.');
			document.getElementById('t_sex').focus();
			return false;
                    }
                    /*
                    if (document.getElementById('teacherCaste').value=="0" ){
			alert('Please enter Caste.');
			document.getElementById('teacherCaste').focus();
			return false;
                    }*/
                    if (document.getElementById('t_caste').value=="0"){
			alert('Please enter Ethnicity.');
			document.getElementById('t_caste').focus();
			return false;
                    }
                    if (document.getElementById('currPermType').value=="0"){
			alert('Please enter current position Type.');
			document.getElementById('currPermType').focus();
			return false;
                    }
                    if (document.getElementById('currPermLevel').value=="0"){
			alert('Please enter current position Level.');
			document.getElementById('currPermLevel').focus();
			return false;
                    }
                    if (document.getElementById('t_head_teacher').value=="0"){
			alert('Please choose if he/she is a Head Teacher.');
			document.getElementById('t_head_teacher').focus();
			return false;
                    }
                    if (document.getElementById('t_head_teacher').value=="1" && document.getElementById('headTeachertraining').value=="0"){
			alert('Please choose Head Teacher Training.');
			document.getElementById('headTeachertraining').focus();
			return false;
                    }
                }
                //for vacant position only the level is compulsory 
                else
                {
                    if (document.getElementById('currPermLevel').value=="0"){
			alert('Please enter current position Level.');
			document.getElementById('currPermLevel').focus();
			return false;
                    }    
                }
        }
        

	sendRequest(function (t){
		if (nextPage=='schoolselect.php'){
			var dist_code = currentSchool.substr(0,2);
			var vdc_code = currentSchool.substr(2,3);			
			window.location = nextPage+"?d="+dist_code+"&v="+vdc_code;
		}
		else{
			window.location = nextPage+"?tid="+currenttid+"&s="+currentSchool;
		}
	
	});
	
	return true;
	
}
