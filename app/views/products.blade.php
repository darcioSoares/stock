@extends('templates.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8  m-auto">

            <div style="text-align: center;">
                <h1>
                    Criação e listagem de Produtos
                </h1>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" >
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"     style="background: var(--color--purple); color:white;">
                      Produtos
                    </button>
                  </h2>
                  {{-- add class show na div id="collapseOne" --}}
                  <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                      <form id="form-create-user" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="name">Nome</label>
                              <input type="text" class="form-control" placeholder="Nome"  name="name">
                            </div>
                            <div class="col-12 col-sm-6">
                              <label for="description">Descrição</label>
                              <input type="text" class="form-control" placeholder="Descriçao"  name="description">
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="code">Codigo</label>
                              <input type="text" class="form-control" placeholder="codigo" id="code" name="code" >
                            </div>
                            <div class="col-12 col-sm-5">
                              <label for="quantity">Quatidade</label>
                              <input type="text" class="form-control"placeholder="quantidade" name="quantity" id="quantity"> 
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="unitary_value">Valor Unitario</label>
                              <input type="text" class="form-control" placeholder="Valor Unitario" id="unitary_value" name="unitary_value" >
                            </div>
                            <div class="col-12 col-sm-5">
                              <label for="value">Valor</label>
                              <input type="text" class="form-control"placeholder="Valor" name="value" id="value"> 
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="category">Categoria</label>
                              <select name="category" class="form-select">
                                <option selected value="">Categorias - Segmento</option>
                                @foreach ($categories as $item)
                                <option value="{{$item['id']}}">{{$item['name']}} - {{$item['segment']}} </option>
                                @endforeach                              
                              </select>
                            </div>                            
                           </div>
                              <button class="btn btn-info">Enviar</button>
                      </form>
                    </div>

                  </div>
                </div>
                             
              </div>
        </div>
    </div>

    <div class="row mt-5">

        <div class="col-8 m-auto">
            <div class="text-center mb-3">
              <h1>Tabela de Produtos</h1>
            </div>
            <table class="table table-striped">

                <thead>
                  <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Açoes</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Posição</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($user as $element)
                      <tr>                   
                        <td onclick="profile(this)" style="background:var(--color--purple); color:white; cursor: pointer;" id="{{$user['id']}}">Perfil</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['professional_position'] ?? 'não definido'}}</td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>

    {{-- modal loading --}}
    <div id="modal-loading" class="modal-container-loading to-hide">
      <div class="c-loading"> </div>
    </div>

    {{-- container-fluid --}}
</div>
    
{{-- falta colocar limitadores de caracteres do proprio html 
add olho magico na senha e confirmação de senha --}}

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/jquery.inputmask.min.js
"></script>
<script>

    window.onload = function() {
                
       let value_product = document.getElementById('value')
       let im_value = new Inputmask( 'currency',{"autoUnmask": false,
         radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: ' R$ ',            
            digits: 2,
            digitsOptional: false,
            rightAlign: false,
            unmaskAsNumber: false                                
        });
        im_value.mask(value_product)

      let unitary_value = document.getElementById('unitary_value')
      let im_unitary_value = new Inputmask( 'currency',{"autoUnmask": false,
         radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: ' R$ ',            
            digits: 2,
            digitsOptional: false,
            rightAlign: false,
            unmaskAsNumber: false                                
        });
        im_unitary_value.mask(unitary_value)

        let quantity = document.getElementById('quantity')
        let im_quantity = new Inputmask({ regex: "[0-9]*"})
        im_quantity.mask(quantity)

    }//end function window.onload

  
  const form = document.getElementById('form-create-user')
  
  form.addEventListener('submit',function(e){
      e.preventDefault();
      const formData = new FormData(this);

      let repeatPassword = document.getElementById("repeat_password")
      let password = document.getElementById("password")
 

     if(repeatPassword.value != password.value)
     {
        repeatPassword.classList.add('is-invalid')
        password.classList.add('is-invalid')
     }else{
        repeatPassword.classList.remove('is-invalid')
        password.classList.remove('is-invalid')        
     }

     //verificando se as senhas estão iguais
     if(password.classList.contains('is-invalid')) return
        
       
    document.getElementById('modal-loading').classList.remove('to-hide')

        axios.post('/create-', formData,{
          headers: {
            'Content-Type': 'multipart/form-data',
          }
        })
        .then(function (response) {
          console.log(response);
          alert(`${response.data.msg}`)
          document.getElementById('modal-loading').classList.add('to-hide')
        })
        .catch(function (error) {
          console.log(error);
          alert('Erro! tente novamente')
          document.getElementById('modal-loading').classList.add('to-hide')
    });  

  })//end event form
  

  function profile(elem){

    alert("apertou")
    console.log(elem.id)

    window.location.href = `/page/${elem.id}`;
  }

</script>
@endpush