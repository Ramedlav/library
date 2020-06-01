            $('document').ready(function () {
                $('#updateForm').on('submit', function (e) {
                    e.preventDefault();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        type : "POST",
                        url : "/book/update",
                        data : $('#changeModal').serialize(),
                        success : function (response) {
                            console.log(response);
                            $('#updateForm').modal('hide');
                            alert('changes are saved');
                        },
                        error: function (error) {
                            console.log(error);
                            // document.body.textContent = JSON.stringify(data);
                            // console.log(data);
                            alert('data is not saved');
                        }
                    });
                });
            });
