function setUser(id){
    document.getElementById('form_field_id_user').value = id;
}

function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};