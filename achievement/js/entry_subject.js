// initialize
$(document).ready(function(){
		
	$('#stdlist').tablesorter({
		sortList: [[0,0]],
		headers:{2:{sorter:false},3:{sorter:false},4:{sorter:false},5:{sorter:false}},
		widgets: ['zebra']
	});

});

function validate(){
	return true;
}

function handleChange(obj){
	
	if (obj.id.indexOf("_th")>0) blinkConst(obj.id,fm_th,"Mark should be less or equal to "+fm_th)
	if (obj.id.indexOf("_gr")>0) blinkConst(obj.id,fm_th,"Mark should be less or equal to "+fm_th)
	if (obj.id.indexOf("_pr")>0) blinkConst(obj.id,fm_pr,"Mark should be less or equal to "+fm_pr)
	
	if (obj.id.indexOf("_th")>0 || obj.id.indexOf("_gr")>0 || obj.id.indexOf("_pr")>0){
		var std_num = obj.id.substring(0,obj.id.indexOf("_"));
	    n=$('#'+std_num+'_th').val()*1+$('#'+std_num+'_pr').val()*1+$('#'+std_num+'_gr').val()*1;
		if (n>0) $('#'+std_num+'_tot').val(n);
	}
	

	
}
