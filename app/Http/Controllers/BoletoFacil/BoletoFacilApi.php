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

        $this->boletofacil->maxOverdueDays = 30;
        $this->boletofacil->fine = "2.00";
        $this->boletofacil->interest = "0.33";



        //Falta colocar a cidade e o estado como obrigatprios
        //Verificar se vamos colcoar para pagar apos o vencimento

        //Prepara com os dados do cliente
        $this->boletofacil->createCharge(
            $data['nome'],
            $cliente->cpf,
            $data['descricao'],
            $this->trataValor($data['valor_debito']),
            $data['data_vencimento']
        );

        $this->boletofacil->installments = $data['parcelas'];

        //Gera um boleto a partir dos dados do cliente
        $retorno = $this->boletofacil->issueCharge();

        //dd($retorno);
        $array = json_decode($retorno, true);

    //dd($array);
        //Verifica se deu sucesso na requisiçao de gerar o boleto
        if($array['success'])
        {
            //Recupera os dados de resposta ao gerar um boleto
            foreach ($array['data']['charges'] as $key => $value) {
                //Recupera os dados de resposta ao gerar um boleto
                $code =         $value['code'];
                $dueDate =      $value['dueDate'];
                $checkoutUrl =  $value['checkoutUrl'];
                $link =         $value['link'];
                $payNumber =    $value['payNumber'];
                $ourNumber =    $value['billetDetails']['ourNumber'];
                $barcodeNumber = $value['billetDetails']['barcodeNumber'];

                //Gera um boleto a partir dos dados de retorno do BoletoFacil
                $boletoGerado = FinBoleto::create(
                    [
                        'code' => $code,
                        'checkoutUrl' => $checkoutUrl,
                        'link' => $link,
                        'ourNumber' => $ourNumber,
                        'barcodeNumber' =>$barcodeNumber,
                        '$payNumber' => $payNumber
                    ]
                );

                $data['data_vencimento'] = $dueDate;

                //Subtrai a data em um mes
                $data['data_competencia'] = date('d/m/Y', strtotime(implode('-', array_reverse(explode('/', $dueDate))) . "-1 months") );
                //dd($data);
                //Com os dados do formulario, adiciono o id do boleto + o status de aguardando que e 2 ao debito
                $data = array_merge($data, [ 'boleto_id' => $boletoGerado->id, 'status_id' => '2']);

                //Salva o debito vinculado ao boleto gerado
                Debitos::create($data);

                //dd($boletoGerado);

            }

            return ['success' => true ];
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