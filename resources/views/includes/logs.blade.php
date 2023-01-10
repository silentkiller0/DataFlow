@push('js')
<script type="module">
    window.onload = function() 
    {
        $("#view_logs").addClass("active");
        $('.userFrame').on('click', function (event) {

            $('#logsHeader').html('');
            $('#LogsContent').html('');
            $('.fa-eye').attr("hidden",true);
            let id = $(this).attr("data-user-id");


            

            let btn = $(this);
            console.log("id : "+id);
            $('#view_eye_'+id).removeAttr('hidden');
            $.ajax({
                url: '/logs/show/'+id,
                success: function(Data){
                    let index =0;
                    if(Data.Type == 'SUCCESS'){
                        $('#logsHeader').append('<b>Log file size : '+Data.Size+' Octets</b> <a href="/logs/delete/'+id+'">[Supprimer les logs]</a>');
                        Data.Logs.reverse().forEach(line => {
                            index++;
                            let log = line.split(';');
                            line = '<tr data-toggle="collapse" data-target="#log_view_'+index+'" class="accordion-toggle">';
                            line += '<td style="width:20%" class="text-'+(log[0] == "ERROR" ? "danger" : log[0])+'"><i class="fa fa-check-circle"></i> '+log[0]+'</td>'
                            line += '<td style="width:20%">'+log[1]+'</td>';
                            line += '<td style="width:30%">'+log[2]+'</td>';
                            line += '<td style="width:20%">'+log[3]+'</td>';
                            line += '<td style="width:5%"><button class="btn btn-default btn-xs"><b>View</b></button>';
                            line += '</td></tr>';
                            line += '<tr><td colspan="6">';
                            line += '<div id="log_view_'+index+'" class="collapse alert alert-'+(log[0] == "ERROR" ? "danger" : log[0])+'" style="padding-left:15px">'+log[4]+'</div>';
                            line += '</td></tr>';
                            $('#LogsContent').append(line);
                        });
                    }else{
                        $('#logsHeader').html('');
                        $('#logsHeader').append('<b style="color:red">'+Data.Message+'</b>');
                    }
                    
                }
            });
        });
    }
</script>
