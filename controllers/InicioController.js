// $(".select2").select2();

function renderIcons(option) {
    if (!option.id) {
      return option.text;
    }
    var $icon = "<i class='bx bxl-" + $(option.element).data("icon") + " me-2'></i>" + option.text;
    return $icon
  }

$(".select2").wrap('<div class="position-relative"></div>').select2({
    templateResult: renderIcons,
    templateSelection: renderIcons,
    escapeMarkup: function(es) {
      return es;
    }
  });
  

  let _colors = [
    {"id":"blue","color":"#007bff","text":"blue"},
    {"id":"indigo","color":"#6610f2","text":"indigo"},
    {"id":"purple","color":"#696cff","text":"purple"},
    {"id":"pink","color":"#e83e8c","text":"pink"},
    {"id":"red","color":"#ff3e1d","text":"red"},
    {"id":"orange","color":"#fd7e14","text":"orange"},
    {"id":"yellow","color":"#ffab00","text":"yellow"},
    {"id":"green","color":"#71dd37","text":"green"},
    {"id":"teal","color":"#20c997","text":"teal"},
    {"id":"cyan","color":"#03c3ec","text":"cyan"},
    {"id":"white","color":"te #fff","text":"white"},
    {"id":"primary","color":"#696cff","text":"primary"},
    {"id":"secondary","color":"#8592a3","text":"secondary"},
    {"id":"success","color":"#71dd37","text":"success"},
    {"id":"info","color":"#03c3ec","text":"info"},
    {"id":"warning","color":"#ffab00","text":"warning"},
    {"id":"danger","color":"#ff3e1d","text":"danger"},
    {"id":"dark","color":"#233446","text":"dark"}
  ]
$(document).ready(function(){
  $(".select-color").select2({
      templateResult: function (data, container) {
          if (data.element) {
              $(container).css({"background-color":data.color,"color":"white"});
          }
          return data.text;
      },data:_colors
  });
});

function pruebas(){
  var colorservicio = document.getElementsByName('colorservicio')[0].value;
  console.log(colorservicio);
}