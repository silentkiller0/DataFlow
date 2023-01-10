
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module">            
window.onload = function() 
    {

        
        $("#view_configuration").addClass("active");
        $('tbody').on('click','#DeleteSF', function () {
            let id = $(this).attr("data-id");
            let btn = $(this);
            $.get('/configurations/DeleteStatusFlux/'+id, function (Data){
                    btn.closest('tr').css('display','none');
                    if(Data.Type == 'SUCCESS'){
                        btn.closest('tr').css('display','none');
                        toastr.success(Data.Message)
                    }else if(Data.Type == 'ERROR'){
                        toastr.error(Data.Message)
                    }else{
                        toastr.warning(Data.Message)
                    }
            });

        });

        $('tbody').on('click','#DeleteFD', function () {
            let id = $(this).attr("data-id");
            console.log(id);
            let btn = $(this);
            $.get('/configurations/DeleteTypeDocument/'+id, function (Data){
                btn.closest('tr').css('display','none');
                if(Data.Type == 'SUCCESS'){
                        btn.closest('tr').css('display','none');
                        toastr.success(Data.Message)
                    }else if(Data.Type == 'ERROR'){
                        toastr.error(Data.Message)
                    }else{
                        toastr.warning(Data.Message)
                    }
            });

        });

    }

</script>
