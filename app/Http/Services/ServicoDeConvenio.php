<?php
namespace App\Http\Services;

use App\Http\ViewModels\ConvenioViewModel;

class ServicoDeConvenio extends ServicoDeArquivoPadrao
{
    function __construct()
    {
        $this->nomeArquivo = 'convenios.json';
    }

    public function ObterLista()
    {
        return $this->lerArquivoJSON(ConvenioViewModel::class);
    }
}
