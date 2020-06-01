 function deleteN(a){
        n = a.parentElement.getAttribute("id");
        $('#author_id').val($('#author_id').val().replace(n, ''));
    }

 //скрипт делал отдельно для обновления книги
 document.addEventListener('DOMContentLoaded', function() {
     var author = document.getElementById('author');
     var elem = document.getElementById('add_author');
     var authors = document.getElementById('authors');
     elem.onclick = function () {
         var newelem = document.createElement("tr");
         var newe = document.getElementById("author_id");
         var a = author.value;
         newelem.setAttribute('id',a);
         var i = author.selectedIndex;
         newelem.innerHTML = author.options[i].text+ '<a class="btn-danger btn" onclick="this.parentElement.remove(); deleteN(this);" id="del"> &times;</a>';
         newe.value = newe.value + ' ' + author.options[i].value;
         authors.append(newelem);
     };
 });
