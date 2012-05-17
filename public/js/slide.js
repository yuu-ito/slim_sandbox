$(function(){
   $.ajax("http://api.flickr.com/services/feeds/photos_public.gne?format=json&tagmode=any&jsoncallback=?"
           +"&tags=yuiaragaki",{
      type: "GET",
      timeout: 3000,
      async: true,
      dataType: "json",
      success: function(data){
        $.each( data.items, function(i,item){
          $("<div>")
            .append($("<img>")
                     .attr("src",item.media.m)
                     .css("position","relative")
                     )
            .css("float","left")
            .appendTo($("#slideframe"));
        });
        console.log(data);
      },
      error: function(xhr, status, error){
      }
      });
     //$("#slideframe")
     //.css("overflow","hidden")
     //.css("height","110px");
     $("body").bind("click",function(){

         $(this).width("+=500");
         $("#slideframe img").animate({"left":"-=500px"},"slow");
         img = $("#slideframe img:first");
         //$("#slideframe img:first")
         //.animate(
         //      {width: "toggle", opacity: "toggle"},
         //          {duration: "slow", easing: "linear",
         //               complete: function(){  },
         //                    step: function(s){$("#steps").text(s)}
         //                        });
         $("#slideframe img:first")
         .remove();
         $(this).append(img);
         });
   });

