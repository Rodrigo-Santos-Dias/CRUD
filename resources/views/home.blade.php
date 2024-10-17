<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
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
                <div class="modal fade" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editUserModalLabel">Editar Usuário</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/editUser/{{$user->id}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nome:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                                    </div>
                    
                                    <div class="mb-3">
                                        <label for="cpf" class="form-label">CPF:</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{$user->cpf}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="birthdate" class="form-label">Data de Nascimento:</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{$user->birthdate}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Telefone:</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Endereço:</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
