<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\secretaria\Matriculas;
use App\Models\Administrador\Meses;
use App\Models\Administrador\Alunos;
use App\Models\Pagamentos\PrecoClasses;
use App\Models\Pagamentos\PagamentoPropinas;
use App\Models\Pagamentos\Propinas;
use Session;

class AlunosPropinasPagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretaria.pagamentos-alunos-propinas.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function alunos()
    {
        return view('secretaria.lista-de-alunos.index')
        ->withMatriculas(Matriculas::all())
        ->withMeses(Meses::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    //    dd($request->preco_propina_id);

        $this->validate($request, array(
            'total'=>'required',
            'valor_pago'=>'required',
            'forma'=>'required',
            'matricula_id'=>'required',
        ));


        $pagamento = new PagamentoPropinas();
        $pagamento->total = $request->total;
        $pagamento->valor_pago = $request->valor_pago;
        $pagamento->forma = $request->forma;
        $pagamento->descricao = $request->descricao;
        $pagamento->matricula_id = $request->matricula_id;
        $pagamento->user_id = $request->user_id;                
        $pagamento->save();

        for ($i=0; $i < collect($request->mes)->count(); $i++) { 

            $propina = new Propinas();
            $propina->mes_id = $request->mes[$i];
            $propina->multa = $request->multa[$i];
            $propina->pagamento_propina_id = $pagamento->id;
            $propina->preco_classe_id = $request->preco_propina_id;
            $propina->save();

        }

        Session::flash('successo', 'Pagamento da Propina Efectuado com Successo');

        return redirect('secretaria/lista-de-alunos');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = Alunos::find(Matriculas::find($id)->aluno->id);

        return view('secretaria.lista-de-alunos.show')->withAluno($aluno)
            ->withPagamentos(PagamentoPropinas::where("matricula_id", $id)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function jsonListaDeMeses()
    {
        return json_encode( Meses::all() );
    }

    public function getPrecoPropina($curso, $classe)
    {
       
        $preco = PrecoClasses::where('curso_id', $curso)->where('classe_id', $classe)->where('estado', 'Activado')->get();
        
        if($preco->count()>0){
            return [$preco[0]->id,$preco[0]->preco];
        }else{
            return 0;            
        }

        
    }
}
