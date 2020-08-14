<?php
namespace App\Http\Services;

use App\Http\ViewModels\SimulacaoDeCreditoDisponivelViewModel;

class ServicoDeSimulacaoDeCreditoDisponivel
{
    private $servicoDeInstituicaoTaxa;

    function __construct()
    {
        $this->servicoDeInstituicaoTaxa = new ServicoDeInstituicaoTaxa();
    }

    public function SimularCreditoDisponivel($request)
    {
        $instituicaoTaxas = $this->servicoDeInstituicaoTaxa->ObterLista();
        $resultadoSimulacao = array();

        if(isset($request['instituicoes']))
        {
            foreach($request['instituicoes'] as $instituicao)
            {
                $instituicaoConvenios = array();

                if(in_array($instituicao, array_column($instituicaoTaxas, 'instituicao')))
                {
                    if(isset($request['convenios']))
                    {
                        foreach($request['convenios'] as $convenio)
                        {
                            if(in_array($convenio, array_column($instituicaoTaxas, 'convenio')))
                            {
                                foreach($instituicaoTaxas as $instituicaoTaxa)
                                {
                                    $instituicaoConvenio = new SimulacaoDeCreditoDisponivelViewModel();

                                    if($instituicaoTaxa->instituicao == $instituicao
                                       && $instituicaoTaxa->convenio == $convenio
                                       && !in_array($instituicaoTaxa->parcelas, array_column($instituicaoConvenios, 'parcelas')))
                                       {
                                            $instituicaoConvenio->taxa = $instituicaoTaxa->taxaJuros;
                                            $instituicaoConvenio->parcelas = $instituicaoTaxa->parcelas;
                                            $instituicaoConvenio->valor_parcela = round(floatval($request['valor_emprestimo']) * $instituicaoTaxa->coeficiente, 2);
                                            $instituicaoConvenio->convenio = $instituicaoTaxa->convenio;

                                            array_push($instituicaoConvenios, $instituicaoConvenio);
                                       }
                                }
                            }
                        }
                    }
                    if(!in_array($instituicao, array_column($resultadoSimulacao, null, 0)))
                    {
                        $instituicaoData = new \stdClass();
                        $instituicaoData->{$instituicao} = $instituicaoConvenios;
                        array_push($resultadoSimulacao, $instituicaoData);
                    }
                }          
            }       
        }

        return $resultadoSimulacao;
    }
}