function handleChange(obj){
	if (obj.name=='ecd_mc') {
		document.getElementById('ecd_mc_expand').className = (obj.value == 1)?'':'divhide';
		
		if (obj.value=='1') {
			enableIDs('ecd_mc_y ecd_mc_m ecd_mc_d');
			document.getElementById('ecd_mc_y').focus();
		}
		else{
			disableIDs('ecd_mc_y ecd_mc_m ecd_mc_d');
		}		
	}
	if (obj.name=='ecd_room') {
		document.getElementById('ecd_room_expand').className = (obj.value == 1)?'':'divhide';
		
		if (obj.value=='1') {
			enableIDs('ecd_building');
			document.getElementById('ecd_building').focus();
		}
		else{
			disableIDs('ecd_building');
		}		
	}
	
	if (obj.name=='ecd_mc_y') {
		fixYear(obj);
		blinkConstRange('ecd_mc_y',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
	}
	if (obj.name=='estd_year') {
		fixYear(obj);
		blinkConstRange('estd_year',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
		
	}
	
	if (obj.name=='ecd_mc_m') blinkConst('ecd_mc_m',12,"Month cant be greater than 12");
	if (obj.name=='ecd_mc_d') blinkConst('ecd_mc_d',32,"Number of days should be less or equal to 32");
	
	if (obj.name=='ecd_mc_f') blink('ecd_mc_f', 'ecd_mc_t',"Number of female should be less or equal to total");
	if (obj.name=='ecd_mc_dl') blink('ecd_mc_dl', 'ecd_mc_t',"Number of dalit should be less or equal to total");
	
        if (obj.name=='ecd_type') {
		if (obj.value=='1') {
			$('#vdclist,#ecd_ward,#ecd_tole,#ecd_ngo_name,#ecd_ngo_add').attr("disabled", "disabled");
                        $('#ecd_mc,#ecd_room,#ecd_space,#ecd_material,#ecd_building_classroom').attr("disabled", "");
                        $("#ecd_extra_info :input").attr("disabled", "");
                        $("#ecd_ppc_table :input").not('.total').attr("disabled", "");
                        $("#ecd_tchr_table :input").attr("disabled", "");
                        
                        //disable fields if community aided
                        if(communityAided==1)
                            $("#ecd_ppc_table :input").not('.ecd').attr("disabled", "disabled");
                        else
                        {
                            $("#ecd_ppc_table :input").attr("disabled", "");
                            $(".ecd").attr("disabled","disabled");
                            $(".total").attr("disabled","disabled");
                        }
		}
		else if(obj.value=='2'){
                        $('#vdclist,#ecd_ward,#ecd_tole,#ecd_mc,#ecd_room,#ecd_space,#ecd_material,#ecd_building_classroom,#ecd_ngo_name,#ecd_ngo_add').attr("disabled", "");
                        $("#ecd_extra_info :input").attr("disabled", "");
                        $("#ecd_ppc_table :input").not('.total').attr("disabled", "");
                        $("#ecd_tchr_table :input").attr("disabled", "");  
                        
                        //disable fields if community aided
                        if(communityAided==1)
                            $("#ecd_ppc_table :input").not('.ecd').attr("disabled", "disabled");
                        else
                        {
                            $("#ecd_ppc_table :input").attr("disabled", "");
                            $(".ecd").attr("disabled","disabled");
                            $(".total").attr("disabled","disabled");
                        }
		}
                //if ecd type is not selected then disable everything except the selectbox itself
                else
                {
                    $('#vdclist,#ecd_ward,#ecd_tole,#ecd_mc,#ecd_room,#ecd_space,#ecd_material,#ecd_building_classroom,#ecd_ngo_name,#ecd_ngo_add').attr("disabled", "disabled");
                    $("#ecd_extra_info :input").attr("disabled", "disabled");
                    $("#ecd_ppc_table :input").attr("disabled", "disabled");
                    $("#ecd_tchr_table :input").attr("disabled", "disabled");                    
                }
	}
        if (obj.name=='reg_vdc') {
            document.getElementById('reg_vdc_expand').className = (obj.value == 1)?'':'divhide';
            
            if (obj.value=='1') 
                document.getElementById('ecd_reg_vdc').focus();	
        }
        if (obj.name=='ecd_reg_vdc') {
		fixYear(obj);
		blinkConstRange('ecd_reg_vdc',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
		
	}
	
	
	
}	

function newecd(n){
	nextPageExtraOption = '&n=' + n;
	nextPage = currentPage;
	savePage();
}

function deleteecd(){
	
	document.forms[0]['vdclist'].value = '';
	
	for (i=1;i<=5;i++){
		document.forms[0]['ep_t_t['+i+']'].value = '';
		document.forms[0]['ep_a_t['+i+']'].value = '';
		
	}
	
	nextPage = currentPage;
	savePage();
	
}

var ecdLargeCheck1="ep_t_g[1] ep_t_b[1] ep_t_g[3] ep_t_b[3] ep_t_g[4] ep_t_b[4] ep_t_g[5] ep_t_b[5]";
var ecdLargeCheck2="ep_a_g[1] ep_a_b[1] ep_a_g[3] ep_a_b[3] ep_a_g[4] ep_a_b[4] ep_a_g[5] ep_a_b[5]";

/*
function ecdBV(obj){
	
	var d = document.forms[0];
	
	var itemcheck = obj.id.substring(0,4);
	
	
	
}

*/

function ecdBV(obj){
	var d=document.forms[0];
	
	if (obj.id.substring(0,2)=='ep'){
	

		var g=obj.id.replace(/_g\[|_b\[|_t\[/,'_g[');
		var b=obj.id.replace(/_g\[|_b\[|_t\[/,'_b[');
		var t=obj.id.replace(/_g\[|_b\[|_t\[/,'_t[');	
		
		var sum = d[g].value * 1 + d[b].value * 1;
		d[t].value = (sum>0?sum:'');		
		
	}
	
	
	/*
	// calculate totals
	
	//classwise totals
	var tot;
	var l=parseInt(obj.id.substring(7,8)); 
	
	var item = obj.id.substring(0,5);
	
	var itemcheck = obj.id.substring(0,4);
	
	
	if (itemcheck!='ep_r'){
		tot=0;
		tot+=(d[item+'g['+l+']'].value==''?0:parseInt(d[item+'g['+l+']'].value))
		tot+=(d[item+'b['+l+']'].value==''?0:parseInt(d[item+'b['+l+']'].value));
		
		d[item+'t['+l+']'].value = (tot>0?tot:'');
	}
	
	if (itemcheck=='ep_r' || itemcheck=='ep_a'){
		tot=0;
		tot+=(d['ep_a_t['+l+']'].value==''?0:parseInt(d['ep_a_t['+l+']'].value))
		tot-=(d['ep_r_y['+l+']'].value==''?0:parseInt(d['ep_r_y['+l+']'].value));
		
		d['ep_r_n['+l+']'].value = (tot>0?tot:'');		
		
	}

	blinkLarge(ecdLargeCheck1.split(' '));
	blinkLarge(ecdLargeCheck2.split(' '));
	
	var itemcheck = obj.id.substring(0,4);

	if (itemcheck=='ep_j' || itemcheck=='ep_d'){
		blink(item+'g['+l+']','ep_t_g['+l+']',"This value should be less or equal to total.");
		blink(item+'b['+l+']','ep_t_b['+l+']',"This value should be less or equal to total.");
		blink(item+'t['+l+']','ep_t_t['+l+']',"This value should be less or equal to total.");	
	}
	
	blinkLtConst('ep_t_g['+l+']',getValue(d['ep_d_g['+l+']'].value)+getValue(d['ep_j_g['+l+']'].value),'Sum of Dalit and Janjati should be less or equal to total.')
	blinkLtConst('ep_t_b['+l+']',getValue(d['ep_d_b['+l+']'].value)+getValue(d['ep_j_b['+l+']'].value),'Sum of Dalit and Janjati should be less or equal to total.')
	blinkLtConst('ep_t_t['+l+']',getValue(d['ep_d_t['+l+']'].value)+getValue(d['ep_j_t['+l+']'].value),'Sum of Dalit and Janjati should be less or equal to total.')
	
	
	blink('ep_r_y['+l+']', 'ep_a_t['+l+']',"This value should be less or equal to total.");
	blink('ep_r_n['+l+']', 'ep_a_t['+l+']',"This value should be less or equal to total.");
	
	var types='ep_t_g ep_t_b ep_t_t ep_d_g ep_d_b ep_d_t ep_j_g ep_j_b ep_j_t ep_a_g ep_a_b ep_a_t ep_r_y ep_r_n';
	var arr=types.split(" ");
	

	for (i=0;i<arr.length;++i){
		item=arr[i];
		tot=0;
		tot+=(d[item+'['+3+']'].value==''?0:parseInt(d[item+'['+3+']'].value));
		tot+=(d[item+'['+4+']'].value==''?0:parseInt(d[item+'['+4+']'].value));
		tot+=(d[item+'['+5+']'].value==''?0:parseInt(d[item+'['+5+']'].value));	
		
		d[item+'['+2+']'].value = (tot>0?tot:'');
		
	}
	* 
	*/
	//sum up into ppc
        var types='ep_t_g ep_t_b ep_t_t ep_d_g ep_d_b ep_d_t ep_j_g ep_j_b ep_j_t';
	var arr=types.split(" ");
	    
	for (i=0;i<arr.length;++i){
		item=arr[i];
		tot=0;
		tot+=(d[item+'['+3+']'].value==''?0:parseInt(d[item+'['+3+']'].value));
		tot+=(d[item+'['+4+']'].value==''?0:parseInt(d[item+'['+4+']'].value));
		tot+=(d[item+'['+5+']'].value==''?0:parseInt(d[item+'['+5+']'].value));	
                tot+=(d[item+'['+6+']'].value==''?0:parseInt(d[item+'['+6+']'].value));	
		
		d[item+'['+2+']'].value = (tot>0?tot:'');
		
	}
	
	if (obj.name.indexOf('_d_')>0 || obj.name.indexOf('_j_')>0){
		
		
		var tot = obj.name.replace(/_d_|_j_/,'_t_');
		blink (obj.name, tot, "Number should be less or equal to total");
		
		
	}	

	
	
}


function validatePage(){
	
	if (document.forms[0]['ecd_mc_y'].className!=''){
		alert("Please correct ECD Management Comittee year");
		document.forms[0]['ecd_mc_y'].focus();
		return false;
	}
	
	if (document.forms[0]['estd_year'].className!=''){
		alert("Please correct Establishment year");
		document.forms[0]['estd_year'].focus();
		return false;
	}	
	
	return true;
}

function disableIDs(ids){
	var idarr = ids.split(" ");
	for (i=0;i<idarr.length;i++){
		document.getElementById(idarr[i]).disabled = true;
	}
}

function enableIDs(ids){
	var idarr = ids.split(" ");
	for (i=0;i<idarr.length;i++){
		document.getElementById(idarr[i]).disabled = false;
	}
}
