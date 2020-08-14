<?php
namespace App\Http\Services;

use App\Http\ViewModels\InstituicaoTaxaViewModel;

class ServicoDeInstituicaoTaxa extends ServicoDeArquivoPadrao
{
    function __construct()
    {
        $this->nomeArquivo = 'taxas_instituicoes.json';
    }

    public function ObterLista()
    {
        return $this->lerArquivoJSON(InstituicaoTaxaViewModel::class);
    }
}