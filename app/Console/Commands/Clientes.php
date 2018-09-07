<?php

namespace Serbinario\Console\Commands;

use Illuminate\Console\Command;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Cobranca;
use Serbinario\Entities\Debito;
use Serbinario\Entities\SisClientes;

class Clientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cliente:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$command = $this->argument('command');


        //
        //$this->listaFaltantesMKClientes();
        // $this->importCobranca();
        $this->importCsv();
        //$this->importCsvClientDrop();
        //$this->atualizaTabelaMKClientes();
        //$this->importSisClienteToMkClientes();
        //$this->importSisClienteToMkClientesFaltantes();

    }

    function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;

                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }


    //Ler o arquivo .csv e compara com a coluna nome da tabela cobrança
    // se encontrar atualiza o campo login
    //Isso tem que ser executado depois de atualizar a tabela cobrança
    public function importCsvClientDrop()
    {
        $file = public_path('ClientesDrop01.csv');
        //dd($file);

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            //dd($customerArr[$i]['nome']);
            $nome = $customerArr[$i]['nome'];
            $login = $customerArr[$i]['login'];
            $cobrancas =  Cobranca::where('nome', '=' , $nome)->limit(1)->get();
            echo $i . " " . $nome . " --- " ;
            //$cobrancas =  Cobranca::all();
            foreach ($cobrancas as $cobranca){
                echo $cobranca->nome . " " . $login . "\n";
                $cobranca->login = $login;
                $cobranca->save();
            };
            echo "\n";
            //Cobranca::firstOrCreate($customerArr[$i]);
        }

        return 'Jobi done or what ever';
    }

    public function atualizaTabelaMKClientes()
    {
        $file = public_path('ClientesDrop01.csv');
        //dd($file);

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            //dd($customerArr[$i]['nome']);
            $nome = $customerArr[$i]['nome'];
            $login = $customerArr[$i]['login'];
            $clientes =  Cliente::where('login', '=' , $login)->limit(1)->get();
            echo $i . " " . $nome . " --- " ;
            //$cobrancas =  Cobranca::all();
            foreach ($clientes as $cliente){
                echo $cliente->nome . " " . $login . "\n";
                $cliente->nome = $nome;
                $cliente->save();
            };
            echo "\n";
            //Cobranca::firstOrCreate($customerArr[$i]);
        }

        return 'Jobi done or what ever';
    }

    public function listaFaltantesMKClientes()
    {
        $file = public_path('ClientesDrop01.csv');
        //dd($file);

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            //dd($customerArr[$i]['nome']);
            $nome = $customerArr[$i]['nome'];
            $login = $customerArr[$i]['login'];
            $clientes =  Cliente::where('login', '=' , $login)->limit(1)->get();
            if($clientes->isEmpty())
            {
                echo $i . " " . $login . " " . $nome . "\n " ;
            }


            //Cobranca::firstOrCreate($customerArr[$i]);
        }

        return 'Jobi done or what ever';
    }

    //Importa para a tabela cobrança a partir do relatorio do gerencianet
    //Foi gerado com os campos cancelados, aguandando, pagos, etc......
    public function importCsv()
    {
        $file = public_path('Cobranca_10-09-2018.csv');

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            //dd($customerArr[$i]);
            //dd($customerArr[$i]['valor'] );
            $customerArr[$i]['valor'] = str_replace(",", ".", $customerArr[$i]['valor']);
            //$customerArr[$i]['valor_pago'] = str_replace(",", ".", $customerArr[$i]['valor_pago']);
            //dd($customerArr[$i]['valor_pago']);
            Cobranca::create($customerArr[$i]);
        }

        return 'Jobi done or what ever';
    }

    //Importa para a tabela cobrança a partir do relatorio do gerencianet
    //Foi gerado com os campos cancelados, aguandando, pagos, etc......
    public function importSisClienteToMkClientes()
    {
        $sisClientes = SisClientes::all();
        foreach ($sisClientes as $sisCliente){
            $cliente =  Cliente::where('login', '=' , $sisCliente->login)->first();

            if(!empty($cliente) ) {
                //dd(isset($sisCliente->cpf_cnpj)? "$cliente->cpf =  $sisCliente->cpf_cnpj" : "");
                isset($sisCliente->cpf_cnpj) ? $cliente->cpf = $sisCliente->cpf_cnpj : "";
                $cliente->phone01 = $sisCliente->celular;
                $cliente->logradouro = $sisCliente->endereco;
                $cliente->senha = $sisCliente->senha;
                $cliente->email = $sisCliente->email;
                $cliente->bairro = $sisCliente->bairro;
                $cliente->cidade = $sisCliente->cidade;
                $cliente->cep = $sisCliente->cep;
                $cliente->data_instalacao = $sisCliente->data_ins;

                echo $sisCliente->id . " " .  $cliente->data_instalacao ." " . $sisCliente->login . " " . $sisCliente->nome . " " . $sisCliente->data_ins . " " . $sisCliente->cpf_cnpj . "\n ";
                $cliente->save();
                // dd($sisCliente->login, $sisCliente->cpf_cnpj, $sisCliente->celular);
            }

        }
    }

    //Importa para a tabela cobrança a partir do relatorio do gerencianet
    //Foi gerado com os campos cancelados, aguandando, pagos, etc......
    public function importSisClienteToMkClientesFaltantes()
    {
        $sisClientes = SisClientes::where('data_ins', '>' , '2018-06-01')->get();
        //dd($sisClientes);
        foreach ($sisClientes as $sisCliente){

            $cliente =  Cliente::where('login', '=' , $sisCliente->login)->first();
            if(empty($cliente) ) {
                $clienteN = new Cliente();
                $clienteN->nome = $sisCliente->nome;
                $clienteN->login = $sisCliente->login;
                $clienteN->email = $sisCliente->email;
                $clienteN->cpf = $sisCliente->cpf_cnpj;
                $clienteN->phone01 = $sisCliente->celular;
                $clienteN->logradouro = $sisCliente->endereco;
                $clienteN->email = $sisCliente->email;
                $clienteN->bairro = $sisCliente->bairro;
                $clienteN->cidade = $sisCliente->cidade;
                $clienteN->cep = $sisCliente->cep;
                $clienteN->data_instalacao = $sisCliente->data_ins;
                echo $sisCliente->login ." - " .$sisCliente->nome . "-- " .$sisCliente->data_ins.  "\n";
                $clienteN->save();
            }



        }
    }

    //Importa para a tabela cobrança a partir do relatorio do gerencianet
    //Foi gerado com os campos cancelados, aguandando, pagos, etc......
    public function importCobranca()
    {
        $file = public_path('julho05.csv');

        $customerArr = $this->csvToArray($file);

        for ($i = 0; $i < count($customerArr); $i ++)
        {
            //dd($customerArr[$i]);
            //dd($customerArr[$i]['valor'] );
            //dd($customerArr[$i]['nome']);
            $nome = $customerArr[$i]['nome'];
            $clientes = Cliente::where('nome', '=', $nome)->get();
            if(!$clientes->isEmpty()){
                foreach ($clientes as $cliente){
                    //echo $cliente->id . " - " . $cliente->nome . " ST " . $customerArr[$i]['status'] .  "\n";
                    $numero_cobrana = $customerArr[$i]['numero_cobranca'];
                    $debito = Debito::where('numero_cobranca', '=', $numero_cobrana)->get();
                    //dd($debito);
                    if($debito->isEmpty()){
                        //echo $i ." -- ". $cliente->id . " - " . $cliente->nome . " ST " . $customerArr[$i]['status'] .  " Criado - \n";
                        Debito::create([
                            'mk_cliente_id' => $cliente->id,
                            'numero_cobranca' => $customerArr[$i]['numero_cobranca'],
                            'valor_debito' => $customerArr[$i]['valor_debito'],
                            'valor_pago' => $customerArr[$i]['valor_pago'],
                            'status' => $customerArr[$i]['status'],
                            'data_vencimento' => $customerArr[$i]['data_vencimento'],
                            'data_pagamento' => $customerArr[$i]['data_pagamento'],
                        ]);
                    }else{
                        echo $i ." -- ". $cliente->id . " - " . $cliente->nome . " ST " . $customerArr[$i]['status'] . " --- ". $customerArr[$i]['valor_pago'] . " Atualizado --\n";
                        $debito = Debito::where('numero_cobranca', '=', $numero_cobrana);
                        $debito->update([
                            'status' => $customerArr[$i]['status'],
                            'data_pagamento' =>  empty($customerArr[$i]['data_pagamento']) ? null : $this->setDataPagamento($customerArr[$i]['data_pagamento']),
                            'valor_pago' =>  empty($customerArr[$i]['valor_pago']) ? null : $this->setValorPago($customerArr[$i]['valor_pago']),

                        ]);
                    }
                };

            }else{
                echo  $nome .  ";".  $customerArr[$i]['status'] .";\n";
            }

            //echo $nome . " - " . $i . "\n";

            // Debito::firstOrCreate($customerArr[$i]);
        }

        return 'Jobi done or what ever';
    }

    public function setDataPagamento($value)
    {
        if($value){
            return substr($value,6,4)."-".substr($value,3,2)."-".substr($value,0,2);
        }
    }

    public function setValorPago($value)
    {
        return $value = str_replace(",",".",$value);

    }
}
