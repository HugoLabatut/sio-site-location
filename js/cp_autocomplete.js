// autocompletion
function autocomplet_commune() {
    var min_length = 2; // nombre de caractère avant lancement recherch 
    var keyword = $('#cpbien').val();  // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../php/commune.autocomplete.php',
            type: 'POST',
            data: { keyword: keyword },
            success: function (data) {
                $('#listecommunes').show();
                $('#listecommunes').html(data);
            }
        });
    } else {
        $('#listecommunes').hide();
    }
}

// Lors du choix dans la liste
function set_item_commune(item, item2) {
    // change input value
    $('#cpbien').val(item);
    $('#vilbien').val(item2);
    // hide proposition list
    $('#listecommunes').hide();
}