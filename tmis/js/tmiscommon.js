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
		
	//alert(keychar);
		
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

function row_enable(value,row,start,end){
	for(i=start;i<=end;i++){
		if (value==0){
			document.forms[0].elements[i].disabled=true;
		}
		else{
			document.forms[0].elements[i].disabled=false;
		}
	}
}

