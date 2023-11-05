@extends('templates.layout')

@section('content')

<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-8  m-auto">

            <div style="text-align: center;">
                <h1 v-html="name">
                    
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
                              <input type="text" class="form-control" placeholder="Nome"  name="name" v-model.trim="formData.name" >
                            </div>
                            <div class="col-12 col-sm-6">
                              <label for="name">Email</label>
                              <input type="email" class="form-control" placeholder="Email"  name="email" v-model.trim="formData.email" >
                            </div>
                          </div>

                          <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="password">Senha</label>
                              <input type="text" class="form-control" placeholder="password" id="password" name="password" v-model.trim="formData.password"  >
                            </div>
                            <div class="col-12 col-sm-5">
                              <label for="repeat_password">Repita a Senha</label>
                              <input type="text" class="form-control"placeholder="Repita a senha" name="repeat_password" id="repeat_password" v-model.trim="formData.repeat_password"> 
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
                              <button v-on:click.prevent="submitData" :disabled="!isFormValid" class="btn btn-info">Enviar</button>
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
              <h1 v-html="nameTable"></h1>
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
                        <td v-on:click="profileRedirect({{$user['id']}})" style="background:var(--color--purple); color:white; cursor: pointer;" id="{{$user['id']}}">Perfil</td>
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
    const user = {
        data(){
            return{
                name:"Criação e listagem de Usuario",
                nameTable:"Tabela de Categorias",
                formData:{
                  name:'',
                  email:'',
                  password:'',
                  repeat_password:'',
                  professional_position:'',
                  image:'',
                }
            }

        },
         computed: {
            isNameValid() {
                return this.formData.name.trim() !== '' && this.formData.name.length <= 200;
            },
            isEmailValid() {
                return this.formData.email.trim() !== '' && this.formData.email.length <= 200;
            },
            isPasswordValid() {
                return this.formData.password.trim() !== '' && this.formData.password.length >= 6;
            },
            isPasswordConfirmation() {
                return this.formData.password === this.formData.repeat_password;
            },
            isFormValid() {
                return(
                  this.isNameValid &&
                  this.isEmailValid &&
                  this.isPasswordValid &&
                  this.isPasswordConfirmation
                );
            }
        }, 

       methods:{

            submitData() {
                    if (this.isFormValid) {
                        // Enviar dados
                        console.log('Formulário válido. Enviando dados:', this.formData);                        document.getElementById('modal-loading').classList.remove('to-hide')

                        this.fetchData(this.formData)

                    } else {
                      alert("Ocorreu algum erro, tente novamente")
                      document.getElementById('modal-loading').classList.add('to-hide')
                    }

                  
            },

            profileRedirect(id){
              alert(`${id}`)             
               window.location.href = `/page/${id}`;
            }, 

            fetchData(data){
                document.getElementById('modal-loading').classList.remove('to-hide')

                const form = document.getElementById('form-create-user')
                const formData = new FormData(form)

                axios.post('/create-user', formData,{
                headers: {
                  'Content-Type': 'multipart/form-data',
                  }
                })    
                .then(function (res) {
                      alert(`${res.data.msg}`)
                      document.getElementById('modal-loading').classList.add('to-hide')
                })
                .catch(function (error) {
                      console.log(error);
                      alert('Erro! tente novamente')
                      document.getElementById('modal-loading').classList.add('to-hide')
                });  
            }
        }
    }

    Vue.createApp(user).mount("#app")
            
</script>     
@endpush