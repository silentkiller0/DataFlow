@push('js')
<script type="module">
    window.onload = function() 
    {
        $("#view_societies").addClass("open");
        $("#companies_nav").addClass("active");
            $('button[id^="EditCompanyModalbtn"]').click( function(){
                    let id = $(this).attr("data-company-id");
                    $('#partners').html("");
                    $.ajax({
                        url: '/societies/show/'+id,
                        dataType: 'json',
                        success: function(Data){
                            $('#edit_name').val(Data["name"]);
                            $('#edit_email').val(Data["email"]);
                            $('#edit_maincompanie').val(Data["maincompanie"]);
                            $('#edit_telephone').val(Data["telephone"]);
                            $('#edit_website').val(Data["website"]);
                            $('#company_id').val(Data["id"]);
                            console.log(Data["partners"]);
                            for(let partner of Data["partners"]){
                                console.log(partner);
                                let ligne = '<div class="chip chip-primary"><div class="chip-body"><div class="chip-text">'+partner?.name+'</div></div></div> ';
                                $('#partners').append(ligne);
                            }
                        }
                    });
            });
            $('tbody').on('click','#deleteSocietyBtn', function () {
            let id = $(this).attr("data-company-id");
            let btn = $(this);
            $.ajax({
                url: '/societies/delete/'+id,
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
        var input = document.getElementById("search");
        input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            if($('#search').val().trim().length > 0){
                var searchinput = $('#search').val();
                window.location.href = '/societies/search/'+searchinput;
            }
        }
        });
    }
</script>