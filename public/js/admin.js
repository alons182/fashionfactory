$(function () {
	
    var cat = $( "#cat" ),
        published = $( "#published"),
        filters = $(".filtros"),
        gallery = $('#gallery'),
        infoBox = $('#InfoBox'),
        photos  = 0,
        chkProducts = $('.chk-product'),
        btnDeleteMultiple = $('.delete-multiple');

	$("form[data-confirm]").submit(function() {
        if ( ! confirm($(this).attr("data-confirm"))) {
            return false;
        }
    });

    
     setTimeout(function(){
        $('.flash-message').fadeOut();
     }, 2000);

    cat.change(function() {

        filters.find('form').submit();

    });

    published.change(function() {
        
        filters.find('form').submit();

    });

       
     chkProducts.on('click',function(e) {
        
        (verificaChkActivo(chkProducts)) ? btnDeleteMultiple.show('slow') : btnDeleteMultiple.hide('fast');


     });

     function verificaChkActivo (chks) {
        var state = false;
        
        chks.each(function(){ 
            
            if(this.checked)
            {
              
             state = true;

             
            }

        });

        return state;
     }

   
        

    
    var new_photos = function()
    {
        
        div=document.getElementById("inputs_photos");
        button=document.getElementById("add_input_photo");
        photos++;
        newitem="<strong>" + "Foto " + photos + ": </strong>";
        newitem+="<input type=\"file\" name=\"new_photo_file[]";
        newitem+="\" value=\"\"size=\"45\"><br>";
        newnode=document.createElement("span");
        newnode.innerHTML=newitem;
        div.insertBefore(newnode,button);
    };
    
    $("#add_input_photo").on('click',new_photos);
     

    
    $("#UploadButton").ajaxUpload({
        url : "/admin/photos",
        name: "file",
        data: {id: $('input[name=product_id]').val() },
        onSubmit: function() {
            infoBox.html('Uploading ... ');
        },
        onComplete: function(result) {
            
           infoBox.html('Uploaded succesfull!');
            
            var photos = jQuery.parseJSON(result);
          
            
            fillPhotosInfo(photos);

            gallery.find('li').find('.delete').on('click',deletePhoto);
           

        }
    });

    gallery.find('li').find('.delete').on('click',deletePhoto);
    
    function deletePhoto()
    {
        var btn_delete = $(this),
            url = "/admin/photos/" + btn_delete.attr("data-imagen");
        
        $.post(url, function(data){
            btn_delete.parent().fadeOut("slow");
        });
    }

    function photoTemplate(photo)
    {
  
          var templateHtml = $.trim( $('#photoTemplate').html() );
         
          var template = Handlebars.compile( templateHtml );

          return template(photo);
    
    }

  
    function fillPhotosInfo(jsonData) {
        if (jsonData.error) {
            return onError();
        }

        var html = photoTemplate(jsonData);
     
        (gallery.length === 0) ? gallery.html( html ) : gallery.prepend(html);
       
        gallery.find('li').eq(0).hide().show("slow");

    }

	
});