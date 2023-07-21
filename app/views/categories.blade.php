@extends('templates.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8  m-auto">

            <div style="text-align: center;">
                <h1>
                    Criação e listagem de Categorias
                </h1>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" >
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"     style="background: var(--color--purple); color:white;">
                      Categorias
                    </button>
                  </h2>
                  {{-- add class show na div id="collapseOne" --}}
                  <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                      <form id="form-create-categories" >
                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                              <label for="name">Nome</label>
                              <input type="text" class="form-control" placeholder="Nome" id="name" name="name">
                            </div>
                            <div class="col-12 col-sm-6">
                              <label for="name">Segmento</label>
                              <input type="text" class="form-control" placeholder="Segmento" id="segment"  name="segment">
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
              <h1>Tabela de Categorias</h1>
            </div>
            <table class="table table-striped">

                <thead>
                  <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Açoes</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Segmento</th>                   
                  </tr>
                </thead>
                <tbody>
                  {{-- @foreach ($users as $user)
                      <tr>
                        <td class="d-none">{{$user['id']}}</td>
                        <td>{!!$user['button']!!}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['professional_position'] ?? 'não definido'}}</td>
                      </tr>
                  @endforeach --}}
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
  const form = document.getElementById('form-create-categories')
  
  form.addEventListener('submit',function(e){
      e.preventDefault();
      const formData = new FormData(this);

      let segment = document.getElementById('segment');
      let name = document.getElementById('name');

      if(segment.value == "" ){
         segment.classList.add('is-invalid')                   
      }else{
         segment.classList.remove('is-invalid')  
      }

      if(name.value == ""){
        name.classList.add('is-invalid') 
      }else{
        name.classList.remove('is-invalid') 
      }
    
     if(segment.classList.contains('is-invalid') || name.classList.contains('is-invalid')) return
        
       
    document.getElementById('modal-loading').classList.remove('to-hide')

        axios.post('/create-category', formData,{
          headers: {
            'Content-Type': 'application/json',
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
  
</script>
@endpush