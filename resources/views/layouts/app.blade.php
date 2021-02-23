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
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <script src="https://kit.fontawesome.com/57b8a0c840.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') . '?v=' . time() }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />
</head>
<body>
{{--#f7f7f7--}}
<div id="app">
    @include('layouts.navbar')
    <div class="container-fluid">
        @yield('content')
    </div>
</div>
<div class="container mt-5 pt-5 mb-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <span style="color: gray">Desenvolvido por</span> <a href="https://github.com/leonammp/" target="_blank">Leonam Mendonça</a>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {

        /* Adicionar Usuario*/
        $('#new-user').click(function () {
            $('#btn-save').val("create-user");
            $('#user').trigger("reset");
            $('#userCrudModal').html("<i class=\"fas fa-plus\"></i> Adicionar Usuário");
            $('#crud-modal').modal('show');
        });

        /* Editar Usuario */
        $('body').on('click', '#edit-user', function () {
            var user_id = $(this).data('id');
            $.get('home/'+user_id+'/edit', function (data) {
                $('#userCrudModal').html("<i class=\"fas fa-pencil-alt\"></i> Editar Usuário");
                $('#btn-update').val("Editar");
                $('#btn-save').prop('disabled',false);
                $('#crud-modal').modal('show');
                $('#user_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#address').val(data.address);
                $('#cpf').val(data.cpf);
                $('#phone').val(data.phone);
                $('#birthday').val(data.birthday);
            })
        });
        /* Ver Usuário */
        $('body').on('click', '#show-user', function () {
            var user_id = $(this).data('id');
            $.get('home/'+user_id+'/edit', function (data) {
                $('#userCrudModal-show').html("Detalhes do Usuário");
                $('#crud-modal-show').modal('show');
                $('#user_id-show').val(data.id);
                $('#name-show').val(data.name);
                $('#email-show').val(data.email);
                $('#address-show').val(data.address);
                $('#cpf-show').val(data.cpf);
                $('#phone-show').val(data.phone);
                $('#birthday-show').val(data.birthday);
            })
        });


        /* Deletar Usuario */
        $('body').on('click', '#delete-user', function () {
            var user_id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            if (confirm("Tem certeza que deseja deletar?")) {
                $.ajax({
                    type: "DELETE",
                    url: "home/"+user_id,
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
            }
        });

        /* Mascaras */
        $("#phone").mask("(99) 9999-99999");
        $("#cpf").mask("999.999.999-99");


    });


</script>
</html>
