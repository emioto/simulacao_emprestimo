<?php
namespace App\Http\Services;

use App\Http\ViewModels\InstituicaoViewModel;

class ServicoDeInstituicao extends ServicoDeArquivoPadrao
{
    function __construct()
    {
        $this->nomeArquivo = 'instituicoes.json';
    }

    public function ObterLista()
    {
        return $this->lerArquivoJSON(InstituicaoViewModel::class);
    }
}
