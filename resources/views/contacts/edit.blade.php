@extends('templates.template')

@section('content')
<div class="row form-contact">
    <div class="col-sm-8 offset-sm-2">
       <h1 class="display-4">Adicionando contato</h1>
        <div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            <form method="post" action="{{ route('contacts.update', $contact->id) }}">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">    
                            <label for="first_name">Nome:</label>
                            <input type="text" class="form-control" name="first_name" value={{ $contact->first_name }} required/>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" name="last_name" value={{ $contact->last_name }} required/>
                        </div>        
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" value={{ $contact->email }} required/>
                </div>
                <div class="form-group">
                    <label for="address">Endereço:</label>
                    <input type="text" class="form-control" name="address" value={{ $contact->address }} required/>
                </div>
                <div class="form-group">
                    <label for="address">Data de Nascimento:</label>
                    <input type="date" class="form-control" name="birthday" value={{ $contact->birthday }} required/>
                </div>
                <div class="form-group">
                    <label for="phones">Telefones:</label>
                    @foreach($contact->phones as $key=>$phone)
                        <div class="row">
                            <div class="col-2 pr-0">
                                <input type="number" class="form-control phone-ddd" name="ddd[<?php echo $key?>]" value="<?php echo $phone->ddd?>" required/>
                            </div>
                            <div class="col-10 pl-1">
                                <input type="number" class="form-control phone-number w-50" name="number[<?php echo $key?>]" value="<?php echo $phone->number?>" required/>
                            </div>                      
                        </div>
                    @endforeach
                    
                    <div class="inputs-new row">

                    </div>
                    <div class="row">
                        <a class="btn btn-primary button-add" onclick="add_more_number()">Incluir número</a>

                    </div>
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
            </form>

            <script>
                function add_more_number(){
                    var lista = ''
                    var lista = document.getElementsByClassName('phone-ddd');
                    $('.inputs-new').append("<div class='col-2 pr-0'><input type='number' class='form-control phone-ddd' name='ddd["+ lista.length+"]'/></div>")
                    $('.inputs-new').append("<div class='col-10 pl-1'><input type='number' class='form-control phone-number w-50' name='number["+ (lista.length-1) +"]'/></div>")
                }
            </script>
        </div>
    </div>
</div>
@endsection
