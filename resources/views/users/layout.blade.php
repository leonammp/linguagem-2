<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="w-90 h-100">
        @include('layouts.navbar')
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {

        /* Adicionar Usuario*/
        $('#new-user').click(function () {
            $('#btn-save').val("create-user");
            $('#user').trigger("reset");
            $('#userCrudModal').html("Adicionar Usuário");
            $('#crud-modal').modal('show');
        });

        /* Editar Usuario */
        $('body').on('click', '#edit-user', function () {
            var user_id = $(this).data('id');
            $.get('user/'+user_id+'/edit', function (data) {
                $('#userCrudModal').html("Editar Usuário");
                $('#btn-update').val("Editar");
                $('#btn-save').prop('disabled',false);
                $('#crud-modal').modal('show');
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#address').val(data.address);
            })
        });
        /* Ver Usuário */
        $('body').on('click', '#show-user', function () {
            $('#userCrudModal-show').html("Detalhes do Usuário");
            $('#crud-modal-show').modal('show');
        });

        /* Deletar Usuario */
        $('body').on('click', '#delete-user', function () {
            var user_id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            confirm("Tem certeza que deseja deletar?");

            $.ajax({
                type: "DELETE",
                url: "user/"+user_id,
                data: {
                    "id": user_id,
                    "_token": token,
                },
                success: function (data) {
                    $('#msg').html('Usuário deletado com sucesso');
                    $("#user_id_" + user_id).remove();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        /* Mascaras */
        $("#phone").mask("(00) 0000-00009");
    });

</script>
</html>
