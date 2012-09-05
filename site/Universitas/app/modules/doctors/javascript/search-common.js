
$(document).ready(function() {
  // $(".location").ellipsis();
});
$('#container').live('pageinit', function (event) {
    
    
    //Refresh news when btnRefresh is clicked
   	$( "#btnMore" ).live( "click", 
   	  function() {
   	    getAndDisplayNextPage();
   	  });
   	  
});



  
getAndDisplayNextPage = function() {
  //Starting loading animation
  $.mobile.showPageLoadingMsg();
  //Get next page and add success callback using then
  getMore().then( function() {    
    //Stop loading animation on success
    $.mobile.hidePageLoadingMsg(  );    
  });    
};

getMore = function() {
  //Get next page via ajax and return jqXhr
  var url = $("#btnMore").attr("data-url");
  return $.ajax({
    url: url,
    dataType: "html",
    success:function( data ) {
      $("#liMore").replaceWith(data); 
    },
    complete:function(  ) {
      $("#physician_list").listview("refresh");
      $('#btnMore').button();
           // $("#physician_list .location").ellipsis();
 
    }
    });
  };