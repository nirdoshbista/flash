function handleChange(obj){
	var d = document.forms[0].elements;
	
        
        var disabled_keys=Array('library_and_computer_fund','sip_preparation_fund','financial_social_audit_fund',
                    'incentive_fund','capacity_development_fund','new_building_construction_fund',
                    'new_class_room_construction_fund','school_building_rehabilitation_fund',
                    'class_room_rehabilitation_fund','external_environment_improvement_fund',
                    'internal_income_service_fees','investment_interest','external_support','sip_preparation',
                    'financial_and_social_audit','library_computer','incentive','capacity_development',
                    'new_building_construction','new_class_room_construction','school_building_rehabilitation',
                    'class_room_rehabilitation','toilet_construction_girls_boys',
                    'miscellaneous','other_activities1','other_activities2');
        for(var i=0;i<disabled_keys.length;i++)
        {
            if(obj.id.indexOf(disabled_keys[i]) !== -1)
                return;
        }
        
        
	var id = obj.id.substring(0,obj.id.lastIndexOf('_'));
	
	var sum = 0;
	
	sum += d[id+"_1"].value * 1;
	sum += d[id+"_2"].value * 1;
	sum += d[id+"_3"].value * 1;
	sum += d[id+"_4"].value * 1;
	
	d[id+"_5"].value = sum?sum:'';
	
	
	// grand total
	var income = Array('teacher_salary_darbandi',
		'rahat_teacher_salary',
		'pcf_salary',
		'girls_scholarship',
		'dalit_scholarship',
		'disadvantaged_scholarship',
		'text_books_fund',
		'school_management_fund',
		'stationary_fund',
		'library_and_computer_fund',
		'sip_preparation_fund',
		'financial_social_audit_fund',
		'incentive_fund',
		'capacity_development_fund',
		'day_meal_implementation_fund',
		'new_building_construction_fund',
		'new_class_room_construction_fund',
		'school_building_rehabilitation_fund',
		'class_room_rehabilitation_fund',
		'external_environment_improvement_fund',
		'government_other_funds',
		'monthly_fees',
		'admission_yearly_fees',
		'internal_income_service_fees',
		'investment_interest',
		'external_support',
		'debit');

	
	for (level = 1; level <= 4; level++){
		sum = 0;
		
		for (i=0;i<income.length;i++){
			sum += d["i_"+income[i]+"_"+level].value * 1;
		}
		
		d["i_total_income_"+level].value = sum?sum:'';
		
	}
	
	var expenditure = Array('teacher_salary_darbandi',
		'rahat_teacher_salary',
		'pcf_salary',
		'girls_scholarship',
		'dalit_scholarship',
		'disadvantaged_scholarship',
		'text_books',
		'school_management',
		'stationary',
		'library_computer',
		'sip_preparation',
		'financial_and_social_audit',
		'incentive',
		'capacity_development',
		'day_meal_implementation',
		'new_building_construction',
		'new_class_room_construction',
		'school_building_rehabilitation',
		'class_room_rehabilitation',
		'toilet_construction_girls_boys',
		'girls_toilet_construction',
		'examination_conduction',
		'extra_curricular_activities',
		'miscellaneous',
		'other_activities1',
		'other_activities2',
		'credit');

	
	for (level = 1; level <= 4; level++){
		sum = 0;
		
		for (i=0;i<expenditure.length;i++){
			sum += d["e_"+expenditure[i]+"_"+level].value * 1;
		}
		
		d["e_total_"+level].value = sum?sum:'';
		
	}	
	
}
