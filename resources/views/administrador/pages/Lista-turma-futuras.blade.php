@extends("Administrador.main")
@section("title"," Lista de Turmas futuras")

@section("head")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/chosen/bootstrap-chosen.css') !!}
@endsection

@section("content")

<div class="row">
    <div class="col-md-12">
                @include('components.messages')
    </div>
<div class="ibox float-e-margins col-md-10 col-md-offset-1">
                        <div class="ibox-title">
                            <h5>LISTA DAS TURMAS</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
<div class="ibox-content">
    <div class="row">
        <div class="col-sm-9 m-b-xs">
            <div data-toggle="" class="btn-group">
            <label class="btn btn-sm btn-white"> <a href="{{ route('ListOldClass') }}" class="">TURMAS ANTIGAS</a> </label>
            <label class="btn btn-sm btn-white"> <a href="{{ route('ListClass') }}" class="">TURMAS ACTUAIS</a> </label>
            </div>
                                </div>
                            </div>
                                 <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover data-table-grid">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Vaga (as) </th>
                                        <th>Periodo</th>
                                        <th>Classe </th>
                                        <th>Curso</th>
                                        <th>Ano Lectivo </th>
                                        <th>Acção</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php for ($i=0; $i <count($Turma) ; $i++) { 
                                       if($Turma[$i]->anolectivo > date("Y")) {?>
                                    <tr>
                                        <td>{{ $Turma[$i]->nome }}</td>
                                        <td>{{ $Turma[$i]->Quantidade }}</td>
                                        <td>{{ $Turma[$i]->periodo }}</td>
                                        <td>{{ $Turma[$i]->classe()->get()[0]->nome }}</td>
                                        <td>{{ $Turma[$i]->curso()->get()[0]->nome }}</td>
                                        <td>{{ $Turma[$i]->anolectivo }}</td>
                                        <td>
                                        <a href="{{route('AlunosDaTurma',$Turma[$i]->id)}}" class="btn btn-primary" ><i class="fa fa-list"></i></a>
                                            
                                            <a class="btn btn-success edit-class" data-vaga="{{ $Turma[$i]->Quantidade }}" data-id="{{ $Turma[$i]->id }}" ><i class="fa fa-pencil"></i>
                                    </a>
                                            <a data-id="{{ $Turma[$i]->id }}" data-nome="{{ $Turma[$i]->nome }}" class="btn btn-danger drop-curso" ><i class="fa fa-close"></i></a>
                                        </td>

                                    </tr>
                                    <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
        </div>
    </div>

     <div data-backdrop="static" class="modal inmodal" id="drop-curso" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Tens a certeza do que Queres Excluir?</h5>
                    <small class="font-bold">
                        Ao Excluíres a turma <strong class="drop-span">,</strong> todos os dados associados a 
                        ela serão excluídos (incluí matriculas/confirmações, e outros dados associados a
                        matricula/confirmação como  a propinas dos alunos dessa turma).
                    </small>
                </div>
                <div class="modal-body">

                    <div class="row">

                        {!! Form::open(['method'=>'DELETE']) !!}
                        <button type="submit" class="col-sm-12 btn btn-danger margem"> <strong>Sim tenho</strong></button>
                        {!! Form::close() !!}

                        <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Não tenho</strong></button>
                        
                    </div>

                </div>
            
            </div>
        </div>

    </div>
</div>



<!-- CHANGE CLASS DATA -->
<div data-backdrop="static" class="modal inmodal" id="edit-class" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content animated bounceInRight">

            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Vagas</h5>
                    <strong> <small>Você pode zerar ou aumentar a vaga...</small>
                                </strong>
                </div>
                <div class="modal-body">

                    <div class="row">

                        {!! Form::open(['method'=>'PUT']) !!}
                        <div class="col-md-12 margem">
                                <label for="Quantidade">
                                    <p>Quantidade de vaga</p>
                                </label>
                                <input  required min="0" max="70" type="number" id="Quantidade" name="quantidade" class="form-control" />
                                <input  required min="0" max="70" type="hidden" id="idturma" name="turma" class="form-control" />
                            </div>                   
                        <button type="submit" class="col-sm-12 btn btn-success margem"> <strong>Guardar</strong></button>
                        {!! Form::close() !!}

                        <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                        
                    </div>

                </div>
            
            </div>
        </div>

    </div>
@endsection

@section("scripts")

    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
  
  {!! Html::script('js/plugins/chosen/chosen.jquery.js') !!}

  <script>
  // Data table
      $(document).ready(function(){
          
          $('.data-table-grid').DataTable({
              pageLength: 5,
              responsive: true,
              dom: '<"html5buttons"B>lTfgitp',
              buttons: [
                  {extend: 'excel', title:  '@yield("title")'}
                 

                  
              ]

          });

      });

$(function()
{
    $(".drop-curso").click(function()
    {
        $("#drop-curso").modal("show");
        var url = "{{ url('/Administrador/criar-turma') }}/"+$(this).data('id');

        $(".drop-span").text($(this).data("nome"));
        $("#drop-curso form").attr("action", url);
    });

    $(".edit-class").click(function()
    {
        $("#edit-class").modal("show");

         $("#Quantidade").val($(this).data("vaga"));
         $("#idturma").val($(this).data("id"));
        var url = "{{ url('/Administrador/Alterar-a-vaga-da-turma') }}";
        $("#edit-class form").attr("action", url);
    });
})

</script>

@endsection