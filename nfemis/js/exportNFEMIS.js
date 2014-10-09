/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function initialize(){
	ajaxRequest('exportNFEMIS_backend.php?req=distlist',distCallback);
}

function distCallback(t){
    document.getElementById('divdistrict').innerHTML = t.responseText;
}

function agencyCallback(t){
    document.getElementById('agencylist').innerHTML = t.responseText;
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
	a=document.getElementById('agncylist').value;
	
	document.forms[0].reset();
	
	document.getElementById('distlist').value=d;
	document.getElementById('agncylist').value=a;
}

function districtChange(){
	
	ajaxRequest('exportNFEMIS_backend.php?req=agencylist&distcode='+document.getElementById('distlist').value, agencyCallback);
	resetAll();
}


function changeExportButton(){
    if (document.getElementById('agncylist').value == '') document.getElementById('exportbutton').disabled = true;
    else document.getElementById('exportbutton').disabled = false;
}

function ajaxExportExcel(){
    //start loading animation and ajaxify
    $("body").addClass("loading");
    
    //firstly we need to determine the list of schools that need to be imported in the form
    //of [schoolcode1][schoolcode2][...
    var selectbox = document.getElementById('agncylist')
    var agencycode = "";   
    for (var i=0, n=selectbox.length;i<n;i++) 
    {
        if (selectbox.options[i].selected ==true ){
            if (agencycode=="") 
                agencycode += selectbox[i].value;
            else
                agencycode += ":" + selectbox[i].value;
        }
    }
 
    ajaxRequest('exportNFEMIS_backend.php?req=export&agencycode='+agencycode, exportCallback);
}

function exportCallback(){
    //stop loading animation
    $("body").removeClass("loading");
    alert("The exported file has been saved to desktop!");
}