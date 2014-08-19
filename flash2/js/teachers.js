function handleChange(obj){
	
	var d=document.forms[0];
	

	var id = obj.id;
	
	if (obj.id.indexOf("_female")>0 || obj.id.indexOf("_male")>0){
		
	
		var g=obj.id.replace(/_female|_male|_total/,'_female');
		var b=obj.id.replace(/_female|_male|_total/,'_male');
		var t=obj.id.replace(/_female|_male|_total/,'_total');
		
		var sum = d[g].value * 1 + d[b].value * 1;
		

		d[t].value = (sum>0?sum:'');
	}	
	
	
	if (id.indexOf('approved')==0 || id.indexOf('permanent')==0 || id.indexOf('temporary')==0 || id.indexOf('rahat')==0 || id.indexOf('private')==0){
		var level = id.substring(id.indexOf('[')+1,id.indexOf(']'));
		var mf = id.substring(id.indexOf('_')+1,id.indexOf('['));
		
		var list = new Array('permanent','temporary','rahat','private');
		var sum = 0;
		for (i=0;i<list.length; i++){
			
			sum += d[list[i]+"_"+mf+"["+level+"]"].value * 1;
			
		}
		d["total_"+mf+"["+level+"]"].value = (sum>0?sum:'');
		
		if (id.indexOf("_total")<0) {
			handleChange(d["approved_total["+level+"]"]);
		}
		
		return;
	}	
		


	if (obj.id.indexOf("_f")>0 || obj.id.indexOf("_m")>0){
	
		var g=obj.id.replace(/_f|_m|_t/,'_f');
		var b=obj.id.replace(/_f|_m|_t/,'_m');
		var t=obj.id.replace(/_f|_m|_t/,'_t');
		
		var sum = d[g].value * 1 + d[b].value * 1;
		

		d[t].value = (sum>0?sum:'');
	}

	
}

function disableForm()
{
    var f = document.getElementsByTagName('input');
    for(var i=0;i<f.length;i++)
    {
        if(f[i].getAttribute('type')=='text')
            f[i].setAttribute('disabled',true)
    }
    f=document.getElementsByTagName('select');
    for(var i=0;i<f.length;i++)
    {
            f[i].setAttribute('disabled',true)
    }
}
