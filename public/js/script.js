var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
$(document).ready(function() {

  $("[data-bs-toggle=tooltip]").tooltip();
  var hash = document.location.hash;
if (hash) {
    console.log(hash);
    $('button[data-bs-target="'+hash+'"]').tab('show');
} 



})
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})



var options = {
	classname: 'page-load',
    id: 'page-load'
};
var nanobar = new Nanobar( options );
nanobar.go( 30 );
nanobar.go( 76 );
nanobar.go(100);
window.addEventListener("dragover",function(e){
  e = e || event;
  e.preventDefault();
},false);
window.addEventListener("drop",function(e){
  e = e || event;
  e.preventDefault();
},false);





  $("#menu-btn").click(function() {
    const menu = document.querySelector('#menu-btn');
    const target__menu = menu.dataset.target;
    
    $("#"+target__menu).toggle();
  
      var container = $("#"+target__menu);
      $(document).mouseup(function(e) 
      {
          var container = $("#drop-group");
      
          // if the target of the click isn't the container nor a descendant of the container
          if (!container.is(e.target) && container.has(e.target).length === 0) 
          {
            $("#"+target__menu).hide();
          }
      });


  });


  $("#menu-btn-2").click(function() {
    const menu = document.querySelector('#menu-btn-2');
    const target__menu = menu.dataset.target;
    
    $("#"+target__menu).toggle();
  
      var container = $("#"+target__menu);
      $(document).mouseup(function(e) 
      {
          var container = $("#drop-group-2");
      
          // if the target of the click isn't the container nor a descendant of the container
          if (!container.is(e.target) && container.has(e.target).length === 0) 
          {
            $("#"+target__menu).hide();
          }
      });


  });

$(document).ready(function () {
  const select_form_file = document.querySelector('#upload-files-form');
if(select_form_file){
  form_file = select_form_file.dataset.target;

$("#upload-files-form").click(function() {
    document.getElementById(form_file).click();
});





$("#"+form_file).on('change', function () {
  const typesselect = document.querySelector('#upload-files-form');
  var fileExtension = typesselect.dataset.types;
  var filesCount = $("#"+form_file)[0].files.length;

});

}

});




function redirectUserPage(e,id){
  window.location.replace("./user/"+id);
  e.preventDefault();
}


/*$(document).on('click',function(){

    $('.collapse').toggle();
})*/
$(document).ready(function () {
  $('.dropdown-toggle').dropdown();
});
