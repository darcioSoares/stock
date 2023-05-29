@extends('templates.layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-8  m-auto">

            <div style="text-align: center;">
                <h1>
                    Criação e listagem de usuario
                </h1>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" >
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"     style="background: var(--color--purple); color:white;">
                      Accordion Item #1
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
                              <input type="text" class="form-control" placeholder="password" name="password" >
                            </div>
                            <div class="col-12 col-sm-6">
                              <label for="repeat_password">Repita a Senha</label>
                              <input type="text" class="form-control"placeholder="Repita a senha" name="repeat_password" >
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
            <table class="table table-striped">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>


    {{-- container-fluid --}}
</div>
    

@endsection
@push('script')
<script>
  const form = document.getElementById('form-create-user')
  
  form.addEventListener('submit', async function(e){
      e.preventDefault();
      const formData = new FormData(this);

        axios.post('/create-user', formData,{
          headers: {
            'Content-Type': 'multipart/form-data',
          }
        })
        .then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
       
  })
  
</script>
@endpush