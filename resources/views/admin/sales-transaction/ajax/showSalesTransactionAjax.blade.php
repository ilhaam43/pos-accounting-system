<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // DataTable
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('ajax.sales-transactions')}}",
            "lengthMenu": [ 10, 20, 30, 50 ],
            columns: [

                { data:'id', name: 'id', render: function (data, type, row, meta) 
                    {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },

                { data: 'transaction_code', name: 'transaction_code'},
                { data: 'transaction_total_price', name: 'transaction_total_price'},
                { data: 'transaction_total_quantity', name: 'transaction_total_quantity'},
                { data: 'pay', name: 'pay'},
                { data: 'change', name: 'change'},
                { data: 'created_at', name: 'created_at'},

                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ]
        });

    });
</script>