@extends('templates.template')

@section('content')
<div class="col-sm-12">

    @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div>
    @endif
</div>
<div class="container add-contact">
    <div class="row">
        <div class="col-6">
            <form action="/contacts/search" method="GET">
                <input type="text" class="input-search" name="contact" required placeholder="DDD ----------"/>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="col-6">
            <a href="{{route('contacts.create')}}" class="btn btn-success"><i class="fas fa-plus"></i>Adicionar Contato</a>
        </div>
    </div>
</div>
<div class="container">
    <ul class="list-group">
        @foreach($contacts as $contact)
        
        <li class="list-group-item">
            <div class="row">
                <div class="col-4">{{$contact->first_name}} {{$contact->last_name}}</div>
                <div class="col-3">{{$contact->email}}</div>
                <div class="col-2">
                    @foreach($contact->phones as $phone)
                        <p> ({{$phone->ddd}}) {{$phone->number}}</p>
                    @endforeach
                </div>
                <div class="col-2">
                    <button class="btn" data-toggle="modal" data-target="#modalView<?php echo $contact->id?>" data-whatever="$contact"><i class="fas fa-eye"></i></button>
                    <a href="{{ route('contacts.edit', $contact->id)}}" class="btn"><i class="fas fa-pen"></i></a>
                    <button class="btn" data-toggle="modal" data-target="#modalDelete<?php echo $contact->id?>" data-whatever="$contact"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </li>
        <!-- Modal -->
        <div class="modal fade" id="modalView<?php echo $contact->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$contact->first_name}} {{$contact->last_name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6><strong>Detalhes do contato:</strong></h2>
                    <hr/>
                    <div class="container detail-modal">
                        <div class="row">
                            <label for="email"><strong>Email:</strong> </label><p> {{$contact->email}}</p>
                        </div>
                        <div class="row">
                            <label for="address"><strong>Endereço:</strong> </label><p> {{$contact->address}}</p>
                        </div>
                        <div class="row">
                            <label for="birthday"><strong>Data de Nascimento:</strong> </label><p> {{$contact->birthday}}</p>
                        </div>
                        <div class="row">
                            <label for="phones"><strong>Telefones: <br/></strong></label>
                            @foreach($contact->phones as $phone)
                                <div class="col-12">
                                    <p> ({{$phone->ddd}}) {{$phone->number}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal DELETE-->
        <div class="modal fade" id="modalDelete<?php echo $contact->id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$contact->first_name}} {{$contact->last_name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6><strong>Deseja mesmo Deletar ?</strong></h2>
                    <hr/>
                    <div class="container detail-modal">
                        <div class="row">
                            <label for="email"><strong>Email:</strong> </label><p> {{$contact->email}}</p>
                        </div>
                        <div class="row">
                            <label for="address"><strong>Endereço:</strong> </label><p> {{$contact->address}}</p>
                        </div>
                        <div class="row">
                            <label for="birthday"><strong>Data de Nascimento:</strong> </label><p> {{$contact->birthday}}</p>
                        </div>
                        <div class="row">
                            <label for="phones"><strong>Telefones: <br/></strong></label>
                            @foreach($contact->phones as $phone)
                                <div class="col-12">
                                    <p> ({{$phone->ddd}}) {{$phone->number}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <form action="{{ route('contacts.destroy', $contact->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Sim, quero deletar</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach
    </ul>
</div>




@endsection