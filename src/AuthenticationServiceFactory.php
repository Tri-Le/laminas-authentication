<?php


namespace TriLe\Authentication;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Laminas\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Laminas\Authentication\AuthenticationService;
use Laminas\Db\Adapter\Adapter;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AuthenticationServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config')['authentication'];
        //$class = $config['storage']['name'];
        return new AuthenticationService(new $config['storage']['name']($config['storage']['options']['name']),
            new CredentialTreatmentAdapter($container->get(Adapter::class),
            $config['table_name'],
            $config['identity_column'],
            $config['credential_column'],
            $config['credential_treatment']
            ));
    }

}