<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <title>Document</title>
</head>
<body>
    <main class="container">
        <div class="my-4">
            <h2>Listar todos os usuários</h2>
        </div>
        
        @foreach ($users as $user)
            <div class="border p-3 mb-3">
                <h3>Nome: {{$user['name']}}</h3>
                <p>CPF: {{$user['cpf']}}</p>
                <p>Email: {{$user['email']}}</p>
                <p>Data de Nascimento: {{$user['birthdate']}}</p>
                <p>Telefone: {{$user['phone']}}</p>
                <p>Endereço: {{$user['address']}}</p>
                <p>Cidade: {{$user['city']}}</p>
                <p>Estado: {{$user['state']}}</p>

                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}">
                    Editar
                </button>

                <!-- Edit modal -->
                <div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="editUserModalLabel{{$user->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel{{$user->id}}">Editar Usuário</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/editUser/{{$user->id}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name{{$user->id}}" class="form-label">Nome:</label>
                                        <input type="text" class="form-control" id="name{{$user->id}}" name="name" value="{{$user->name}}" required>
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="cpf{{$user->id}}" class="form-label">CPF:</label>
                                        <input type="text" class="form-control" id="cpf{{$user->id}}" name="cpf" value="{{$user->cpf}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="birthdate{{$user->id}}" class="form-label">Data de Nascimento:</label>
                                        <input type="date" class="form-control" id="birthdate{{$user->id}}" name="birthdate" value="{{$user->birthdate}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email{{$user->id}}" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email{{$user->id}}" name="email" value="{{$user->email}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone{{$user->id}}" class="form-label">Telefone:</label>
                                        <input type="text" class="form-control" id="phone{{$user->id}}" name="phone" value="{{$user->phone}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address{{$user->id}}" class="form-label">Endereço:</label>
                                        <input type="text" class="form-control" id="address{{$user->id}}" name="address" value="{{$user->address}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="state{{$user->id}}">Estado:</label>
                                        <select class="form-control" id="state{{$user->id}}" name="state" required>
                                            <option value="">Selecione o estado</option>
                                        </select>
                                    </div>
                    
                                    <div class="form-group">
                                        <label for="city{{$user->id}}">Cidade:</label>
                                        <select class="form-control" id="city{{$user->id}}" name="city" required>
                                            <option value="">Selecione a cidade</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="/delete-user/{{$user->id}}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </div>  
        @endforeach
    </main>

    <script>
        $(document).ready(function() {
            
            @foreach ($users as $user)
                $.get('/estados', function(data) {
                    $('#state{{$user->id}}').append(data.map(function(state) {
                        return `<option value="${state.id}">${state.nome}</option>`;
                    }));
                });

                $('#state{{$user->id}}').on('change', function() {
                    var stateId = $(this).val();
                    if (stateId) {
                        $.get(`/estados/${stateId}/cidades`, function(data) {
                            $('#city{{$user->id}}').empty().append('<option value="">Selecione a cidade</option>');
                            $('#city{{$user->id}}').append(data.map(function(city) {
                                return `<option value="${city.nome}">${city.nome}</option>`;
                            }));
                        });
                    } else {
                        $('#city{{$user->id}}').empty().append('<option value="">Selecione a cidade</option>');
                    }
                });
            @endforeach
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
