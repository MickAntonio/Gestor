@extends('Administrador.main')

@section('title', 'GEscolar - Administrador')

@section('head')
    
    {!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
    
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">Hoje</span>
                        <h5>Vagas</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">
                        <?php $c = 0;
                            foreach($vagas as $v)
                            { 
                                $c += $v->Quantidade;
                            }
                            
                            print $c; 
                        ?>
                        </h1>
                        <div class="stat-percent font-bold text-success">00% <i class="fa fa-bolt"></i></div>
                        <small>Total de vagas</small>
                    </div>
                    <div class="ibox-content">
                            <h1 class="no-margins">
                            {{ count($alunosemturma)}}
                            </h1>
                            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                            <small>Candidatos inscritos e sem turma</small>
                        </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-primary pull-right">Hoje</span>
                        <h5>Turmas preenchidas </h5>
                    </div>
                    <div class="ibox-content">
                                <h1 class="no-margins"> {{ count($semvaga) }}</h1>
<<<<<<< HEAD
                                <div class="stat-percent font-bold text-navy">20% <i class="fa fa-level-up"></i></div>
=======
                                <div class="stat-percent font-bold text-danger">00% <i class="fa fa-level-up"></i></div>
>>>>>>> e520ca46ae5246bdba40243a7500fb5a78e00b3b
                                <small>Total de Turmas</small>
                    </div>
                </div>
            </div>      
            <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-success pull-right">Hoje</span>
                            <h5>Alunos por curso</h5>
                        </div>
                        @for($c=0;$c<count($cursoquantidade); $c++)                       
                        <div  class=" ibox-content">
                                    <h1 class="no-margins">{{$cursoquantidade[$c]["quantidade"] }} </h1>
                                    <div class="stat-percent font-bold text-success">20% <i class="fa fa-level-up"></i></div>
                                    <small>{{ $cursoquantidade[$c]["curso"] }}</small>
                                    
                        </div>
                        @endfor      
                    </div>                    
            </div>
            <div class="col-md-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <span class="label label-primary pull-right">Hoje</span>
                            <h5>Total de Alunos</h5>
                        </div>
                        @php $quant = 0;
                         for($c=0;$c<count($cursoquantidade); $c++)
                            $quant += $cursoquantidade[$c]["quantidade"];
                        @endphp

                        <div  class=" ibox-content">
                                    <h1 class="no-margins">{{ $quant}} </h1>
                                    <div class="stat-percent font-bold text-navy">100% <i class="fa fa-level-up"></i></div>
                                    <small>...</small>
                                    
                        </div>
                         
                    </div>                    
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <!-- Flot -->
    {!! Html::script('js/plugins/flot/jquery.flot.js') !!}
    {!! Html::script('js/plugins/flot/jquery.flot.tooltip.min.js') !!}   
    {!! Html::script('js/plugins/flot/jquery.flot.resize.js') !!}   

    <!-- ChartJS-->
    {!! Html::script('js/plugins/chartJs/Chart.min.js') !!}   
        
    <!-- Peity -->
    {!! Html::script('js/plugins/peity/jquery.peity.min.js') !!}   
        
    <!-- Peity demo -->
    {!! Html::script('js/demo/peity-demo.js') !!}   
        

    <script>
        $(document).ready(function() {


            var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
            var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

            var data1 = [
                { label: "Data 1", data: d1, color: '#17a084'},
                { label: "Data 2", data: d2, color: '#127e68' }
            ];
            $.plot($("#flot-chart1"), data1, {
                xaxis: {
                    tickDecimals: 0
                },
                series: {
                    lines: {
                        show: true,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }]
                        },
                    },
                    points: {
                        width: 0.1,
                        show: false
                    },
                },
                grid: {
                    show: false,
                    borderWidth: 0
                },
                legend: {
                    show: false,
                }
            });

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: [48, 48, 60, 39, 56, 37, 30]
                    },
                    {
                        label: "Example dataset",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data: [65, 59, 40, 51, 36, 25, 40]
                    }
                ]
            };

            var lineOptions = {
                responsive: true
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

        });
    </script>


@endsection