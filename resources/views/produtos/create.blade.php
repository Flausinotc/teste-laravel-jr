<!-- resources/views/produtos/create.blade.php -->
<form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="nome" placeholder="Nome do Produto" value="{{ old('nome') }}" required>
    <textarea name="descricao" placeholder="Descrição" required>{{ old('descricao') }}</textarea>
    <input type="number" name="preco" placeholder="Preço" step="0.01" value="{{ old('preco') }}" required>
    <input type="number" name="quantidade" placeholder="Quantidade" value="{{ old('quantidade') }}" required>

    <!-- Campo de Categoria, pode ser uma lista ou um campo texto -->
    <input type="text" name="categoria" placeholder="Categoria" value="{{ old('categoria') }}" required>

    <!-- Campo de Imagem (opcional) -->
    <input type="file" name="imagem">

    <button type="submit">Cadastrar</button>
</form>
