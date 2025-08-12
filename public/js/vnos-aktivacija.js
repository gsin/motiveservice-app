$(function() {
	 /*
	$( "#datum_prve_reg" ).datepicker({"altField" : "#actualDate"});
	$( "#datum_prve_reg" ).datepicker( "option", "dateFormat", "d.m.yy");


	$( "#datum_rojstva" ).datepicker();
	$( "#datum_rojstva" ).datepicker( "option", "dateFormat", "d.m.yy");


	$( "#datum_podpisa" ).datepicker();
	$( "#datum_podpisa" ).datepicker( "option", "dateFormat", "d.m.yy");
	$( "#datum_podpisa" ).val(new Date().toLocaleDateString("SL-si").split(' ').join(''));

	
	$( "#datum_predaje" ).datepicker();
	$( "#datum_predaje" ).datepicker( "option", "dateFormat", "d.m.yy");
	$( "#datum_predaje" ).val(new Date().toLocaleDateString("SL-si").split(' ').join(''));

	$( "#datum_jamstvo_od" ).datepicker();
	$( "#datum_jamstvo_od" ).datepicker( "option", "dateFormat", "d.m.yy");
	$( "#datum_jamstvo_od" ).val(new Date().toLocaleDateString("SL-si").split(' ').join(''));
	*/
	function umakni_neustrezne(value, index, array) {
	  	$("#tip_jamstva option[value='" + value + "']").remove();
	}

	function datum_format(value){

		var valueNew = value;
		if (value.length < 8)
			return value;

		if (value.split(".").length-1 == 0) {
			valueNew = value.substring(0,2) +"."+ value.substring(2,4) + "." + value.substring(4,8)
		}
	
		return valueNew;
	}
	
	function datum_onChange(value, index, array){

		$('#' + value).change(function(){
			$('#' + value).val(datum_format($('#' + value).val()));
		});
	}

	$('#km').change(function() {  
		var ccm = parseInt($("#ccm").val());
		
		var neustrezni =  Array();
		$("#tip_jamstva option").each(function()
		{
			var val = $(this).val();
			var label = $(this).text();
			
		    var ccmOd = label.substring(label.indexOf(" od ") + 4, label.indexOf(" do ") );	
			var ccmDo = label.substring(label.indexOf(" do ") + 4, label.indexOf(" ccm") );

			 if (ccm >= ccmOd && ccm <= ccmDo){
			 	console.log('Ustreza');
			 }	
			 else {		 	
			 	neustrezni.push(val);
			 }

		});
		neustrezni.forEach(umakni_neustrezne);
	});

	 


	$('#datum_prve_reg').change(function(){
		$('#datum_prve_reg').val(datum_format($('#datum_prve_reg').val()));


	});

	$('#datum_rojstva').change(function(){
		$('#datum_rojstva').val(datum_format($('#datum_rojstva').val()));
	});

	$('#datum_podpisa').change(function(){
		$('#datum_podpisa').val(datum_format($('#datum_podpisa').val()));
		$('#datum_predaje').val($('#datum_podpisa').val());
		$('#datum_jamstvo_od').val($('#datum_podpisa').val());
	});

	$('#datum_predaje').change(function(){
		$('#datum_predaje').val(datum_format($('#datum_predaje').val()));
	});

	$('#datum_jamstvo_od').change(function(){
		$('#datum_jamstvo_od').val(datum_format($('#datum_jamstvo_od').val()));
	});


});

