<?php

class Pico_GitPull{

  function __construct($owner){
  }

  public function precheck(){
    return "";
  }

  public function run(){
    chdir(ROOT_DIR);
    $out = "";
    exec('git pull 2>&1', $output, $ret);
    if($ret == 0){
      $out = implode("\n", $output);
      $output = "";
      exec('git submodule update 2>&1', $output, $ret);
      $out .= "----submodule----\n" . implode("\n", $output);
    }else{
      $out = implode("\n", $output);
    }
    return array("success" => $ret == 0, "message" => $out);
  }
}

?>