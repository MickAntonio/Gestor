@extends('general.main')

@section('title', 'GEstoque-Adminsitrador')

@section('page-heading')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Visualizar Cliente</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="/">Admin</a>
                </li>
                <li>
                    <a>Clientes</a>
                </li>
                <li class="active">
                    <strong>Visualizar</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

@endsection

@section('content')

                
<div class="row m-t-lg">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tab-10">
                    Dados do Cliente
                    <span class="label label-warning">Informações</span>
                </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-10" class="tab-pane active">
                    <div class="panel-body">

                        <table class="table table-bordered table-th-200">

                            <tr>
                                <th>Código</th>
                                <td>{{ $compra->codigo }}</td>
                            </tr>

                            <tr>
                                <th>preco</th>
                                <td>{{ $compra->preco }}</td>
                            </tr>

                            <tr>
                                <th>pagamento</th>
                                <td>{{ $compra->pagamento }}</td>
                            </tr>


                            <tr>
                                <th>forma_pagamento</th>
                                <td>{{ $compra->forma_pagamento }}</td>
                            </tr>

                            <tr>
                                <th>fornecedor</th>
                                <td>{{ $compra->fornecedor->nome }}</td>
                            </tr>

                            <tr>
                                <th>criado aos</th>
                                <td>{{ $compra->created_at }}</td>
                            </tr>

                            <tr>
                                <th>actualizado aos</th>
                                <td>{{ $compra->updated_at }}</td>
                            </tr>


                        </table>

                        <table class="table table-bordered table-th-200">

                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Preço Total</th>
                                </tr>
                            </thead>

                            <tbody id="tbody-produto">
                            
                            @foreach($compra->quantidades as $comp)
                               
                               <tr class="gradeX" id="tr-produto-main" tabindex="4">

                                   <td>
                                   <div class="input-group m-b col-md-12">
                                           <input type="text" max="0" min="0"  disabled name="noe" value="{{ $comp->produto->nome }}" placeholder="Qtde"  class="form-control">
                                       </div>
                                   </td>
                                 
                                   <td class="width-320 td-produto-1">

                                   @if($comp->produto->variacao=='Sim')

                                       <div class="input-group m-b col-md-12">
                                           <span class="input-group-addon width-150">

                                            @foreach($comp->estoque->produto_variacoes as $atributo)
                                                {{ $atributo->atributo->nome }}
                                            @endforeach
                                           
                                           </span> 
                                           <input type="number" max="0" min="0"  disabled name="quantidade" value="{{ $comp->quantidade }}" placeholder="Qtde"  class="form-control">
                                       </div>

                                       @else

                                       <div class="input-group m-b col-md-12">
                                          
                                           <input type="text" max="0" min="0"  disabled name="quantidade" value="{{ $comp->quantidade }}" placeholder="Qtde"  class="form-control">
                                       </div>

                                       @endif
                                       
                                   </td>

                                   <td class="width-150 td-produto-preco-1">

                                       <div class="input-group m-b col-md-12">
                                           <input type="text"  disabled name="preco_unitario[]" value="{{ $comp->preco_unitario }} kz"  class="form-control">
                                       </div>

                                   </td>

                                   <td class="width-150">
                                       <input type="text"  value="{!! ($comp->quantidade * $comp->preco_unitario) !!} kz" name="preco"  disabled  class="form-control">
                                   </td>
                                  
                                 
                               </tr>

                            @endforeach
                               
                               
                           </tbody>

                         

                        </table>

                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal inmodal" id="excluirModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated bounceInRight">

        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Tens Certeza Que Pretendes Excluir</h4>
                <small class="font-bold">Ao Excluires este Cliente todos os dados deste cliente serão excluidos.</small>
            </div>
            <div class="modal-body">

                <div class="row">

                    {!! Form::open(['route'=> ['compras.destroy', $compra->id], 'method'=>'DELETE']) !!}
                    <button type="submit" class="col-sm-12 btn btn-primary"> <strong>Sim Tenho</strong></button>
                    {!! Form::close() !!}

                    <button type="button" class="col-sm-12 btn btn-white mg-top-20" data-dismiss="modal"><strong>Cancelar</strong></button>
                    
                </div>

            </div>
           
        </div>
    </div>

</div>

        
@endsection
