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
        //Colocar esses dados no .env
        $this->boletofacil = new BoletoFacil("7A5DCDDB10B0050CD26DE5E763EB264E3D47F31518E59C668A3712142805D457", $sandbox = false);
        //$this->boletofacil = new BoletoFacil("B49E4B606E713E2E8EE31D44D999EEF2178CE4F078D0B249951AB148533F0B7D", $sandbox = true);


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

        $this->boletofacil->billingAddressStreet = $cliente->logradouro;
        $this->boletofacil->billingAddressComplement = $cliente->complemanto;
        $this->boletofacil->billingAddressNumber = $cliente->numero_casa;
        $this->boletofacil->billingAddressPostcode = $cliente->cep;
        $this->boletofacil->billingAddressCity = $cliente->cidade;
        $this->boletofacil->billingAddressState = $cliente->estado;

        //Falta colocar a cidade e o estado como obrigatprios
        //Verificar se vamos colcoar para pagar apos o vencimento

        //Prepara com os dados do cliente
        $this->boletofacil->createCharge($data['nome'] ,$data['cpf'], $data['descricao'], $this->trataValor($data['valor_debito']), $data['data_vencimento']);

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

    //Trata os campos valores, transformando "vigula" em "ponto"
    public function trataValor($value)
    {
            $value = str_replace(",",".",$value);
            return $value;

    }


}