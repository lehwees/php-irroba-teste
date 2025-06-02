@extends('layouts.app')

@section('content')
<div class="alert alert-success">
    Cadastro realizado com sucesso!
</div>
<a href="{{ route('home') }}" 
   style="display:inline-block; background:#005f73; color:#fff; padding:10px 20px; border-radius:5px; text-decoration:none; margin-top: 20px;">
   Voltar para a Home
</a>
@endsection