// vars to monitor class type
var currentSchoolCode = '';
var classes = new Array(13);
var ecds = new Array(6);
var currentPage = '';
var nextPage = '';
var currentYear = 2066;

var maxYearMinus = 100; // years beyond this are not acceptable

var nextPageNum = 0;
var currentPageNum = 0;
var nextPageExtraOption = '';  // used in savePage()

var validate=false; // flag 2 prevent validation while loading

var autoFill = true; // autofill feature on by default

var TD = "Number of dalits should be less or equal to total.";
var TJ = "Number of janjatis should be less or equal to total.";
var TO = "Number of others should be less or equal to total.";


var files = new Array(
	'schoolselect.php',
	'basicinfo.php',
	'ecd.php',
	'alternate.php',
	'enrollment.php',
	'avgmarks.php',
	'scholarship.php',
	'teachers.php',
	'teacher_training.php',
	'schoolprogram.php',
	'schoolphysical.php'
);
	
var files_desc = new Array(
	'School Selection',
	'Basic Information',
	'ECD Details',
	'SOP/FSP Details',
	'Enrollment',
	'Average Marks',
	'Scholarship',
	'Teachers Information',
	'Teachers Training',
	'School Information - Programs',
	'School Information - Physical'
);

var files_eval = new Array(
	'true',
	'true',
	'classes[0]>0',
//	'classes[1]==11 || classes[6]==11',
	'true',
	'true',
	'true',
	'true',
	'true',
	'true',
	'true'
);

var autoFillPages = new Array(
	'ecd.php',
	'alternate.php',
	'enrollment.php', 
        'avgmarks.php',
	'schoolprogram.php',
	'schoolphysical.php',
	'schoolinfo3.php', 
        'scholarship.php', 
//	'buildings.php', 
	'teachers.php',
	'teacher_training.php'
);




function getRequestBody(oForm) {
    var aParams = new Array();

    for (var i=0 ; i < oForm.elements.length; i++) {
        var sParam = encodeURIComponent(oForm.elements[i].name);
        sParam += "=";
        if (oForm.elements[i].type=='checkbox'){
			if (oForm.elements[i].checked==true) sParam += encodeURIComponent(oForm.elements[i].value);
			else sParam += '0';
		
        }else{
			sParam += encodeURIComponent(oForm.elements[i].value);
		}
		
        aParams.push(sParam);
    }
	aParams.push('schoolcode='+currentSchoolCode);
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


function ajaxDiv(url, targetdiv)
{ 
  var XMLHttpRequestObject = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObject = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObject) {
	//alert(url);
    XMLHttpRequestObject.open("GET", url); 
    

    XMLHttpRequestObject.onreadystatechange = function() 
    { 
    if (XMLHttpRequestObject.readyState == 4 && 
		XMLHttpRequestObject.status == 200) { 
          write2div(XMLHttpRequestObject.responseText, targetdiv); 
          delete XMLHttpRequestObject;
          XMLHttpRequestObject = null;
      } 
    } 
    XMLHttpRequestObject.send(null); 
  }
}

function ajaxText(url, targetdiv)
{ 
  var XMLHttpRequestObject = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObject = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObject) {
	//alert(url);
    XMLHttpRequestObject.open("GET", url); 
    

    XMLHttpRequestObject.onreadystatechange = function() 
    { 
	if (XMLHttpRequestObject.readyState == 4 && 
      XMLHttpRequestObject.status == 200) { 
          write2text(XMLHttpRequestObject.responseText, targetdiv); 
          delete XMLHttpRequestObject;
          XMLHttpRequestObject = null;
      } 
    } 
    XMLHttpRequestObject.send(null); 
  }
}

function ajaxRequest(url, callback)
{ 
  var XMLHttpRequestObject = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObject = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObject) {
	//alert(url);
    XMLHttpRequestObject.open("GET", url); 
    

    XMLHttpRequestObject.onreadystatechange = function() 
    { 
    if (XMLHttpRequestObject.readyState == 4 && 
      XMLHttpRequestObject.status == 200) { 
          callback(XMLHttpRequestObject); 
          delete XMLHttpRequestObject;
          XMLHttpRequestObject = null;
      } 
    } 
    XMLHttpRequestObject.send(null); 
  }
}

function write2text(text, divid){
	document.getElementById(divid).value = text;
}

function write2div(text, divid){
	
	document.getElementById(divid).innerHTML = text;
	
}

function beautify(obj){

	var str=obj.value;

	str=str.replace(/[^a-zA-Z]/g," ");  // replace non character to space
	str=str.replace(/^[ ]*/,"");   // trim spaces at beginning
	str=str.replace(/[ ]*$/,"");	// trim spaces at end
	str=str.replace(/[ ]+/g," ");	// trim multiple spaces


	str=str.toLowerCase();
	var parts=str.split(" ");
	
	var s="";
	var tmp="";
	for (i=0;i<parts.length;++i){
		s+= ((parts[i].substring(0,1)).toUpperCase() + parts[i].substring(1) + " ");
	}
	s=s.replace(/[ ]*$/,"");	// trim spaces at end
	
	obj.value=s;

}

function focusNext(objid){

	var oForm = document.forms[0];

	for (var i=0 ; i < oForm.elements.length; i++) {
        if (oForm.elements[i].id == objid){
			
			for (var j=i+1;j<oForm.elements.length; ++j){
				if (!oForm.elements[j].disabled) break;
			}
			
			if (j>=oForm.elements.length) {
				document.getElementById('nextbtnid').focus();
				break;
			}
			
			oForm.elements[j].focus();
			if (oForm.elements[j].type=='text') oForm.elements[j].select();
			//alert(oForm.elements[j].id);
			break;
        }
    }
	
	
	

}

function forceNumberInput(obj, event){

	var keychar;
	
	if(window.event)
		keychar=window.event.keyCode;
	else if(event)
		keychar=event.which;
		
	if (String.fromCharCode(keychar)=='n' && event.ctrlKey){

		if (currentPage==files[files.length-1]){
			// last page
			nextPage="schoolselect.php"; 
			savePage();
		}
		else{
			
			nextPage=files[nextPageNum];
			savePage();
		}	
		
		//e.cancelBubble is supported by IE - this will kill the bubbling process.
		event.cancelBubble = true;
		event.returnValue = false;

		//e.stopPropagation works in Firefox.
		if (event.stopPropagation) {
			event.stopPropagation();
			event.preventDefault();
		}
		return true;
		
	}

	if (String.fromCharCode(keychar)=='s' && event.ctrlKey){
		nextPage=""; 
		savePage();
	}
	
	
	checkArrow(obj, event);
		
	var objid = obj.id;
	
	if (keychar==13){
		focusNext(obj.id);
		
		return false;
	}
	
	// number keys are 48 - 57 (normal)
	// and 96-105 (for keypad)
	
	if (keychar==0 || keychar==8) return true;
		
	if (keychar<48 || keychar>57) return false;
	
	return true;
	

}

function generalKeyPress(obj, event){
	var keychar;
	
	if(window.event)
		keychar=window.event.keyCode;
		
	else if(event)
		keychar=event.which;
		
	if (String.fromCharCode(keychar)=='n' && event.ctrlKey){

		if (currentPage==files[files.length-1]){
			// last page
			nextPage="schoolselect.php"; 
			savePage();
		}
		else{
			nextPage=files[nextPageNum]; 
			savePage();
		}	
	}
	
	if (String.fromCharCode(keychar)=='s' && event.ctrlKey){
		nextPage=""; 
		savePage();
	}
	
		
	if (keychar==13){
		focusNext(obj.id);
		
		return false;
	}
	

	if (obj.type=='select-one'){
		if (keychar>=48 && keychar<=57){
			var num=parseInt(keychar)-48;
			
			if (num<obj.length) obj.options[num].selected=true;
			
			
		}
	
	
	}
	
	// number keys are 48 - 57 (normal)
	// and 96-105 (for keypad)
	
	return true;

}

function toggleExcludePages(){
	document.getElementById('excludepages').className = (document.getElementById('excludepages').className == '' ? 'divhide' : '');

}

function excludePagesSave(){
	
	url = "excludedpages.php?files=";
	
	for (i=2; i<files.length; i++){
		id="exclude-"+files[i].replace('.php','');
		if (document.getElementById(id).checked==true) url += files[i]+",";
	}	
	
	ajaxRequest(url, function(){});
	toggleExcludePages();

}

function navigation(){

	var currentJumps = new Array();
	var po=0;

	for (var i=0;i<files.length;i++){
		
		// if page is excluded, skip
		if (excludedPages.indexOf(files[i])>=0) continue;
		
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
	
	str += ' <a href="javascript:toggleExcludePages();"><img src="../images/exclusion.png" border="0"></a> ';
	str += '<div id="excludepages" class="divhide"><h3>Exclude Pages</h2>';
	for (i=2; i<files.length; i++){
		str += '<label>';
		
		id="exclude-"+files[i].replace('.php','');
		
		if (excludedPages.indexOf(files[i])>=0) str += '<input type="checkbox" value="'+files[i]+'" id="'+id+'" checked="checked" />';
		else str += '<input type="checkbox" value="'+files[i]+'" id="'+id+'" />';
		str += files_desc[i];
		str += '</label>';
		
	}
	
	str += '<br /><input type="button" value="Save" onclick="excludePagesSave();" /><input type="button" value="Cancel" onclick="toggleExcludePages();" /></div>';
	str+='<span id="autofillspan"></span>';
	
	if (autoFillPages.indexOf(currentPage)>=0){
		if (autoFillRequest == true)
                    {
                        //check if this is the autofill page
                        //check if this is the ecd page
                    if (currentPage=="ecd.php")
                        {
                            var selectedECD=document.getElementById("selectedECD").options[document.getElementById("selectedECD").selectedIndex].value;
                            str+= "<input type='button' value='Cancel Autofill' onclick='window.location=\""+currentPage+"?s="+currentSchoolCode+"&n="+selectedECD+"\"' />";
                        }
                    else
                        str+= "<input type='button' value='Cancel Autofill' onclick='window.location=\""+currentPage+"?s="+currentSchoolCode+"\"' />";
                    }
		else{
			if (autoFill == false) str+= "<input type='button' value='Autofill' disabled />";
			else str+= "<input type='button' value='Autofill' onclick='window.location=window.location+\"&af\"' />";
		}
	}	
	
	str += '<span style="float:right; margin-top:-17px;font-weight:bold">';
	str += schoolName;
	str += ' [';
	str += currentSchoolCode;
	str += ']<span>';
	
	
	
	
	document.getElementById('nav').innerHTML = str;
	
	// set buttons
	if (currentPage==files[files.length-1]){
		document.getElementById('backbtn').innerHTML = "<input type='button' value='Save (Ctrl+S)' onclick='nextPage=\"\"; if (savePage()==true) alert(\"Page saved.\");'>  <input type='button' value='Cancel &amp; Add New' onclick='location=\"schoolselect.php\"'>";
	}
	else{
		document.getElementById('backbtn').innerHTML = "<input type='button' value='Save (Ctrl+S)' onclick='nextPage=\"\"; if (savePage()==true) alert(\"Page saved.\");'> <input type='button' value='Save &amp; Add New' onclick='nextPage=\"schoolselect.php\"; savePage();'> <input type='button' value='Cancel &amp; Add New' onclick='location=\"schoolselect.php\"'>";		
	}
	
	
	if (currentPage==files[files.length-1]){
		// last page
		document.getElementById('nextbtn').innerHTML = "<input id='nextbtnid' type='button' value='Save &amp; Add New (Ctrl+N)' onclick='nextPage=\"schoolselect.php\"; savePage();'>";
	}
	else
        {
		document.getElementById('nextbtn').innerHTML = "<input id='nextbtnid' type='button' value='Next &gt;&gt; (Ctrl+N)' onclick='nextPage=\""+files[nextPageNum]+"\"; savePage();'>";
	}	
	
	
	document.getElementById("toprightmenu").innerHTML = '<a href="../index.php">Main Menu</a> | <a href="../logout.php">Logout</a>';
	
	
	// go to the first element
	
	var d = document.forms[0];
	var l = d.length;
	
	for (i=0;i<l;i++){
		if (d[i].disabled == true || d[i].type == 'hidden') continue;
		d[i].focus();
		break;
	}
	
	
}

function savePage(){

	if (!validatePage()) {
		document.getElementById('jumpmenu').value = ''; // current page
		return false;
	}
	
	sendRequest(function (t){
			if (nextPage!=''){
				if (nextPage=='schoolselect.php'){
					window.location=nextPage+"?prevcode="+currentSchoolCode;
					return true;
				}
				
				else {
					window.location = nextPage+'?s='+currentSchoolCode + nextPageExtraOption;
					
				}
			}
	});
	
	return true;
	
}

function fixYear(obj){
	if (obj.value.length==2) obj.value='20'+obj.value;
	if (obj.value.length==3) obj.value='2'+obj.value;
}

function blink(valID, stdValID, comment){

	var d = document.forms[0].elements;
	
	if (d[valID].value==''){
		d[valID].className='';
		d[valID].title='';
		
		return;
	}
	
	if (d[stdValID].value==''){
		d[valID].className='blinkbg';
		d[valID].title=comment;
		
		return;
	}
	
	
	
	var v = parseInt(d[valID].value);
	var s = parseInt(d[stdValID].value);
	
	if (v>s){
		d[valID].className='blinkbg'; 
		d[valID].title = comment;
	}
	else {
		d[valID].className='';
		d[valID].title = '';
	}
	

}

function blinkConst(valID, stdVal, comment){
	var d = document.forms[0].elements;
	
	if (d[valID].value==''){
		d[valID].className='';
		d[valID].title='';
		return;
	}

	if (isNaN(stdVal)==true){
		d[valID].className='blinkbg';
		d[valID].title=comment;
		return;	
	}	
	
	var v = parseInt(d[valID].value);

	if (v > stdVal){
		d[valID].className='blinkbg'; 
		d[valID].title = comment;
	}
	
		
	else{
		d[valID].className='';
		d[valID].title = '';
	}
	
	
	

}

function blinkEq(valID, stdValID, comment){


	var d = document.forms[0].elements;
	
	if (d[valID].value==''){
		d[valID].className='';
		d[valID].title='';
		return;
	}
	
	if (d[stdValID].value==''){
		d[valID].className='blinkbg';
		d[valID].title=comment;
		return;
	}
	
	
	
	var v = parseInt(d[valID].value);
	var s = parseInt(d[stdValID].value);

	
	if (v!=s){
		d[valID].className='blinkbg'; 
		d[valID].title = comment;
	}
	else {
		d[valID].className='';
		d[valID].title = '';
	}
	

}

function blinkEqConst(valID, stdVal, comment){
	var d = document.forms[0].elements;
	
	if (d[valID].value==''){
		d[valID].className='';
		d[valID].title='';
		return;
	}
	
	if (isNaN(stdVal)==true){
		d[valID].className='blinkbg';
		d[valID].title=comment;
		return;	
	}

	var v = parseInt(d[valID].value);

	if (v != stdVal){
		d[valID].className='blinkbg'; 
		d[valID].title = comment;
	}
	
		
	else{
		d[valID].className='';
		d[valID].title = '';
	}
	
	
	

}

function blinkLtConst(valID, stdVal, comment){
	var d = document.forms[0].elements;
	
	if (isNaN(stdVal)) return;
	
	if (d[valID].value==''){
		d[valID].className='';
		d[valID].title='';
		return;
	}
	
	if (isNaN(stdVal)==true){
		d[valID].className='blinkbg';
		d[valID].title=comment;
		return;	
	}

	var v = parseInt(d[valID].value);

	
	if (v < stdVal){
		
		d[valID].className='blinkbg'; 
		d[valID].title = comment;
	}
	
		
	else{
		d[valID].className='';
		d[valID].title = '';
	}
	
	
	

}
function blinkConstRange(valID, stdVal1, stdVal2, comment){
	var d = document.forms[0].elements;
	
	if (d[valID].value==''){
		d[valID].className='';
		d[valID].title='';
		return;
	}


	var v = parseInt(d[valID].value);

	if (v < stdVal1 || v > stdVal2){
		d[valID].className='blinkbg'; 
		d[valID].title = comment;
	}
	
		
	else{
		d[valID].className='';
		d[valID].title = '';
	}
	
	
	

}


function blinkLarge(objNoArr){

	var sum=0;
	var count=0;
	var d = document.forms[0].elements;
	
	
	for (i=0;i<objNoArr.length;i++){
		if (d[objNoArr[i]].value!=''){
			sum+=parseInt(d[objNoArr[i]].value);
			count++;
			
		}
		else{
			d[objNoArr[i]].className='';
			d[objNoArr[i]].title='';
			objNoArr[i]=-1;
			
		}
		
	}
	
	if (count==0){
		return;
	}
	
	var mean=sum/count;
	
	var checknum=0.0;

	for (i=0;i<objNoArr.length;i++){
		if (objNoArr[i]==-1) continue;
		if (d[objNoArr[i]].className!='') continue;
		
		checknum=parseInt(d[objNoArr[i]].value);
		
		if (checknum > Math.sqrt(count)*mean){   // || checknum*Math.sqrt(count) < mean){
			d[objNoArr[i]].className='blinkwarning'; 
			d[objNoArr[i]].title='Value exceptionally large';
		}
		
			
		else{
			d[objNoArr[i]].className='';
			d[objNoArr[i]].title='';
		}
	
	}
	
}

function getValue(value){
	return value*1;
}

function getValueId(id){
	return document.getElementById(id).value*1;
}

function validatePage(){
	// to be overridded
	return true;
}


function checkArrow(obj, e){
	var KeyID = (window.event) ? event.keyCode : e.keyCode;
	
	switch(KeyID)
	{
		case 37:
			// left
			var d = document.forms[0];
			var l = d.length;
			
			if (obj == d[0]) break;
			
			var prev = document.forms[0][0];
			i=0;
			while (d[i++].disabled == true);
			
			prev = d[i];
			
			for (i=0;i<l;i++){
				if (d[i].disabled == true) continue;
				
				if (d[i].name == obj.name){
					// found
					break;
				}
				prev = d[i];
			}
			prev.focus();
			prev.select();

			break;
		
		case 38:
			// top
			var left = obj.offsetLeft + obj.offsetParent.offsetLeft;
			var top = obj.offsetTop + obj.offsetParent.offsetTop;
			
			var d = document.forms[0];
			var l = d.length;
			
			if (obj == d[0]) break;
			
			var st = 0;
			
			var closest = obj;
				
			while (d[st++].id != obj.id);
			
			var found = false;
			for (i=st;i>=0;i--){
				if (d[i].disabled == true) continue;
				
				if ((d[i].offsetTop + d[i].offsetParent.offsetTop) < top && (d[i].offsetLeft + d[i].offsetParent.offsetLeft) == left){
					d[i].focus();
					d[i].select();
					found = true;
	
					break;
				}
			}
			
			
			if (found == false){
				st--;
				while ((d[st].offsetTop + d[st].offsetParent.offsetTop) == top) st--;
				
				d[st].focus();
				d[st].select();
			}			
			

			break;
		
		case 39:
			
			// right
			
			focusNext(obj.id);
			break;
		
		case 40:
			
			// down
				
			var left = obj.offsetLeft + obj.offsetParent.offsetLeft;
			var top = obj.offsetTop + obj.offsetParent.offsetTop;
			
			var d = document.forms[0];
			var l = d.length;
			
			var st = 0;
			
				
			while (d[st++].id != obj.id);
			
			var found = false;
			for (i=st;i<l;i++){
				if (d[i].disabled == true) continue;
				
				if ((d[i].offsetTop + d[i].offsetParent.offsetTop) > top && (d[i].offsetLeft + d[i].offsetParent.offsetLeft) == left){
					d[i].focus();
					d[i].select();
					
					found = true;
					break;
				}
			}
			
			if (found == false){
				
				while ((d[st].offsetTop + d[st].offsetParent.offsetTop) == top) st++;
				
				d[st].focus();
				d[st].select();
			}
			

		
			break;
	}	
	
}

document.onkeypress = function (event){
	var keychar;
	
	if(window.event)
		keychar=window.event.keyCode;
	else if(event)
		keychar=event.which;
		
	if (String.fromCharCode(keychar)=='s' && event.ctrlKey){
		nextPage=""; 
		if (savePage()==true) alert("Page saved.");
		
		//e.cancelBubble is supported by IE - this will kill the bubbling process.
		event.cancelBubble = true;
		event.returnValue = false;

		//e.stopPropagation works in Firefox.
		if (event.stopPropagation) {
			event.stopPropagation();
			event.preventDefault();
		}
		return true;		
	}		
		
	if (String.fromCharCode(keychar)=='n' && event.ctrlKey){

		if (currentPage==files[files.length-1]){
			// last page
			nextPage="schoolselect.php"; 
			savePage();
		}
		else{
			
			nextPage=files[nextPageNum];
			savePage();
		}	
		
		//e.cancelBubble is supported by IE - this will kill the bubbling process.
		event.cancelBubble = true;
		event.returnValue = false;

		//e.stopPropagation works in Firefox.
		if (event.stopPropagation) {
			event.stopPropagation();
			event.preventDefault();
		}
		return true;
		
	}
};
