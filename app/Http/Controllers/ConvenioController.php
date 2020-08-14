<?php
namespace App\Http\Controllers;

use App\Http\Services\ServicoDeConvenio;

class ConvenioController extends Controller
{
    protected $servicoDeConvenio;

    function __construct()
    {
        $this->servicoDeConvenio = new ServicoDeConvenio();
    }

    public function obterLista()
    {
        return response()->json($this->servicoDeConvenio->ObterLista());
    }
}
