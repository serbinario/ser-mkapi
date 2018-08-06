<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 05/08/18
 * Time: 12:43
 */

namespace Serbinario\Services\MikrotikAPI\PPP;


trait TraitSecret
{

    /**
     * This method is used to set or edit ppp secret
     * @param type $param array
     * @param type $id string
     * @return type array
     *
     */
    public function set($router) {
        $router->write('/ppp/secret/set',false);
        $router->write('paulovaz',false);
        $router->write('=profile=Bloqueados');
        //dd($router);
        $READ = $router->read(false);
        $ARRAY = $router->parseResponse($READ);
        return $ARRAY;

       /* $router->write('/user/add', false);
        $router->write('=group=full', false);
        $router->write('=name=zuca', false);
        $router->write('=password=123456');*/
    }
    /**
     * This method is used to display all ppp secret
     * @return type array
     *
     */
    public function getAll($router) {
        $router->write('/ppp/active/print',true);
        $READ = $router->read(false);
        $ARRAY = $router->parseResponse($READ);

        return $ARRAY;
        $list = array();

        for ($i = 0; $i < count($ARRAY); $i ++)
        {
            $login = $ARRAY[$i]['name'];
        }

    }

}