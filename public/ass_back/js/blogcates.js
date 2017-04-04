$('document').ready(function(){
    $('#newcate').click(function(){
        var ltr = $('tr:last');
        ltr.siblings('.in-edit,.in-new').find('.cate-cancel').click();
        var ntr = ltr.clone(true).insertBefore(ltr);
        ntr.addClass('in-new');
        ntr.toggle();     
    });

    $('.cate-edit').click(function(){
        var tr = $(this).parents('tr');
        tr.siblings('.in-edit,.in-new').find('.cate-cancel').click();
        tr.addClass('in-edit');
        tr.children(':eq(1),:eq(2)').each(function(){
            $(this).html('<input placeholder="'+$(this).html()+'" class="form-control">');
        });     
        tr.find('a').toggle();
    });

    $('.cate-cancel').click(function(){
        var tr = $(this).parents('tr');
        if (tr.hasClass('in-edit')) {
            tr.children().html(function(k,v){
                return $(this).find('input').attr('placeholder');
            }); 
        }else if(tr.hasClass('in-new')){
            tr.remove();
        }
        tr.find('a').toggle();
        tr.removeClass('in-edit');
        $('#cate-error').html('');
    });

    $('.cate-save').click(function(){
        var tr = $(this).parents('tr');
        var alias = tr.find('input:eq(0)').val();
        var name = tr.find('input:eq(1)').val();
        var id = tr.children(':eq(0)').html();

        $.ajax({
            type:'post',
            url:'/admin/blog/cate/save',
            data:{id:id,name:name,alias:alias},
        }).done(function(msg){
            var id = msg;
            tr.children(':eq(0)').html(id); 
            tr.children(':eq(1)').html(alias); 
            tr.children(':eq(2)').html(name);
            tr.find('a').toggle();
            tr.removeClass('in-edit');
        }).fail(function(msg){
            var err = msg.responseJSON;
            $('#cate-error').html('');
            $.each(err,function(k,v){
                $('#cate-error').html(function(){
                    return $(this).html()+'<br>'+v;
                })
            });       
        });
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});