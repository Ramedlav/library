        $('document').ready(function () {
            $('#addForm').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type : "POST",
                    url : "/book/add",
                    data : $('#addModal').serialize(),
                    success : function (response) {
                        console.log(response);
                        $('#addForm').modal('hide');
                        alert('changes are saved');
                    },
                    error: function (error) {
                        console.log(error);
                        console.log(data);
                        alert('data is not saved');
                    }
                });
            });
        });
