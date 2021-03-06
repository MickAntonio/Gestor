<!DOCTYPE html>
<html>

<head>
    @include('includes.head')
</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="" class="navbar-brand">GESB</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a aria-expanded="false" role="button" href=""> Financeiro</a>
                        </li>
                        
                        <li class="dropdown">
                            <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Configurações de Dados <span class="caret"></span></a>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="/financeiro/tipos-de-pagamentos">Tipos de Entradas/Saidas</a></li>
                                <li><a href="/financeiro/preco-das-propinas">Preços das Propinas</a></li>
                                <li><a href="/financeiro/precos">Preços Usados</a></li>
                            </ul>
                        </li>
                    
                 

                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Relatórios <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="/financeiro/relatorios/pagamentos-de-propinas">Pagamentos de Propinas</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#relatorioEntradaModal">Todas Entradas</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#relatorioSaidasModal">Todas Saidas</a></li>
                        </ul>
                    </li>
                  

                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                           
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Sair
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="wrapper wrapper-content">
            
            @yield('content')

        </div>
       <!-- <div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2014-2017
            </div>
        </div> -->
    </div>
   


    <!--Relatorio modal-->

     <div class="modal inmodal" id="relatorioEntradaModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
        {!! Form::open(array('route' => 'outras.entradas.pdf')) !!}   
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">Gerar Relatóriode Entradas</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
            
                    <div class="form-group" id="data_5">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control" name="start" value="2018-02-22"/>
                            <span class="input-group-addon">à</span>
                            <input type="text" class="form-control" name="end" value="2018-02-22" />
                        </div>
                    </div>
               
               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Visualizar</button>
                </div>
        {!! Form::close() !!} 
            </div>
        </div>
    </div>

     <div class="modal inmodal" id="relatorioSaidasModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
        {!! Form::open(array('route' => 'outras.saidas.pdf')) !!}   
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">Gerar Relatório de  Saidas</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
            
                    <div class="form-group" id="data_5">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control" name="start" value="2018-02-22"/>
                            <span class="input-group-addon">à</span>
                            <input type="text" class="form-control" name="end" value="2018-02-22" />
                        </div>
                    </div>
               
               
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Visualizar</button>
                </div>
        {!! Form::close() !!} 
            </div>
        </div>
    </div>

 @include('includes/scripts')

   
</body>


</html>
