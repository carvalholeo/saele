<?php
/*
Copyright 2011 da UFRGS - Universidade Federal do Rio Grande do Sul

Este arquivo � parte do programa SAELE - Sistema Aberto de Elei��es Eletr�nicas.

O SAELE � um software livre; voc� pode redistribu�-lo e/ou modific�-lo dentro dos
termos da Licen�a P�blica Geral GNU como publicada pela Funda��o do Software Livre
(FSF); na vers�o 2 da Licen�a.

Este programa � distribu�do na esperan�a que possa ser �til, mas SEM NENHUMA GARANTIA;
sem uma garantia impl�cita de ADEQUA��O a qualquer MERCADO ou APLICA��O EM PARTICULAR.
Veja a Licen�a P�blica Geral GNU/GPL em portugu�s para maiores detalhes.

Voc� deve ter recebido uma c�pia da Licen�a P�blica Geral GNU, sob o t�tulo "LICENCA.txt",
junto com este programa, se n�o, acesse o Portal do Software P�blico Brasileiro no
endere�o www.softwarepublico.gov.br ou escreva para a Funda��o do Software Livre(FSF)
Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301, USA
*/

function vazio($valor) {
  if(is_object($valor)) return false;
  return (($valor!='0')AND(@empty($valor))OR(@trim($valor)=='')OR(@is_null($valor)));
}

function IpsPermitidos($ipspermitidos){
  if(is_array($ipspermitidos)) $argumentos = $ipspermitidos;
        else $argumentos = func_get_args();

  if(array_search($_SERVER['REMOTE_ADDR'],$argumentos) === false) return false;
     else return true;
}

function post() {
  $numerodeargumentos=func_num_args();

  if ($numerodeargumentos>0) {
    $listadeargumentos=func_get_args();

    for ($i=0;$i<$numerodeargumentos;$i++) {
      $nomedavariavel=$listadeargumentos[$i];
      global $$nomedavariavel;
      $$nomedavariavel = (isset($_POST[$nomedavariavel])) ? $_POST[$nomedavariavel] : false ;
    }
    unset($listadeargumentos);
  } else {
    foreach (array_keys($_POST) as $nomedavariavel) {
      global $$nomedavariavel;
      $$nomedavariavel = (isset($_POST[$nomedavariavel])) ? $_POST[$nomedavariavel] : false ;
    }
  }

  unset($numerodeargumentos,$nomedavariavel);
}

function get() {
  $numerodeargumentos=func_num_args();

  if ($numerodeargumentos>0) {
    $listadeargumentos=func_get_args();

    for ($i=0;$i<$numerodeargumentos;$i++) {
      $nomedavariavel=$listadeargumentos[$i];
      global $$nomedavariavel;
      $$nomedavariavel = (isset($_GET[$nomedavariavel])) ? $_GET[$nomedavariavel] : false ;
    }
    unset($listadeargumentos);
  } else {
    foreach (array_keys($_GET) as $nomedavariavel) {
      global $$nomedavariavel;
      $$nomedavariavel = (isset($_GET[$nomedavariavel])) ? $_GET[$nomedavariavel] : false ;
    }
  }

  unset($numerodeargumentos,$nomedavariavel);
}

function request() {
  $numerodeargumentos=func_num_args();

  if ($numerodeargumentos>0) {
    $listadeargumentos=func_get_args();

    for ($i=0;$i<$numerodeargumentos;$i++) {
      $nomedavariavel=$listadeargumentos[$i];
      global $$nomedavariavel;
      $$nomedavariavel = (isset($_REQUEST[$nomedavariavel])) ? $_REQUEST[$nomedavariavel] : false ;
    }
    unset($listadeargumentos);
  } else {
    foreach (array_keys($_REQUEST) as $nomedavariavel) {
      global $$nomedavariavel;
      $$nomedavariavel = (isset($_REQUEST[$nomedavariavel])) ? $_REQUEST[$nomedavariavel] : false ;
    }
  }

  unset($numerodeargumentos,$nomedavariavel);
}

function session() {
  if (isset($_SESSION)) {
    $numerodeargumentos=func_num_args();

    if ($numerodeargumentos>0) {
      $listadeargumentos=func_get_args();

      for ($i=0;$i<$numerodeargumentos;$i++) {
        $nomedavariavel=$listadeargumentos[$i];
        global $$nomedavariavel;
        $$nomedavariavel = (isset($_SESSION[$nomedavariavel])) ? $_SESSION[$nomedavariavel] : false ;
      }
      unset($listadeargumentos);
    } else {
      foreach (array_keys($_SESSION) as $nomedavariavel) {
        global $$nomedavariavel;
        $$nomedavariavel = (isset($_SESSION[$nomedavariavel])) ? $_SESSION[$nomedavariavel] : false ;
      }
    }

    unset($numerodeargumentos,$nomedavariavel);
  }
}

function formatatextohtml($texto,$fazlinks=false) {
  $texto=nl2br(htmlentities($texto));
  if ($fazlinks) {
    $texto = fazlinks($texto);
  }
  return $texto;
}

function fazlinks($texto) {
  $texto = preg_replace('/([^\/])www./','\1http://www.', $texto);
  $texto = preg_replace('/(http:\/\/)([\w\.\-\/\~\:]+[\w\/])(\?[^ ]*[\w])?/', '<a href="\1\2\3" target="_blank">\2</a>', $texto);
  $texto = preg_replace('/([\w\.\-]+@[\w\.\-]+[\w])/', '<a href="mailto:\1" target="_blank">\1</a>', $texto);
  return $texto;
}

function gerachave($parametros) {
  $listadeargumentos=func_get_args();
  $str_chave='b2io56ew';
  $chave=null;
  foreach ($listadeargumentos as $argumento) {
    $chave.=$str_chave.$argumento;
  }
  return sha1($chave);
}


function redireciona($url) {
  ob_clean();
  header('location: '.$url);
}

function random($Minimo,$Maximo) {
  return rand($Minimo,$Maximo);
}

function mostraarray(&$array) {
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
?>