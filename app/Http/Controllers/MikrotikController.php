<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 06/08/18
 * Time: 18:14
 */

namespace Serbinario\Http\Controllers;


use Serbinario\Entities\Cliente;
use Serbinario\Services\MikrotikAPI\RouterosService;
use Ssh\Auth\Password;
use Ssh\Client;

class MikrotikController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enableDisableSecret($id)
    {

        try {
            //Consulta o cliente passando o id
            $cliente = Cliente::with('mkProfile')->findOrFail($id);

            //Pego os parametros login e profile do cliente e o status do cliente em relaçao ao mikrotik se esta bloqueado ou nao
            $login = $cliente->login;
            $profileNome = $cliente->mkProfile->nome;
            $status_secret = $cliente->status_secret;

            //dd($cliente->status_secret);
            //Inverte o status do da variavel status_secret
            ($status_secret == "1" ? $profileNome = "Bloqueados" : $profileNome = $cliente->mkProfile->nome);

            $cliente->status_secret = !$cliente->status_secret;

            //dd($profileNome);
            $router = new RouterosService();
            $router->debug = false;
            $router->connect('170.245.65.134', 'NetSerb', 'nets@2017#');

            //Altera o profile do cliente
            $rest = $router->comm("/ppp/secret/set", array(
                "numbers"     => $login,
                "profile" => $profileNome
            ));

            //Remove o cliente conectado
            $this->removePPP($router, $login);

            //Salva
            $cliente->save();

            $router->disconnect();

            return \Illuminate\Support\Facades\Response::json(['success' => true ]);

        } catch (Exception $exception) {

            return \Illuminate\Support\Facades\Response::json(['error' => true ]);
        }

    }

    /*
     * Desbloqueio do cliente
     * Seta o cliente com o profile dele e desconecta o cliente
     */
    public function enableSecret($id)
    {

        try {
            //Consulta o cliente passando o id
            $cliente = Cliente::with('mkProfile')->findOrFail($id);

            //Pego os parametros login e profile do cliente e o status do cliente em relaçao ao mikrotik se esta bloqueado ou nao
            $login = $cliente->login;
            $profileNome = $cliente->mkProfile->nome;

            //Coloca o status para 1 como besbloqueado
            $cliente->status_secret = 1;

            //dd($profileNome);
            $router = new RouterosService();
            $router->debug = false;
            $router->connect('170.245.65.134', 'NetSerb', 'nets@2017#');

            //Altera o profile do cliente
            $rest = $router->comm("/ppp/secret/set", array(
                "numbers"     => $login,
                "profile" => $profileNome
            ));

            //Remove o cliente conectado
            $this->removePPP($router, $login);

            //Salva
            $cliente->save();

            $router->disconnect();

            return \Illuminate\Support\Facades\Response::json(['success' => true ]);

        } catch (Exception $exception) {

            return \Illuminate\Support\Facades\Response::json(['error' => true ]);
        }

    }

    /*
     * remove um secret do mikrotik
     */
    public function removePPP($router, $name)
    {
        $router->write("/ppp/active/getall",false);
        $router->write('?name='.$name,true);
        $READ = $router->read(false);
        $ARRAY = $router->parseResponse($READ);
        if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
            $router->write("/ppp/active/remove",false);
            $router->write("=.id=".$ARRAY[0]['.id'],true);
            $READ = $router->read(false);
            $ARRAY = $router->parseResponse($READ);
        }
        //var_dump($ARRAY);
    }

    protected function _resultsToArray( $string ) {
        $lines = preg_split("\n", $string );
        $responseArray = [];
        foreach( $lines as $line ) {
            $lineArr = array_map('trim', preg_split(': ', $line));
            if ( $lineArr[0] ) {
                $responseArray[$lineArr[0]] = $lineArr[1];
            }
        }
        return $responseArray;
    }



    protected function _tableFlagsFixup( $dataArr ) {
        foreach ($dataArr as $key=>$item ) {
            preg_match_all('/([0-9]+)\s?(.+)?/', $item['#'], $matches);

            if ( $flags = str_split(trim($matches[2][0])) ) {
                $dataArr[$key]['_flags'] = $matches[2][0];
            }
            $dataArr[$key]['_index'] = $matches[1][0];
            unset( $dataArr[$key]['#'] );
        }
        return $dataArr;
    }

    protected function _parseTableFlags( $string ) {
        //convert newlines to spaces incase flags span multiple lines
        $string = str_replace("\n", "\s", $string);
        //Parse Flags
        $flags = [];
        if (!preg_match( '/Flags:\s(.*)/', $string, $matches ) ) {
            return false;
        }
        $flagsExtract = $matches[1];
        preg_match_all( '/([A-Z])\s-\s([a-z]+)/', $flagsExtract, $matches );
        foreach( $matches[1] as $key=>$val ) {
            $flags[$matches[1][$key]] = $matches[2][$key];
        }
        return $flags;
    }

    protected function _tableAddComments( $dataArr, $comments ) {
        foreach( $comments as $key=>$comment ) {
            $dataArr[$key]['_comment'] = $comment;
        }
        return $dataArr;
    }

    protected function _tableRemoveComments( $string ) {
        preg_match_all('/(([0-9]+).*)[;]{3}\s(.*)\n\s+/', $string, $matches);
        $comments = [];
        $string_wo_comments = $string;
        foreach( $matches[2] as $key=>$index ) {
            $string_wo_comments = str_replace( $matches[0][$key], $matches[1][$key], $string_wo_comments);
            $comments[$index] = $matches[3][$key];
        }
        return array( $string_wo_comments, $comments );
    }

    protected function _tableGetColumns( $data ) {
        if ( !array_key_exists(0, $data)  ) { return []; }
        $keys = array_keys( $data[0] );
        foreach ( $keys as $i=>$key ) {
            if ( substr($key, 0, 1) == '_' ) {
                unset( $keys[$i] );
            }
        }
        return $keys;
    }


}