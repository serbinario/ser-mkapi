<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 01/08/18
 * Time: 12:30
 */

namespace Serbinario\Http\Controllers\BoletoFacil;


use Illuminate\Support\Facades\Response;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\FinBoleto;
use Serbinario\Http\Controllers\BoletoFacil\BoletoFacil;

class BoletoFacilApi
{

    /**
     * @var BairroRepository
     */
    private $boletofacil;

    /**
     * @param BairroRepository $repository
     */
    public function __construct()
    {
        //Tokem do boleto facil
        //sandbox = true para desenvolvimento e fase para produçao
        $this->boletofacil = new BoletoFacil(env('BOLETO_FACIL_TOKEN'), $sandbox = env('BOLETO_FACIL_SENBOX'));

    }

    //Consulta de um boleto
    public function fetchPaymentDetails($data)
    {
        return $paymentDetails = $this->boletofacil->fetchPaymentDetails($data);

       // $array = json_decode($paymentDetails, true);


    }

    public function createBoleto($data)
    {
        $cliente = Cliente::find($data['mk_cliente_id']);
        //dd($cliente);

        $this->boletofacil->billingAddressStreet = $cliente->logradouro;
        $this->boletofacil->billingAddressComplement = $cliente->complemanto;
        $this->boletofacil->billingAddressNumber = $cliente->numero_casa;
        $this->boletofacil->billingAddressPostcode = $cliente->cep;
        $this->boletofacil->billingAddressCity = $cliente->cidade;
        $this->boletofacil->billingAddressState = $cliente->estado;

        //Falta colocar a cidade e o estado como obrigatprios
        //Verificar se vamos colcoar para pagar apos o vencimento

        //Prepara com os dados do cliente
        $this->boletofacil->createCharge($data['nome'] ,$cliente->cpf, $data['descricao'], $this->trataValor($data['valor_debito']), $data['data_vencimento']);

        //Gera um boleto a partir dos dados do cliente
        $retorno = $this->boletofacil->issueCharge();

        $array = json_decode($retorno, true);

        //Verifica se deu sucesso na requisiçao de gerar o boleto
        if($array['success'])
        {
            //Recupera os dados de resposta ao gerar um boleto
            $code =         $array['data']['charges']['0']['code'];
            $checkoutUrl =  $array['data']['charges']['0']['checkoutUrl'];
            $link =         $array['data']['charges']['0']['link'];
            $payNumber =    $array['data']['charges']['0']['payNumber'];
            $ourNumber =    $array['data']['charges']['0']['billetDetails']['ourNumber'];
            $barcodeNumber = $array['data']['charges']['0']['billetDetails']['barcodeNumber'];

            return ['success' => true, 'code' => $code, 'checkoutUrl' => $checkoutUrl, 'link' => $link,
                        'ourNumber' => $ourNumber, 'barcodeNumber' =>$barcodeNumber,
                        '$payNumber' => $payNumber
                    ];
        }else{
            return ['success' => false, 'msg' => $array['errorMessage']];
        }
    }



    /**
     * @param $data
     * @return array Cancela um boleto passando o parametro code do boleto RN-0003
     */
    public function cancelCharge($code)
    {
        //dd($code);
        $retorno = $this->boletofacil->cancelCharge($code);

        $array = json_decode($retorno, true);
        //dd($array);
        if($array['success'])
        {
            return ['success' => true];
        }else{
            return ['success' => false, 'msg' => $array['errorMessage']];
        }
    }

    //Trata os campos valores, transformando "vigula" em "ponto"
    public function trataValor($value)
    {
            $value = str_replace(",",".",$value);
            return $value;

    }


}