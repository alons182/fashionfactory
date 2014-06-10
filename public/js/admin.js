$(function () {
	
    var cat = $( "#cat" ),
        published = $( "#published"),
        filters = $(".filtros"),
        gallery = $('#gallery'),
        infoBox = $('#InfoBox'),
        photos  = 0,
        chkProducts = $('.chk-product'),
        btnDeleteMultiple = $('.delete-multiple'),
        inputsPhotos = $("#inputs_photos"),
        inputsSizes = $("#inputs-sizes"),
        inputsColors = $("#inputs-colors"),
        colorfield =  $('.colorfield'),
        products;

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
        
        (verificaChkActivo(chkProducts)) ? btnDeleteMultiple.show('fast') : btnDeleteMultiple.hide('fast');


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

   

    $("#add_input_photo").on('click', function (e) {
        photos++;
       
       inputsPhotos.append('<div><strong>Foto' + photos + ': </strong>'+
                                  '<input type="file" name="new_photo_file[]" size="45" /></div><br />');
        
    });

    $("#add_input_size").on('click', function (e) {
        
       inputsSizes.append('<div class="col-xs-3">'+
                           '<span class="delete" ><i class="glyphicon glyphicon-remove"></i></span>'+
                           '<input type="text" name="sizes[]" class="form-control " /></div>');
        
    });

     $("#add_input_color").on('click', function (e) {
        
       inputsColors.append('<div class="col-xs-3">'+
                           '<span class="delete" ><i class="glyphicon glyphicon-remove"></i></span>'+
                           '<input type="text" name="colors[]" class="form-control colorfield" /></div>');

        colPick($('.colorfield'));
        
    });

     function colPick (input) {
         
          var colorx;

         input.each(function(){ 
          
           colorx = ($(this).val() == "ffffff") ? "000000" : "ffffff";

           $(this).siblings('.delete').css('color', '#'+colorx);
           $(this).css('border-color','#'+ $(this).val());

         });
         
         
         input.colpick({
                layout:'hex',
                submit:0,
                colorScheme:'dark',
                onChange:function(hsb,hex,rgb,el,bySetColor) {
                    colorx = ($(el).val() == "ffffff") ? "000000" : "ffffff";
                    
                    $(el).siblings('.delete').css('color', '#'+colorx);
                    $(el).css('border-color','#'+hex);
                    // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
                    if(!bySetColor) $(el).val(hex);
                }
            }).keyup(function(){
                $(this).colpickSetColor(this.value);
            });
     }

     colPick(colorfield);

    
        
       
    inputsSizes.on('click','.delete',function (e) {
       
        $(this).parent('div').remove();
    });
    inputsColors.on('click','.delete',function (e) {
       
        $(this).parent('div').remove();
    });

    $('.relateds').on('click', '.delete', function(e) {
       $(this).parent('li').remove();
    });

    $('#btn-add-product').on('click', function(event) {
      event.preventDefault();
       getProducts(fillProductsInfo); 
    });

    $('#modalAddProduct').find('.btn-primary').on('click', function(event) {
      event.preventDefault();
      
      //var allVals = [];
       $('[name=chkRelateds]:checked').each(function() {
        // allVals.push($(this).val());
         
         for (var i = 0 ; i < products.length; i++) {
             
             if($(this).val() == products[i].id)
              {
                 
                  if (yaAgregado($(this).val()) == false)
                  {
                    $('ul.relateds').append('<li data-id="' + products[i].id +'"><span class="delete" data-id="'+ products[i].id +'"><i class="glyphicon glyphicon-remove"></i></span>'+
                                        '<span class="label label-success">'+ products[i].name +'</span>'+
                                        '<input type="hidden" name="relateds[]" value="'+ products[i].id +'"></li>');

                  }

                  
                 
              }
         };
         
         
       });
      
     $('#modalAddProduct').modal('hide');
    
      
      

     
    });

    
    function yaAgregado(id){
        
        var res = false;
       
        $('.relateds').children('li').each(function() {
              
            if($(this).data('id') == parseInt(id))
              res = true;
            
        });

        return res;

    }
    function getProducts (callback) {
              $.ajax({
                            
                  url : '/admin/products/list',
                  dataType : 'json',
                  data : { exc_id: $('input[name=product_id]').val() }

                }).done(callback);
    }

    function ProductTemplate(products)
    {
         
          var templateHtml = $.trim( $('#productsTemplate').html() );
         
          var template = Handlebars.compile( templateHtml );

          return template(products);
    
    }

  
    function fillProductsInfo(jsonData) {
        if (jsonData.error) {
            return onError();
        }

         products = $.map(jsonData ,function(obj, index){
                return {
                    id : obj.id,
                    name : obj.name,
                    image : obj.image
                   
                } 
               
            });
        
        var html = ProductTemplate(products);
       
        $('#modalAddProduct').find('.tbody').html( html );
     
     

    }
    
    function deletePhoto()
    {
        var btn_delete = $(this),
            url = "/admin/photos/" + btn_delete.attr("data-imagen");
        
        $.post(url, function(data){
            btn_delete.parent().fadeOut("slow");
        });
    }
    
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