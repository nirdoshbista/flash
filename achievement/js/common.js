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

function beautifyWithNumber(obj){

	var str=obj.value;

	str=str.replace(/[^a-zA-Z0-9/-]/g," ");  // replace non character to space
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
		
	if (event.ctrlKey){
		if (String.fromCharCode(keychar)=='a') {addNewValueModal(obj); event.stopPropagation(); event.preventDefault();	}
		if (String.fromCharCode(keychar)=='s') {document.getElementById('entryform').submit(); }
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

	if (event.ctrlKey){
		if (String.fromCharCode(keychar)=='a') {addNewValueModal(obj); event.stopPropagation(); event.preventDefault();	}
		if (String.fromCharCode(keychar)=='s') {document.getElementById('entryform').submit(); }
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
	
	//alert(document.forms[0].name);
	

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
	
	//alert(KeyID);
	
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
				
				fid = d[i].id;
				
				var curr_left = d[i].offsetLeft;
				var curr_top = d[i].offsetTop;
				
				if (d[i].offsetParent.offsetTop){
					curr_left += d[i].offsetParent.offsetLeft;
					curr_top += d[i].offsetParent.offsetTop;
				}
				
				if (curr_top < top && curr_left == left){				

					document.getElementById(fid).focus();
					document.getElementById(fid).select();
					found = true;
	
					break;
				}
			}
			
			
			if (found == false){
				st--;
				while ((d[st].offsetTop) == top) st--;
				
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
			
			var curr_left = 0;
			var curr_top = 0;
			
			//alert(left);
			//alert(top);
			
			var d = document.forms[0];
			var l = d.length;
			
			var st = 0;
			
				
			while (d[st++].id != obj.id);
			
			
			var bc = '';
			var found = false;
			for (i=st;i<l;i++){
				if (d[i].disabled == true) continue;
				
				fid = d[i].id;
				
				var curr_left = d[i].offsetLeft;
				var curr_top = d[i].offsetTop;
				
				if (d[i].offsetParent.offsetTop){
					curr_left += d[i].offsetParent.offsetLeft;
					curr_top += d[i].offsetParent.offsetTop;
				}
				
				if (curr_top > top && curr_left == left){
					
					document.getElementById(fid).focus();
					document.getElementById(fid).select();
					
					found = true;
					break;
				}
			}
			
			if (found == false){
				
				
				while ((d[st].offsetTop) == top) st++;
				
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
		
		if (validate()) document.getElementById('entryform').submit();
		
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
