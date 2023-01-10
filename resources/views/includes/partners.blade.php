@push('js')
<script type="module">       
    window.onload = function() 
    {
        $("#view_societies").addClass("open");
        $("#partners_nav").addClass("active");

        $('tbody').on('click','#DeletePartner', function () {
            let id = $(this).attr("data-partner-id");
            let btn = $(this);
            $.ajax({
                url: '/partners/delete/'+id,
                success: function(Data){
                    if(Data.Type == 'SUCCESS'){
                        btn.closest('tr').css('display','none');
                        toastr.success(Data.Message)
                    }else if(Data.Type == 'ERROR'){
                        toastr.error(Data.Message)
                    }else{
                        toastr.warning(Data.Message)
                    }
                }
            });
        });
        $('button[id^="EditPartnerModalbtn"]').click( function(){
            let id = $(this).attr("data-partner-id");
            $.ajax({
                url: '/partners/show/'+id,
                dataType: 'json',
                success: function(Data){
                    $('#edit_name').val(Data["name"]);
                    $('#edit_companie').val(Data["companie"]);
                    $('#edit_gln').val(Data["gln"]);
                    $('#edit_adresse').val(Data["adresse"]);
                    $('#edit_description').val(Data["description"]);
                    $('#partner_id').val(Data["id"]);
                }
            });
        });
    
    var input = document.getElementById("search");
    input.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        if($('#search').val().trim().length > 0){
            var searchinput = $('#search').val();
            window.location.href = '/partners/search/'+searchinput;
        }
    }
    });

    }
</script>