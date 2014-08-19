function handleChange(obj){
	
	if (document.getElementById(obj.id+"_f")){
		if (obj.value=='1'){
			document.getElementById(obj.id+"_f").className = 'divshow';
			focusNext(obj.id);
		}
		else document.getElementById(obj.id+"_f").className = 'divhide';
	}	
	
	if (obj.id.indexOf('sections')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		
		for (i=0;i<=10;i++){
			sum += d['sections_'+i].value * 1;
		}
		
		d['sections_t'].value = sum?sum:'';
		
	}
	
	if (obj.id.indexOf('classrooms')>=0){
		var sum=0;
		var d= document.forms[0].elements;
		
		for (i=0;i<=10;i++){
			sum += d['classrooms_'+i].value * 1;
		}
		
		d['classrooms_t'].value = sum?sum:'';
		
	}	
	
	var d=document.forms[0];
	var id = obj.id;
	
	
	
	if (id.indexOf('slc_')==0 || id.indexOf('hsec_')==0){
		
		var g=obj.id.replace(/_f$|_m$|_t$/,'_f');
		var b=obj.id.replace(/_f$|_m$|_t$/,'_m');
		var t=obj.id.replace(/_f$|_m$|_t$/,'_t');
		
		var sum = d[g].value * 1 + d[b].value * 1;
		

		d[t].value = (sum>0?sum:'');
		
		
	}		
        if(obj.name=="is_retrofitting")
        {
                if (obj.value=='1'){
			document.getElementById("retrofitting_yes").className = 'divshow';
			focusNext(obj.id);
		}
		else document.getElementById("retrofitting_yes").className = 'divhide';
        }
            
	
	
	
}

function disableIDs(ids){
	var idarr = ids.split(" ");
	for (i=0;i<idarr.length;i++){
		document.getElementById(idarr[i]).disabled = true;
		if (document.getElementById(idarr[i]).type=='select-one') document.getElementById(idarr[i]).selectedIndex = 0;
		else document.getElementById(idarr[i]).value = '';
	}
}

function enableIDs(ids){
		var idarr = ids.split(" ");
	for (i=0;i<idarr.length;i++){
		document.getElementById(idarr[i]).disabled = false;
	}
}
