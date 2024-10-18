<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Cadastro de Usuários</h1>
        <div class="mt-8">
            <form method="POST" action="/register">
                @csrf

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" required>
                </div>

                <div class="form-group">
                    <label for="birthdate">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefone:</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="address">Endereço:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="form-group">
                    <label for="state">Estado:</label>
                    <select class="form-control" id="state" name="state" required>
                        <option value="">Selecione o estado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="city">Cidade:</label>
                    <select class="form-control" id="city" name="city" required>
                        <option value="">Selecione a cidade</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>    
    </div>

    <script>
        $(document).ready(function() {
            
            $.get('/estados', function(data) {
                $('#state').append(data.map(function(state) {
                    return `<option value="${state.id}">${state.nome}</option>`;
                }));
            });

            // Carregar cidades ao selecionar um estado
            $('#state').on('change', function() {
                var state = $(this).val();
                if (state) {
                    $.get(`/estados/${state}/cidades`, function(data) {
                        $('#city').empty().append('<option value="">Selecione a cidade</option>');
                        $('#city').append(data.map(function(city) {
                            return `<option value="${city.nome}">${city.nome}</option>`;
                        }));
                    });
                } else {
                    $('#city').empty().append('<option value="">Selecione a cidade</option>');
                }
            });
        });
    </script>
</body>
</html>
