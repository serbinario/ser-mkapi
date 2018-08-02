<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 01/08/18
 * Time: 12:30
 */

namespace Serbinario\Http\Controllers\BoletoFacil;


use Illuminate\Support\Facades\Response;
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
        $this->boletofacil = new BoletoFacil("B49E4B606E713E2EA1BCF345874BF4DBB36A234A106FB5FD4262AAE8CB912C64", $sandbox = true);
    }

    public function fetchPaymentDetails()
    {
        dd($this->boletofacil->fetchPaymentDetails('18636400:c177f9127d98d685238e6f5010638bfe6f1df5dfdc5f5e03c2d6cc7e3695f587'));

    }

    public function createBoleto($data)
    {

        $this->boletofacil->createCharge($data['nome'] ,$data['cpf'], $data['descricao'], $this->trataValor($data['valor_debito']), $data['data_vencimento']);

        $restorno = $this->boletofacil->issueCharge();
        $array = json_decode($restorno, true);

        if($array['success'])
        {

            //dd($array['data']['charges']['0']['code']);
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
//  create a new collection instance from the array
        $retornCole = collect($array);
        dd($retornCole['data']['charges'][0]['code']);
        return dd($data);

    }

    public function trataValor($value)
    {
            $value = str_replace(",",".",$value);
            return $value;

    }


}