<script>
function deleteConfirmation(id) {
    swal({
        title: "Hapus data pengguna",
        text: "Apakah kamu yakin ingin menghapus data ini?",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
        reverseButtons: !0
    }).then(function (e) {
        if (e.value === true) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: "/owner/users/" + id,
                data: {_token: CSRF_TOKEN, _method: 'DELETE'},
                dataType: 'JSON',
                success: function (results) {
                    if (results.success === true) {
                        swal("Berhasil!", results.message, "success");
                        window.setTimeout(function(){ 
                            window.location.replace('/owner/users');
                        }, 2000);
                    } else {
                        swal("Gagal!", results.message, "error");
                    }
                }
            });
        } else {
            e.dismiss;
        }

    }, function (dismiss) {
        return false;
    })
}
</script>
