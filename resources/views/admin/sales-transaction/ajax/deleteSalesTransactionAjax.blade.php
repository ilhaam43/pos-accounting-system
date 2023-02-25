<script>
function deleteConfirmation(id) {
    swal({
        title: "Hapus data penjualan",
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
                url: "/admin/sales-transactions/" + id,
                data: {_token: CSRF_TOKEN, _method: 'DELETE'},
                dataType: 'JSON',
                success: function (results) {
                    if (results.success === true) {
                        swal("Berhasil!", results.message, "success");
                        window.setTimeout(function(){ 
                            window.location.replace('/admin/sales-transactions');
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
