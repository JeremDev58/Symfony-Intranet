<?php

namespace App\Service;

use App\Repository\DomaineRepository;

class DomaineService
{
     private $_fichier = '../../domaines.txt';
     private $_domaineRepository;
     private $_repository;
     private $_vphp;
     private $_documentRoot;
     private $_serverName = 'ServerName ';
     private $_serverAlias = 'ServerAlias ';
     private $_content='';
     private $_handle;
     private $_tabFile;
     private $_target='';

     public function __contruct(DomaineRepository $domaineRepository)
     {
          $fichier = $this->_fichier;
          $this->_domaineRepository = $domaineRepository;
          $repository = $this->_domaineRepository;
          $vphp = $this->_vphp;
          $documentRoot = $this->_documentRoot;
          $serverName = $this->_serverName;
          $serverAlias = $this->_serverAlias;
          $content = $this->_content;
          $handle = $this->_handle;
          $tabFile = $this->_tabFile;
          $target = $this->_target;

     }


     public function genererHosts($id)
     {

          $tabFile =  file("../../httpd-conf.php");

          $handle = fopen($fichier, 'w');

          $domaine = $repository->findAll($id);

          $vphp = $domaine['php'];
          $serverName = $serverName.$domaine['domaineLocal'];

          $alias = explode('.', 'www.test.com');
          $alias[0] = '*';
          for ($i=0; $i < count($alias); $i++)
          {

               if ($i == count($alias)) {
                    $target .= $alias[$i];
               } else {
                    $target .= $alias[$i].'.';
               }

          }
          $serverAlias = $serverAlias.$target;

          $this->loopWrite(0, 8);

          switch ($vphp) {
               case 5.6:
                    $this->loopWrite(9,34);
                    break;
               case 7.0:
                    $this->loopWrite(35, 58);
                    break;
               case 7.2:
                    $this->loopWrite(59, 83);
                    break;

               default:
                    // code...
                    break;
          }

          $this->loopWrite(88, 101);

          $content = $serverName."\r\n".$serverAlias."\r\n";
          fwrite($handle, $content);

          $this->loopWrite(105, 143);

          fclose($handle);

     }

     private function loopWrite($intLineStart, $intLineEnd)
     {
          for($i=$intLineStart; $i<$intLineEnd; $i++)
          {
               $content .= $tabFile[$i]."\r\n";
          }

          fwrite($handle, $content);

     }


}
