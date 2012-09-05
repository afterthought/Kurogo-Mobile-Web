 
 
function scroll_to(div){
    $('html, body').animate({
        scrollTop: div.offset().top
    },500);
}
$(document).ready(function() {
  $("#last_name, #first_name, #city, #specialty").focus(function() {
    scroll_to($(this));
  });
  
  setupFirstNameAutoComplete();
  setupLastNameAutoComplete();
	
	$("#last_name").change(function() {
    setupFirstNameAutoComplete();
  });
  
  $("#first_name").change(function() {
    setupLastNameAutoComplete();
  });
  
});
 
function setupFirstNameAutoComplete() {
 		$("#first_name").autocomplete({
		target: $('#firstname_suggestions'),
		source: function(text,callback) { 
		  $.ajax({
        url: '/rest/doctors/autocomplete?field=first_name&term='+text+'&last_name!match=/^' + $("#last_name").val() + '/i&distinct_fields[first_name]=first_name',
      }).done(function ( data ) {
        if( console && console.log ) {
          console.log("Sample of data:", data.response.distinct_values);
        }
        callback(data.response.distinct_values); 
      });
		  
		},
		
		minLength: 1,
		callback: function(e) {
		  var $a = $(e.currentTarget);
		  $("#first_name").val($a.text());
	 		$("#first_name").autocomplete('clear');
	 		setupLastNameAutoComplete();	
		}
	}); 
}
function setupLastNameAutoComplete() {
  $("#last_name").autocomplete({
		target: $('#lastname_suggestions'),
    source: function(text,callback) { 
		  $.ajax({
        url: '/rest/doctors/autocomplete?field=last_name&term='+text+'&first_name!match=/^' + $("#first_name").val() + '/i&distinct_fields[last_name]=last_name',
      }).done(function ( data ) {
        if( console && console.log ) {
          console.log("Sample of data:", data.response.distinct_values);
        }
        callback(data.response.distinct_values); 
      });
		},
    

		minLength: 1,
		callback: function(e) {
		  var $a = $(e.currentTarget);
			$("#last_name").val($a.text());
		 	$("#last_name").autocomplete('clear');
		 	setupFirstNameAutoComplete();			
		}
	});
}