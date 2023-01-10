@push('js')
<script type="module">
window.onload = function() {
    $("#view_permissions").addClass("open");
    $("#acces_nav").addClass("active");
    var input = document.getElementById("search");
    input.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        if($('#search').val().trim().length > 0){
            var searchinput = $('#search').val();
            window.location.href = '/acces/search/'+searchinput;
        }
    }
    });
    $('button[id^="permissionsmodalbtn"]').click( function(){
            $('input[type=checkbox]').prop('checked',false);
            $('#user_id').val('');
            let CountPermissions = $('#CountPermissions').val();
            let id = $(this).attr("data-user-id");
            $.ajax({
                url: '/acces/show/'+id,
                dataType: 'json',
                success: function(Data){
                    for(let i = 0;i< CountPermissions;i++){
                        if(Data[i]){
                            $('#permission_'+Data[i].permission_id).prop('checked', true);
                        }
                    }
                    $('#user_id').val(id);
                }
            });
    });
}
</script>