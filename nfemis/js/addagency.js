
/* consists of functions to be used by the addagency.php page
 * 
 */
function initialize(){
	ajaxRequest('addagency_backend.php?req=distlist',distCallback);
}

function distCallback(t){
    document.getElementById('divdistrict').innerHTML = t.responseText;
}

function addAgency(){
    var distNo=document.getElementById('distlist').value;
    var agencyName=document.getElementById('agencyname').value;
    ajaxRequest('addagency_backend.php?req=addagency',distCallback);
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

function validateInput(){
    if (document.getElementById('distlist').value == '') 
    {
        document.getElementById('agencyname').disabled = true;
        document.getElementById('addagency').disabled = true;
    }
    else
    {
        document.getElementById('agencyname').disabled = false;
        if (document.getElementById('agencyname').value == '') document.getElementById('addagency').disabled = true;
        else document.getElementById('addagency').disabled = false;
    }
}
