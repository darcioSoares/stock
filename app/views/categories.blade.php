@extends('templates.layout')

@section('content')

<div class="container-fluid" id="app">
    <div class="row">
        <div class="col-8  m-auto">

            <div style="text-align: center;">
                <h1>
                 <span v-html="name"></span>
                </h1>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" >
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"     style="background: var(--color--purple); color:white;">
                      Categorias
                    </button>
                  </h2>
                 
                  <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                      <form id="form-create-categories" >
                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="name">Name:</label>
                              <input type="text" class="form-control" placeholder="Nome" v-model.trim="formData.name" >
                             <!--  <span v-if="!isNameValid">Name is required and must be less than 200 characters.</span> -->

                            </div>
                            <div class="col-12 col-sm-6">
                              <label for="name">Segment:</label>
                              <input type="text" class="form-control" placeholder="Segmento" v-model.trim="formData.segment">
                          <!--     <span v-if="!isSegmentValid">Segment is required and must be less than 200 characters.</span> -->
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
                    <th scope="col">Acao</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Segmento</th>                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                      <tr>
                        <td v-on:click="Redirect({{$category['id']}})" style="background:var(--color--purple); color:white; cursor: pointer;" id="{{$category['id']}}">
                          Consultar</td>                    
                        <td>{{$category['name']}}</td>
                        <td>{{$category['segment']}}</td>                     
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
    

@endsection
@push('script')

<script>
    const categories = {
        data(){
            return{
                name:"Criação e listagem de Categorias",
                nameTable:"Tabela de Categorias",
                formData:{
                  name:'',
                  segment:''
                }
            }

        },
         computed: {
            isNameValid() {
                return this.formData.name.trim() !== '' && this.formData.name.length <= 200;
            },
            isSegmentValid() {
                return this.formData.segment.trim() !== '' && this.formData.segment.length <= 200;
            },
            isFormValid() {
                return this.isNameValid && this.isSegmentValid;
            }
        }, 

       methods:{
     /*         isNameValid() {
                return this.formData.name.trim() !== '' && this.formData.name.length <= 200;
            },
            isSegmentValid() {
                return this.formData.segment.trim() !== '' && this.formData.segment.length <= 200;
            }, */

/*             isFormValid() {
                return this.isNameValid && this.isSegmentValid;
            }, */

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

            Redirect(id){
              alert(`${id}`)
              window.location.href = `/page/${id}`;
            },

            fetchData(data){
                document.getElementById('modal-loading').classList.remove('to-hide')

                axios.post('/create-category', data,{
                headers: {
                'Content-Type':'application/json',
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

    Vue.createApp(categories).mount("#app")
            
</script>       
  
@endpush