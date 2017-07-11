$(function(){
  $(".card").draggable({
    // var stop;
    stop : function (event , ui){
      var offset = $(this).offset();
      // alert(offset.left);
      if (offset.left <= -50){
        alert("batsu");
        $(this).css("display","none");
      }else if (offset.left >= 180) {
        alert("maru");
        // $(".submit").click();
        $(this).css("display","none");
      }else{
        $(this).css({top:0,right:0,left:0,bottom:0});
      }
    }
  });

  $(".select_maru").on("click", function(){

  });
})