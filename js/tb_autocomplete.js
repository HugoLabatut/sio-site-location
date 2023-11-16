// autocompletion
function autocomplet_tbien() {
    
    var min_length = 2; // nombre de caractère avant lancement recherch 
    var keyword = $('#typebien').val();  // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../php/typebien.autocomplete.php',
            type: 'POST',
            data: { keyword: keyword },
            success: function (data) {
                $('#libtypesbien').show();
                $('#libtypesbien').html(data);
            }
        });
    } else {
        $('#libtypesbien').hide();
    }
}

// Lors du choix dans la liste
function set_item_tbien(item) {
    // change input value
    $('#typebien').val(item);
    // hide proposition list
    $('#libtypesbien').hide();
}
