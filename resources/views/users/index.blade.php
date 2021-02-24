@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="text-align: center">
                <div class="mt-4">
                    <h2>Usuários</h2>
                </div>
                <br/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a href="javascript:void(0)" class="btn btn-success mb-2" id="new-user" data-toggle="modal">
                        <i class="fas fa-plus"></i>
                        Adicionar Usuário
                    </a>
                </div>
            </div>
        </div>
        <br/>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p id="msg">{{ $message }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="user-table">
                        <tr>
                            <th># ID</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th width="280px">Ações</th>
                        </tr>

                        @foreach ($users as $user)
                            <tr id="user_id_{{ $user->id }}">
                                <td>{{ $user->id }}</td>
                                <td><img src="{{ $user->avatar ? 'data:image/png;base64,' . $user->avatar : '/uploads/avatars/default.png' }}" alt="perfil" class="profile-small" style="margin-right: 0px;"></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td style="min-width: 250px">
                                    <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                        <a class="btn btn-info" id="show-user" data-toggle="modal" data-id="{{ $user->id }}" >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-success" id="edit-user" data-toggle="modal" data-id="{{ $user->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        <a id="delete-user" data-id="{{ $user->id }}" class="btn btn-danger delete-user">
                                            <i class="fas fa-trash-alt"></i>
                                        </a></td>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        <!-- Add and Edit user modal -->
        <div class="modal fade" id="crud-modal" aria-hidden="true" >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal"></h4>
                    </div>
                    <div class="modal-body">
                        <form name="custForm" action="{{ route('user.store') }}" method="POST" autocomplete="off">
                            <input type="hidden" name="user_id" id="user_id" >
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Nome: <span class="required-filed">*</span></strong>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" onchange="validate()" onkeypress="validate()">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Email: <span class="required-filed">*</span></strong>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()" onkeypress="validate()">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Endereço: <span class="required-filed">*</span></strong>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Address" onchange="validate()" onkeypress="validate()">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>CPF:</strong>
                                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Telefone:</strong>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefone">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Data de Nasc.:</strong>
                                        <input type="date" name="birthday" id="birthday" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Senha: <span class="required-filed">*</span></strong>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Senha" onchange="validate()" onkeypress="validate()">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>Enviar</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Show user modal -->
        <div class="modal fade" id="crud-modal-show" aria-hidden="true" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="userCrudModal-show"></h4>
                    </div>
                    <div class="modal-body">
                        <form name="custForm-form" action="#" autocomplete="off">
                            <input type="hidden" name="user_id" id="user_id-show" >
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Nome:</strong>
                                        <input type="text" name="name" id="name-show" disabled class="form-control" placeholder="Name" onchange="validate()" >
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        <input type="email" name="email" id="email-show" disabled class="form-control" placeholder="Email" onchange="validate()">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Endereço:</strong>
                                        <input type="text" name="address" id="address-show" disabled class="form-control" placeholder="Address" onchange="validate()" onkeypress="validate()">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>CPF:</strong>
                                        <input type="text" name="cpf" id="cpf-show" disabled class="form-control" placeholder="CPF">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Telefone:</strong>
                                        <input type="text" name="phone" id="phone-show" disabled class="form-control" placeholder="Telefone">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <strong>Data de Nasc.:</strong>
                                        <input type="date" name="birthday" id="birthday-show" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <a href="{{ route('user.index') }}" class="btn btn-danger">Voltar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        error=false

        function validate()
        {
            if(document.custForm.name.value !='' && document.custForm.email.value !='' && document.custForm.address.value !='')
                document.custForm.btnsave.disabled=false
            else
                document.custForm.btnsave.disabled=true
        }
    </script>
@endsection
