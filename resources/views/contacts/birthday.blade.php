@extends('templates.template')

@section('content')
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item active">
                <div class="row">
                    <div class="col-md-4 col-12">Nome</div>
                    <div class="col-4">Email</div>
                    <div class="col-4">Data de Nascimento</div>
                </div>
            </li>
            @foreach($contacts as $contact)
            
            <li class="list-group-item">
                <div class="row">
                    <div class="col-4">{{$contact->first_name}} {{$contact->last_name}}</div>
                    <div class="col-4">{{$contact->email}}</div>
                    <div class="col-4">{{$contact->birthday}}</div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
@endsection