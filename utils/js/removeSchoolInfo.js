/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initialize(){
	ajaxRequest('exportEMIS_backend.php?req=distlist',distCallback);
}

function distCallback(t){
    document.getElementById('divdistrict').innerHTML = t.responseText;
}

function vdcCallback(t){
    document.getElementById('divvdc').innerHTML = t.responseText;
}
function schoolCallback(t){
    document.getElementById('schoollist').innerHTML = t.responseText;
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

function resetAll(){
	var d, v, s;
	
	return;
	
	d=document.getElementById('distlist').value;
	v=document.getElementById('vdclist').value;
	s=document.getElementById('schlist').value;
	
	document.forms[0].reset();
	
	document.getElementById('distlist').value=d;
	document.getElementById('vdclist').value=v;
	document.getElementById('schlist').value=s;
}

function districtChange(){
	
	ajaxRequest('exportEMIS_backend.php?req=vdclist&distcode='+document.getElementById('distlist').value, vdcCallback);
	resetAll();
}

function vdcChange(){
	ajaxRequest('exportEMIS_backend.php?req=schoollist&distcode='+document.getElementById('distlist').value+'&vdccode='+document.getElementById('vdclist').value, schoolCallback);
}

function changeExportButton(){
    if (document.getElementById('schlist').value == '') document.getElementById('exportbutton').disabled = true;
    else document.getElementById('exportbutton').disabled = false;
}

function ajaxRemoveinfo(){
    //start loading animation and ajaxify
    $("body").addClass("loading");
    
    //firstly we need to determine the list of schools that need to be imported in the form
    //of [schoolcode1][schoolcode2][...
    var selectbox = document.getElementById('schlist')
    var schoolcode = "";   
    for (var i=0, n=selectbox.length;i<n;i++) 
    {
        if (selectbox.options[i].selected ==true ){
            if (schoolcode=="") 
                schoolcode += selectbox[i].value;
            else
                schoolcode += ":" + selectbox[i].value;
        }
    }
 
    ajaxRequest('exportEMIS_backend.php?req=remove&schoolcode='+schoolcode, removeCallback);
}

function removeCallback(){
    //stop loading animation
    $("body").removeClass("loading");
    alert("Records deleted Successfully!");
}