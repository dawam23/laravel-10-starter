<script>
    $('#navUsers').addClass('active')
    $('#usersTable').dataTable( {
            // set index of column to set default ordering
            order: [[1, 'asc']],
            //defind class for non-sortable column
            "columnDefs": [ {
                "targets": 'no-sort',
                "orderable": false,
                }],
        } );

    $('#delete-user').on('show.bs.modal', function (event) {
        var a = $(event.relatedTarget);
        var action = a.data('action');
        var name = a.data('name');
        var modal = $(this);
        modal.find('form').attr('action', action);
        $('#user-name').text(name)
    });
</script>
