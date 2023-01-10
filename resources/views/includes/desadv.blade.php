@push('js')
<script type="module">
window.onload = function() {
    $("#view_flux").addClass("open");
    $("#view_desadv").addClass("active");
    $('button[id^="ShowBl"]').on('click', function (event) {
            let id = $(this).attr("data-bl-id");
            $('button[id^="Download_file"]').attr("data-bl-id",id);
            $('span[id^="status_id"]').html('');
            $.ajax({
                url: '/flux/desadv/show/'+id,
                success: function(Data){
                    let line ="";
                    if(Data["status_id"] == "1"){
                        line ='<div class="badge badge-lg badge-success">Success</div>';
                    }else if(Data["status_id"] == "2"){
                        line ='<div class="badge badge-lg badge-danger">Error</div>';
                    }else{
                        line ='<div class="badge badge-lg badge-warning">Pending</div>';
                    }
                    $('#gln').html(id);
                    $('span[id^="status_id"]').append(line);
                    $('b[id^="nom_client_livraison"]').html(Data["nom_client_livraison"] ?? '---');	
                    $('span[id^="gln_livraison"]').html(Data["gln_livraison"] ?? '---');	
                    $('span[id^="adr_client_livraison"]').html(Data["adr_client_livraison"] ?? '---');	
                    $('span[id^="siege_client_livraison"]').html(Data["siege_client_livraison"] ?? '---');
                    $('b[id^="nom_client_commande"]').html(Data["nom_client_commande"] ?? '---');	
                    $('span[id^="gln_client_commande"]').html(Data["gln_client_commande"] ?? '---');	
                    $('span[id^="adr_client_commande"]').html(Data["adr_client_commande"] ?? '---');	
                    $('span[id^="siege_client_commande"]').html(Data["siege_client_commande"] ?? '---');	
                    $('span[id^="date_document"]').html(Data["date_document"] ?? '---');	
                    $('span[id^="nom_fournisseur"]').html(Data["nom_fournisseur"] ?? '---');	
                    $('span[id^="ref_invoice"]').html(Data["ref_invoice"] ?? '---');
                    // $('span[id^="date_invoicing"]').html(Data["date_invoicing"] ?? '---');
                    $('b[id^="ref_order"]').html(Data["ref_order"] ?? '---');
                    $('span[id^="date_order"]').html(Data["date_order"] ?? '---');
                    $('b[id^="ref_desadv"]').html(Data["ref_desadv"] ?? '---');	
                    $('span[id^="ref_desadv"]').html(Data["ref_desadv"] ?? '---');	
                    $('span[id^="date_reception_desadv"]').html(Data["date_reception_desadv"] ?? '---');
                    $('span[id^="gln_fournisseur"]').html(Data["gln_fournisseur"] ?? '---');
                    $('span[id^="date_livraison"]').html(Data["date_livraison"] ?? '---');
                    $('span[id^="adresse_livraison"]').html(Data["adresse_livraison"] ?? '---');


                }
            });
    });

    $('button[id^="Download_file"]').on('click', function (event) {
        let type_flux = $(this).attr("data-type-data");
        let type_file = $(this).attr("data-type-file");
        let id_flux = $(this).attr("data-bl-id");
        window.location='/flux/download/'+type_flux+'/'+type_file+'/file/'+type_file+'/'+id_flux;
    });


    

$('a[class^="adr_client_livraison_open"]').on('click', function (event){
    $('#adr_client_livraison_area').html($('#adr_client_livraison').text());
    $('#adr_client_livraison_area').show();
    $('#adr_client_livraison_btnconfirme').show();
    $('#adr_client_livraison').hide();
    $('.adr_client_livraison_open').hide();
    $('#adr_client_livraison_btncancel').show();

})

$('a[id^="adr_client_livraison_btncancel"]').on('click', function (event){
    $('#adr_client_livraison_area').hide();
    $('#adr_client_livraison_btnconfirme').hide();
    $('#adr_client_livraison_btncancel').hide();
    $('.adr_client_livraison_open').show();
    $('#adr_client_livraison').show();
})
    

$('a[id^="adr_client_livraison_btnconfirme"]').on('click', function (event){
    let gln = $('span[id^="gln_livraison"]').text();
    let adr = $('#adr_client_livraison_area').val();
    $.ajax({
        url: '/flux/desadv/edit/'+gln+'/'+adr,
        success: function(Data){
            $('#adr_client_livraison').html(Data["adresse"]);
            $('#adr_client_livraison_area').hide();
            $('#adr_client_livraison_btnconfirme').hide();
            $('#adr_client_livraison_btncancel').hide();
            $('.adr_client_livraison_open').show();
            $('#adr_client_livraison').show();
        }
    })
})

$('a[class^="adr_client_commande_open"]').on('click', function (event){
    $('#adr_client_commande_area').html($('#adr_client_commande').text());
    $('#adr_client_commande_area').show();
    $('#adr_client_commande_btnconfirme').show();
    $('#adr_client_commande').hide();
    $('.adr_client_commande_open').hide();
    $('#adr_client_commande_btncancel').show();

})

$('a[id^="adr_client_commande_btncancel"]').on('click', function (event){
    $('#adr_client_commande_area').hide();
    $('#adr_client_commande_btnconfirme').hide();
    $('#adr_client_commande_btncancel').hide();
    $('.adr_client_commande_open').show();
    $('#adr_client_commande').show();
})

$('a[id^="adr_client_commande_btnconfirme"]').on('click', function (event){
    let gln = $('span[id^="gln_client_commande"]').text();
    let adr = $('#adr_client_commande_area').val();
    $.ajax({
        url: '/flux/desadv/edit/'+gln+'/'+adr,
        success: function(Data){
            $('#adr_client_commande').html(Data["adresse"]);
            $('#adr_client_commande_area').hide();
            $('#adr_client_commande_btnconfirme').hide();
            $('#adr_client_commande_btncancel').hide();
            $('.adr_client_commande_open').show();
            $('#adr_client_commande').show();
        }
    })
})
    
    

}
</script>