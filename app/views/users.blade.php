@extends('templates.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8  m-auto">

            <div style="text-align: center;">
                <h1>
                    Criação e listagem de Usuario
                </h1>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" >
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"     style="background: var(--color--purple); color:white;">
                      Usuarios
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
                              <label for="name">Email</label>
                              <input type="email" class="form-control" placeholder="Email"  name="email">
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="password">Senha</label>
                              <input type="text" class="form-control" placeholder="password" id="password" name="password" >
                            </div>
                            <div class="col-12 col-sm-5">
                              <label for="repeat_password">Repita a Senha</label>
                              <input type="text" class="form-control"placeholder="Repita a senha" name="repeat_password" id="repeat_password"> 
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="professional_position">Cargo</label>
                              <select name="professional_position" class="form-select">
                                <option selected value="Gerente">Gerente</option>
                                <option value="Cordenador">Cordenador</option>
                                <option value="Assistente">Assistente</option>
                              </select>
                            </div>
                            <div class="col-12 col-sm-6">
                              <label for="image">Imagen</label>
                              <input type="file" class="form-control" placeholder="image" id="image" name="image" >
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
              <h1>Tabela de Usuários</h1>
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
                  @foreach ($users as $user)
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
<script>
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

        axios.post('/create-user', formData,{
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