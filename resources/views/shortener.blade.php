<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encurtador de Links</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
        <div class="mb-4 text-end">
            <a href="{{ route('links.listagem') }}" class="btn btn-outline-secondary">Ver todos os links</a>
        </div>
    <h1 class="mb-4">Encurtador de Links</h1>
    <form method="POST" action="{{ route('encurtar') }}" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="original_url" class="form-label">URL para encurtar</label>
            <input type="url" class="form-control" id="original_url" name="original_url" required placeholder="https://exemplo.com">
        </div>
        <div class="mb-3">
            <label for="custom_slug" class="form-label">Slug personalizado -  (opcional)</label>
            <input type="text" class="form-control" id="custom_slug" name="custom_slug" placeholder="ex: links.lunetear.com.br/slugpersonalizado">
        </div>
        <button type="submit" class="btn btn-primary">Encurtar</button>
    </form>


    @php
        $shortUrl = session('shortUrl', isset($shortUrl) ? $shortUrl : null);
    @endphp
    @if($shortUrl)
        <div class="alert alert-success">
            <strong>Seu link encurtado:</strong>
            <a href="{{ url($shortUrl->short_code) }}" target="_blank">{{ url($shortUrl->short_code) }}</a>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif


</div>
</body>
</html>
<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
</div>
