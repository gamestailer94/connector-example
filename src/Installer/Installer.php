<?php

namespace Jtl\Connector\Example\Installer;

use PDO;

class Installer
{
    protected $pdo;
    protected $connectorDir;
    
    public function __construct(PDO $pdo, string $connectorDir)
    {
        $this->pdo = $pdo;
        $this->connectorDir = $connectorDir;
    }
    
    public function run()
    {
        //Getting and executing all install scripts to setup the needed connector mapping tables as well as demo shop tables
        $scripts = glob(sprintf("%s/scripts/*.sql", $this->connectorDir));
        
        foreach ($scripts as $script) {
            $statement = $this->pdo->prepare(file_get_contents($script));
            $statement->execute();
        }
    }
}