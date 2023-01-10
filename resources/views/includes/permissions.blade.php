@push('js')
<script type="module">       
window.onload = function() 
    {
            $("#view_permissions").addClass("open");
            $("#permissions_nav").addClass("active");
            $('tbody').on('click','#DeleteRule', function () {
            let id = $(this).attr("data-id");
            let btn = $(this);
            $.get('/permissions/role/delete/'+id, function (Data){
                btn.closest('tr').css('display','none');
            });

        });
        $('tbody').on('click','#DeletePermission', function () {
            let id = $(this).attr("data-id");
            let btn = $(this);
            $.get('/permissions/perm/delete/'+id, function (Data){
                btn.closest('tr').css('display','none');
            });

        });
        $('#display_name').on("input", function() {
        let display_name = this.value.replace(/ /g,"_").toLowerCase();
        $('#name').val(display_name);
    });   
    }
</script>
