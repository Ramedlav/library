function a_deleteN(a){
    n = a.parentElement.getAttribute("id");
    $('#a_author_id').val($('#a_author_id').val().replace(n, ''));
}

document.addEventListener('DOMContentLoaded', function() {
    var author = document.getElementById('a_author');
    var elem = document.getElementById('a_add_author');
    var authors = document.getElementById('a_authors');
    elem.onclick = function () {
        var newelem = document.createElement("tr");
        var newe = document.getElementById("a_author_id");
        var a = author.value;
        newelem.setAttribute('id',a);
        var i = author.selectedIndex;
        newelem.innerHTML = author.options[i].text+ '<a class="btn-danger btn" onclick="this.parentElement.remove(); a_deleteN(this);" id="del"> &times;</a>';
        newe.value = newe.value + ' ' + a;
        authors.append(newelem);
    };
});
