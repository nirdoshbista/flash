function handleChange(obj){
	        
	if (obj.name=='estd_year') {
		var maxYearMinus = 100;
		fixYear(obj);
		blinkConstRange('estd_year',currentYear-maxYearMinus, currentYear, "Year should be in the range of "+(currentYear-maxYearMinus)+" to "+(currentYear))
	}
	
	var d = document.forms[0];
	
	if (obj.id.indexOf('_f_')>=0 || obj.id.indexOf('_m_')>=0){
		var t=obj.id.replace(/_f_|_m_/,'_t_');
		var f=t.replace('_t_','_f_');
		var m=t.replace('_t_','_m_');

		var sum = d[f].value *1 + d[m].value *1;

		d[t].value = sum?sum:'';	
	}

	/*
	if (obj.id.indexOf('ecd_enroll')==0){
	
		if (obj.id.indexOf('_2')>0) return; // recursion

		sum=0;

		var prefix=obj.id.substring(0,obj.id.length-1);
		
		for (i=3;i<=5;i++) sum+=d[prefix+i].value*1;
		
		d[prefix+'2'].value = sum?sum:'';
		
		handleChange(d[prefix+'2']);
		
	}
	*/
	
	if (obj.id.indexOf('ecd_age')==0){
		if (obj.id.indexOf('_5')>0) return; // recursion
	
		sum=0;

		var prefix=obj.id.substring(0,obj.id.length-1);
		
		for (i=0;i<=4;i++) sum+=d[prefix+i].value*1;
		
		d[prefix+'5'].value = sum?sum:'';
		
		//handleChange(d[prefix+'5']);
		
	}
        
        if (obj.name=='ecd_type') {
                var div=document.getElementById( "disable_div" );
                var all = div.getElementsByTagName("input");
                var total=document.getElementsByClassName("total");
               
                var ecdInputs=document.getElementById("ecdTable").getElementsByTagName("input");
                var ecdRow=document.getElementsByClassName("ecd");
                
		if (obj.value=='1') {
                        //enaable all fields
                        for (var i=0, max=all.length; i < max; i++) {
                             all[i].disabled=false;
                        }
                        
			document.forms[0]['vdclist'].disabled=true;
                        document.forms[0]['ecd_ward'].disabled=true;
                        document.forms[0]['ecd_tole'].disabled=true;
                        document.forms[0]['ecd_ngo_name'].disabled=true;
                        document.forms[0]['ecd_ngo_add'].disabled=true;
                        
                        
                        //enable ecd,and disable nursery,kg,ukg if community aided
                        if(communityAided==1)
                        {
                            //disable entire ecd table
                            for (var i=0, max=ecdInputs.length; i < max; i++) {
                             ecdInputs[i].disabled=true;
                            }
                            //enable ecd row
                            for (var i=0, max=ecdRow.length; i < max; i++) {
                             ecdRow[i].disabled=false;
                            }
                        }
                        else 
                        {
                            //enable entire ecd table
                            for (var i=0, max=ecdInputs.length; i < max; i++) {
                             ecdInputs[i].disabled=false;
                            }
                            //disable ecd row
                            for (var i=0, max=ecdRow.length; i < max; i++) {
                             ecdRow[i].disabled=true;
                            }
                        }
                            
                        //disable total input boxes
                        for (var i=0, max=total.length; i < max; i++) {
                             total[i].disabled=true;
                        }
                        
		}
		else if(obj.value=='2'){
                        //enable all fields
                        for (var i=0, max=all.length; i < max; i++) {
                                all[i].disabled=false;
                        }
                        
                        document.forms[0]['vdclist'].disabled=false;
                        document.forms[0]['ecd_ward'].disabled=false;
                        document.forms[0]['ecd_tole'].disabled=false;
                        document.forms[0]['ecd_ngo_name'].disabled=false;
                        document.forms[0]['ecd_ngo_add'].disabled=false;
                        
                        //disable ecd,kg,ukg if community aided
                        if(communityAided==1)
                        {
                            //disable entire ecd table
                            for (var i=0, max=ecdInputs.length; i < max; i++) {
                             ecdInputs[i].disabled=true;
                            }
                            //enable ecd row
                            for (var i=0, max=ecdRow.length; i < max; i++) {
                             ecdRow[i].disabled=false;
                            }
                        }
                        else 
                        {
                            //enable entire ecd table
                            for (var i=0, max=ecdInputs.length; i < max; i++) {
                             ecdInputs[i].disabled=false;
                            }
                            //disable ecd row
                            for (var i=0, max=ecdRow.length; i < max; i++) {
                             ecdRow[i].disabled=true;
                            }
                        }
                        
                        //disable total input boxes
                        for (var i=0, max=total.length; i < max; i++) {
                             total[i].disabled=true;
                        }
		}
                //if ecd type is not selected then disable everything except the selectbox itself
                else if(obj.value=='0')
                {
                        for (var i=0, max=all.length; i < max; i++) {
                                all[i].disabled=true;
                        }
                        document.forms[0]['vdclist'].disabled=true;
                        document.forms[0]['ecd_ward'].disabled=true;
                        document.forms[0]['ecd_tole'].disabled=true;
                        document.forms[0]['ecd_ngo_name'].disabled=true;
                        document.forms[0]['ecd_ngo_add'].disabled=true;
                }
	}
        
	
	if (validate) validation(obj);


}

function validation(obj){

	var d = document.forms[0];

	if (obj.id.indexOf('ecd_enroll')>=0){
		if (obj.id.indexOf('total')>=0){
			blinkLarge(new Array(0,1,18,19,27,28,36,37));
		}
	}
	
	/*
	if (obj.id.indexOf('ecd_age')>=0){
	
		var t=obj.id.replace(/1|2|3|4/,"4");
		var tmp = obj.id.replace(/_age_/,"_enroll_");
		var e1 = tmp.replace(/1|2|3|4/,"1");
		var e2 = tmp.replace(/1|2|3|4/,"2");
		
		
		blinkConst(t, d[e1].value*1 + d[e2].value*1, "The total students by age should equal to total enrollment");
	
	}
	*/
	
	
	if (obj.id.indexOf('ecd_after')>=0){
	
	}	
	
	blink(obj.id.replace(/total|dalit|janjati/,'dalit'), obj.id.replace(/total|dalit|janjati/,'total'), TD );
	blink(obj.id.replace(/total|dalit|janjati/,'janjati'), obj.id.replace(/total|dalit|janjati/,'total'), TJ );


}



var ecdLargeCheck1="ep_t_g[1] ep_t_b[1] ep_t_g[3] ep_t_b[3] ep_t_g[4] ep_t_b[4] ep_t_g[5] ep_t_b[5]";
var ecdLargeCheck2="ep_a_g[1] ep_a_b[1] ep_a_g[3] ep_a_b[3] ep_a_g[4] ep_a_b[4] ep_a_g[5] ep_a_b[5]";

function ecdBV(obj){
	var d=document.forms[0];
	var tot;
	
	//classwise totals
	var l=parseInt(obj.id.substring(7,8)); 
	
	var item = obj.id.substring(0,5);
	
	var itemcheck = obj.id.substring(0,4);
	if (itemcheck!='ep_r'){
		tot=0;
		tot+=(d[item+'g['+l+']'].value==''?0:parseInt(d[item+'g['+l+']'].value))
		tot+=(d[item+'b['+l+']'].value==''?0:parseInt(d[item+'b['+l+']'].value));
		
		d[item+'t['+l+']'].value = (tot>0?tot:'');
	}
	/*
	if (itemcheck=='ep_r' || itemcheck=='ep_a'){
		tot=0;
		tot+=(d['ep_a_t['+l+']'].value==''?0:parseInt(d['ep_a_t['+l+']'].value))
		tot-=(d['ep_r_y['+l+']'].value==''?0:parseInt(d['ep_r_y['+l+']'].value));
		
		d['ep_r_n['+l+']'].value = (tot>0?tot:'');		
		
	}
        */
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
	
	// calculate totals
	var types='ep_t_g ep_t_b ep_t_t ep_d_g ep_d_b ep_d_t ep_j_g ep_j_b ep_j_t ep_a_g ep_a_b ep_a_t';
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
        
	//blink('ep_r_y['+l+']', 'ep_a_t['+l+']',"This value should be less or equal to total.");
	//blink('ep_r_n['+l+']', 'ep_a_t['+l+']',"This value should be less or equal to total.");	
	
        
}


function newecd(n){
	nextPageExtraOption = '&n=' + n;
	nextPage = currentPage;
	savePage();
}

function deleteecd()
{
	
	for (i=1;i<=5;i++){
		document.forms[0]['ep_t_t['+i+']'].value = '';
		document.forms[0]['ep_a_t['+i+']'].value = '';
		
	}
        
        //clear ecd info
	document.forms[0]['estd_year'].value='';
        document.forms[0]['vdclist'].value='';
        document.forms[0]['ecd_type'].value='0';
        document.forms[0]['ecd_ward'].value='';
        document.forms[0]['ecd_tole'].value='';
        document.forms[0]['ecd_ngo_name'].value='';
        document.forms[0]['ecd_ngo_add'].value='';
	/*
	for (i=1;i<=10;i++){
		document.forms[0]['ecd_teacher_name_'+i].value = '';
	}
	*/
	
	for (i=1;i<=4;i++){
		document.forms[0]['ecd_age_total_t_'+i].value = '';
	}
	
	
	
	
	nextPage = currentPage;
	savePage();
	
}

function validatePage()
{
	
	/* OLD CODE
	
	if (document.forms[0]['mother_school_code'].value.length!=0 && document.forms[0]['mother_school_code'].value.length!=9){
		alert("Please correct mother school code");
		document.forms[0]['mother_school_code'].focus();
		return false;
	}
	*/
	
	
	return true;
}
