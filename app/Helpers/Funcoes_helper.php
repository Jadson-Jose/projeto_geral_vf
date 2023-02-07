<?php 

  // ==============================================================================
  function verDados($array){
      echo '<pre>';
      echo 'Dados do Array<hr>';
      foreach($array as $key => $value) {
          echo "<p>$key => $value</p>";
     }
      echo '</pre>';
     die();
  }

  // ==============================================================================
  function verSessao(){
    
    // Todos os dados guardados na sessao
    die();
  }



?>