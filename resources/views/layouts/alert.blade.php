@if (Session::has('success'))
    <script>
        iziToast.success({
            title: 'Success',
            message: '{{ Session::get('success') }}',
            position: 'topRight'
        });
    </script>
@endif
