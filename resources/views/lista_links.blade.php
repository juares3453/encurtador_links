@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Links Encurtados</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(isset($shortUrls) && $shortUrls->count())
        <div class="card mt-4">
            <div class="card-header">Links Encurtados</div>
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>URL Original</th>
                            <th>Encurtado</th>
                            <th>Acessos</th>
                            <th>Criado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($shortUrls as $url)
                        <tr>
                            <td>{{ $url->id }}</td>
                            <td><a href="{{ $url->original_url }}" target="_blank">{{ $url->original_url }}</a></td>
                            <td><a href="{{ url($url->short_code) }}" target="_blank">{{ url($url->short_code) }}</a></td>
                            <td>{{ $url->access_count }}</td>
                            <td>{{ $url->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('short-url.destroy', $url->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este link?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-4">Nenhum link encurtado encontrado.</div>
    @endif
    <a href="{{ route('home') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection
