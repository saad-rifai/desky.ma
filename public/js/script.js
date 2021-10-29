var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
$(document).ready(function() {

  $("[data-bs-toggle=tooltip]").tooltip();
      })
document.addEventListener('DOMContentLoaded', function () {

  var mains = new Splide( '.splide', {
    type  : 'fade',
    pagination : false,
    heightRatio: 0.5,
    rewind: true,
  } );
 var thumbnails = new Splide( '#thumbnail-slider', {
  arrows: false,
    fixedWidth  : 100,
    fixedHeight : 60,
    gap         : 10,
    rewind      : true,
    pagination  : false,
    cover       : true,
    isNavigation: true,
    breakpoints : {
      600: {
        fixedWidth : 60,
        fixedHeight: 44,
      },
    },
  } );
  

  mains.sync( thumbnails );
  mains.mount(window.splide.Extensions);
  thumbnails.mount(window.splide.Extensions);

 
} );

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

  $('.js-country-basic').select2();




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


$('#upload-files-form').on('dragover', function(e) {
  $("#"+form_file).prop("files", e.originalEvent.dataTransfer.files);
});


$('#upload-files-form').on('drop', function(e) {

  $("#"+form_file).prop("files", e.originalEvent.dataTransfer.files);

});


$("#"+form_file).on('change', function () {
  const typesselect = document.querySelector('#upload-files-form');
  var fileExtension = typesselect.dataset.types;
  var filesCount = $("#"+form_file)[0].files.length;
  if(filesCount > 5){
    $("#form_upload_error").text("  عدد الملفات أكثر من المسموح به الحد الأقصى 5 ملفات");
    $("#form_upload_error").removeAttr('hidden');
  }else{
    $("#form_upload_error").attr('hidden', true);

  }
});

}

});



  $('#activety-tags').select2({
    placeholder: "تحديد النشاط",
    allowClear: true,
    language: {
      noResults: function() {
        return 'لا توجد نتيجة';
      },
    },
    escapeMarkup: function(markup) {
      return markup;
    },
  });
  $('#activety-tags-2').select2({
    placeholder: "النشاط",
    allowClear: true,
    language: {
      noResults: function() {
        return 'لا توجد نتيجة';
      },
    },
    escapeMarkup: function(markup) {
      return markup;
    },
  });


function redirectUserPage(e,id){
  window.location.replace("./user/"+id);
  e.preventDefault();
}

