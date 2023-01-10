@push('js')
<script type="module">
    window.onload = function() 
    {
        $("#view_users").addClass("active");
        $('tbody').on('click','#DeleteUser', function () {
            let id = $(this).attr("data-user-id");
            let btn = $(this);
            $.ajax({
                url: '/users/delete/'+id,
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
        $('button[id^="updateUserFormbtn"]').click( function(){
            let id = $(this).attr("data-user-id");
            $.ajax({
                url: '/users/show/'+id,
                dataType: 'json',
                success: function(Data){
                    console.log(Data);
                    $('#edit_lastname').val(Data["lastname"]);
                    $('#edit_firstname').val(Data["firstname"]);
                    $('#edit_username').val(Data["username"]);
                    $('#edit_email').val(Data["email"]);
                    $('#edit_rule').val(Data["rule"]);
                    $('#edit_companies').val(Data["companies"]);
                    if(Data["active"] == 1){$('#edit_active').prop('checked', true);}
                    $('#user_id').val(Data["id"]);
                }
            });
    });
    var input = document.getElementById("search");
    input.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        if($('#search').val().trim().length > 0){
            var searchinput = $('#search').val();
            window.location.href = '/users/search/'+searchinput;
        }
    }
    });
    $('#email').on("input", function() {
        let email = this.value;
        $('#username').val(email);
    });

    $('#edit_email').on("input", function() {
        let edit_email = this.value;
        $('#edit_username').val(edit_email);
    });
    }
</script>