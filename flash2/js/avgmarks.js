
function cV(obj){
	var d=document.forms[0];
	if (obj.id.substring(0,1)=='q') return;
	
	var currentClass = parseInt(obj.id.substring(6,8));
	var currentLine = parseInt(obj.id.substring(obj.id.indexOf('[')+1));
        var type=obj.name.substring(4,5);
        
        var level="";
        var cmax=0;
        var cmin=0;
        var noof_sub;
        if(currentClass<6)
        {
            noof_sub=6;
            cmax=5;
            cmin=1;
            level="primary";
        }
        else if(currentClass>5 && currentClass<9)
        {    
            noof_sub=9;
            cmax=8;
            cmin=6;
            level="lsecondary";
        }
        else
        {
            noof_sub=6;
            cmax=10;
            cmin=9;
            level="secondary";
        }
        
        var lastRow=(noof_sub+1); //specicified at each level by (no_of_subjects+1)
  
        //make sure that the textbox turns red when user enters invalid marks
        blinkConst(obj.name,100, "Marks should always be less than 100");
        
	var rowSum=0;
       //get average marks for each subject for each class
	rowSum+=(d['sch_g_'+currentClass+'['+currentLine+']'].value==''?0:parseFloat(d['sch_g_'+currentClass+'['+currentLine+']'].value));
	rowSum+=(d['sch_b_'+currentClass+'['+currentLine+']'].value==''?0:parseFloat(d['sch_b_'+currentClass+'['+currentLine+']'].value));       
	if(d['sch_b_'+currentClass+'['+currentLine+']'].value!='' && d['sch_g_'+currentClass+'['+currentLine+']'].value!='')
		d['sch_t_'+currentClass+'['+currentLine+']'].value = (rowSum>0?parseFloat((rowSum/2).toFixed(1)):'');
	else 
	{
		d['sch_t_'+currentClass+'['+currentLine+']'].value=d['sch_b_'+currentClass+'['+currentLine+']'].value>d['sch_g_'+currentClass+'['+currentLine+']'].value?d['sch_b_'+currentClass+'['+currentLine+']'].value:d['sch_g_'+currentClass+'['+currentLine+']'].value;
	}
        	
	//get average for each class in each subject and total
        var g_colSum=0;
        var b_colSum=0;
        var t_colSum=0;
	var count_g=0;
	var count_b=0;
	var count_t=0;
        for(var i=1;i<lastRow;i++)
        {
			if(d['sch_g_'+currentClass+'['+i+']'].value!='')
			{
				count_g++;
				g_colSum+=parseFloat(d['sch_g_'+currentClass+'['+i+']'].value);
			}
			if(d['sch_b_'+currentClass+'['+i+']'].value!='')
			{
				count_b++;
				b_colSum+=parseFloat(d['sch_b_'+currentClass+'['+i+']'].value);
			}
			if(d['sch_t_'+currentClass+'['+i+']'].value!='')
			{
				count_t++;
				t_colSum+=parseFloat(d['sch_t_'+currentClass+'['+i+']'].value);
			}
	}
        d['sch_g_'+currentClass+'['+lastRow+']'].value = (g_colSum>0?parseFloat((g_colSum/count_g).toFixed(1)):'');
        d['sch_b_'+currentClass+'['+lastRow+']'].value = (b_colSum>0?parseFloat((b_colSum/count_b).toFixed(1)):'');
        d['sch_t_'+currentClass+'['+lastRow+']'].value = (t_colSum>0?parseFloat((t_colSum/count_t).toFixed(1)):'');
        
        
        //total(colsum) level subjectwise average for boys and girls seperately
        var colcount=0;
        var colsum=0;
        for(var i=cmin;i<=cmax;i++)
        {
            colsum+=d['sch_'+type+'_'+i+'['+currentLine+']'].value==''? 0:parseFloat(d['sch_'+type+'_'+i+'['+currentLine+']'].value);
            colcount= d['sch_'+type+'_'+i+'['+currentLine+']'].value==''?colcount:(colcount+1);
        }
        d['sch_'+type+'_'+level+'['+currentLine+']'].value=colcount==0? '':(colsum/colcount).toFixed(1); 
        //d['sch_'+type+'_'+level+'['+currentLine+']'].value=colsum/colcount;

        
        
        //the Total(colsum) subjectwise level average
        colcount=0;
        colsum=0;
        for(var i=cmin;i<=cmax;i++)
        {
            colsum+=d['sch_t_'+i+'['+currentLine+']'].value==''? 0:parseFloat(d['sch_t_'+i+'['+currentLine+']'].value);
            colcount= d['sch_t_'+i+'['+currentLine+']'].value==''? colcount:(colcount+1);
        }
        d['sch_t_'+level+'['+currentLine+']'].value=colcount==0? '':(colsum/colcount).toFixed(1); 
        
        
        //get total(rowsum) level average for boys and girls
        rowcount=0;
        rowsum=0;
        for(var i=1;i<lastRow;i++)
        {
            if(d['sch_'+type+'_'+level+'['+i+']'].value!='')
            {
		rowcount++;
		rowsum+=parseFloat(d['sch_'+type+'_'+level+'['+i+']'].value);
            }
        }
        d['sch_'+type+'_'+level+'['+lastRow+']'].value = (rowsum>0? parseFloat(rowsum/rowcount).toFixed(1):'');
        
        //sum total average of level
        var level_sum=0;
        rowcount=0;
        for(var i=1;i<lastRow;i++)
        {
            if(d['sch_t_'+level+'['+i+']'].value!='')
            {
		rowcount++;
		level_sum+=parseFloat(d['sch_t_'+level+'['+i+']'].value);
            }
        }
       d['sch_t_'+level+'['+lastRow+']'].value = (level_sum>0? parseFloat((level_sum/rowcount).toFixed(1)):'');
}

// JavaScript Document