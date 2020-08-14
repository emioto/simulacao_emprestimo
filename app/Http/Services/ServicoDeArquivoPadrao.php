<?php
namespace App\Http\Services;

use Storage;

class ServicoDeArquivoPadrao
{
    protected $diretorioPadrao = '/arquivos'; 
    protected $nomeArquivo;

    public function lerArquivoJSON($viewModel)
    {
		$dadosArquivo = array();		
		$arquivo = json_decode(Storage::disk('public')->get($this->diretorioPadrao.'/'.$this->nomeArquivo));
		
		foreach($arquivo as $linhaArquivo)
		{
			array_push($dadosArquivo, $this->converterObjetoJSONParaViewModel($linhaArquivo, $viewModel));
		}

		return $dadosArquivo; 
    }

    protected function converterObjetoJSONParaViewModel($objetoOrigem, $objetoDestino)
	{
		if (is_array($objetoOrigem)) { $objetoOrigem = (object)$objetoOrigem; }
		if (is_string($objetoDestino)) { $objetoDestino = new $objetoDestino(); }

		$origemReflection = new \ReflectionObject($objetoOrigem);
		$destinoReflection = new \ReflectionObject($objetoDestino);
		$propriedadesObjetoOrigem = $origemReflection->getProperties();
		
		foreach ($propriedadesObjetoOrigem as $propriedadeObjetoOrigem) 
		{
			$propriedadeObjetoOrigem->setAccessible(true);
			$nome = $propriedadeObjetoOrigem->getName();
			$valor = $propriedadeObjetoOrigem->getValue($objetoOrigem);
			if ($destinoReflection->hasProperty($nome)) 
			{
				$propDest = $destinoReflection->getProperty($nome);
				$propDest->setAccessible(true);
				$propDest->setValue($objetoDestino, $valor);
			} 
			//else { $objetoDestino->$nome = $valor; }
		}
		
		return $objetoDestino;
	}
}
