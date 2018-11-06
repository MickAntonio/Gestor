<?php

namespace App\Http\Controllers\Secretaria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pagamentos\Pagamentos;
use App\Models\Pagamentos\TipoPagamentos;
use App\Models\Pagamentos\PagamentoPrecos;
use Session;

class SaidasPagamentosController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('secretaria.pagamentos-saidas.index')
        ->withSaidas(Pagamentos::all())
        ->withTipoPagamentos(TipoPagamentos::where("tipo", "Saida")->get())
        ;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'valor_pago'=>'required',
            'forma'=>'required',
            'tipo_pagamento_id'=>'required',
        ));

        $PagamentoPrecos = PagamentoPrecos::where("tipo_pagamento_id", $request->tipo_pagamento_id)->where("estado", "Activado")->get();        

        $pagamento = new Pagamentos();
        $pagamento->valor_pago = $request->valor_pago;
        $pagamento->forma = $request->forma;
        $pagamento->descricao = $request->descricao;
        $pagamento->pagamento_preco_id = $PagamentoPrecos[0]->id;
        $pagamento->user_id = $request->user_id;                
        $pagamento->save();

        Session::flash('successo', 'Saida Adicionada com Successo');

        return redirect()->route('saidas-pagamentos.index');
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
        $this->validate($request, array(
            'valor_pago'=>'required',
            'forma'=>'required',
            'tipo_pagamento_id'=>'required',
        ));

        $PagamentoPrecos = PagamentoPrecos::where("tipo_pagamento_id", $request->tipo_pagamento_id)->where("estado", "Activado")->get();

        $pagamento = Pagamentos::find($id);
        $pagamento->valor_pago = $request->valor_pago;
        $pagamento->forma = $request->forma;
        $pagamento->descricao = $request->descricao;
        $pagamento->pagamento_preco_id = $PagamentoPrecos[0]->id;
        $pagamento->user_id = $request->user_id;        
        $pagamento->save();

        Session::flash('successo', 'Saida Actualizado com Successo');

        return redirect()->route('saidas-pagamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pagamentos::find($id)->delete();

        Session::flash('successo', 'Saida Excluida com Successo');

        return redirect()->route('saidas-pagamentos.index');
    }
}
