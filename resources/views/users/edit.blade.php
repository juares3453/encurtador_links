<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <h2>Editar Usuário</h2>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required>
            </div>
            <div>
                <label for="password">Nova Senha:</label>
                <input type="password" name="password" id="password">
                <small>Deixe em branco para manter a senha atual.</small>
            </div>
            <button type="submit">Salvar</button>
        </form>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>
