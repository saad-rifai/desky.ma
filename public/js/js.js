
$(document).ready(function(){
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 100) {
            $(".navbar-transparent").css("background" , "#ffffff");
            $(".navbar-transparent .nav-item .nav-link").css("color" , "#000000");  
            $(".navbar-transparent").css("border" , "solid 1px #f5f5f5");  
            $(".btn-tg-white").css("color" , "#000000");  
            $(".btn-tg-white").css("border" , "none");  
            $(".transparent-nav-logo").attr("src", "/img/logo-web.png");
        }
        else{
            $(".navbar-transparent .nav-item .nav-link").css("color" , "#ffffff");  
            $(".navbar-transparent").css("background" , "#ffffff00");  
            $(".navbar-transparent").css("border" , "none"); 
            $(".btn-tg-white").css("color" , "#ffffff");  
            $(".transparent-nav-logo").attr("src", "/img/logo-web-white.png");
        }
    })
  })
  function stopLoading(){
    $(".page-load").css("opacity" , "0");
    $(".page-load").css("display" , "none");
  }
  const rangeInputs = document.querySelectorAll('input[type="range"]')
  const numberInput = document.querySelector('input[type="number"]')
  
  function handleInputChange(e) {
    let target = e.target
    if (e.target.type !== 'range') {
      target = document.getElementById('range')
    } 
    const min = target.min
    const max = target.max
    const val = target.value
    
    target.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%'
  }
  
  rangeInputs.forEach(input => {
    input.addEventListener('input', handleInputChange)
  })
  
  numberInput.addEventListener('input', handleInputChange)