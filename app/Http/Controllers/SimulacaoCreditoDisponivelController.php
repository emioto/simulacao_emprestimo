<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ServicoDeSimulacaoDeCreditoDisponivel;

class SimulacaoCreditoDisponivelController extends Controller
{
    protected $servicoDeSimulacaoDeCreditoDisponivel;

    function __construct()
    {
        $this->servicoDeSimulacaoDeCreditoDisponivel = new ServicoDeSimulacaoDeCreditoDisponivel();
    }

    public function simularCreditoDisponivel(Request $request)
    {
        return response()->json($this->servicoDeSimulacaoDeCreditoDisponivel->SimularCreditoDisponivel($request));
    }
}
