<?php

namespace App;

use Illuminate\Support\Arr;

/*
 * A trait to handle authorization based on users permissions for given controller
 */

trait Authorizable
{
    /**
     * Abilities
     *
     * @var array
     */
    private $abilities = [
        'index' => 'view',
        'edit' => 'edit',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete',
    ];

    /**
     * Override of callAction to perform the authorization before it calls the action
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        if ($ability = $this->getAbility($method)) {
            $this->authorize($ability);
        }

        return parent::callAction($method, $parameters);
    }

    /**
     * Get ability
     *
     * @param $method
     * @return null|string
     */
    public function getAbility($method)
    {
        $routeName = explode('.', \Request::route()->getName());
        $action = Arr::get($this->getAbilities(), $method);

        // dd($action . '_' . $routeName[0]);
        return $action ? $action.'_'.$routeName[0] : null;
    }

    /**
     * @return array
     */
    private function getAbilities()
    {
        return $this->abilities;
    }

    /**
     * @param  array  $abilities
     */
    public function setAbilities($abilities)
    {
        $this->abilities = $abilities;
    }
}
