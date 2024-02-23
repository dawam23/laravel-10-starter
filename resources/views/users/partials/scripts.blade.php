<script>
    $('#navUsers').addClass('active')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#usersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                {data: 'avatar', name: '', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'role', name: 'role'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#delete-user').on('show.bs.modal', function (event) {
            var a = $(event.relatedTarget);
            var action = a.data('action');
            var name = a.data('name');
            var modal = $(this);
            modal.find('form').attr('action', action);
            $('#user-name').text(name)
        });
</script>
