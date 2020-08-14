<?php
namespace App\Http\Controllers;

use App\Http\Services\ServicoDeInstituicao;

class InstituicaoController extends Controller
{
    protected $servicoDeInstituicao;

    function __construct()
    {
        $this->servicoDeInstituicao = new ServicoDeInstituicao();
    }

    public function obterLista()
    {
        return response()->json($this->servicoDeInstituicao->ObterLista());
    }
}
