<?php
   function copiar_diretorio($diretorio, $destino, $ver_acao = false){
      if ($destino{strlen($destino) - 1} == '/'){
         $destino = substr($destino, 0, -1);
        }
      if (!is_dir($destino)){
         if ($ver_acao){
            echo "Criando diretorio {$destino}\n";
            }
         mkdir($destino, 0755);
      }

      $folder = opendir($diretorio);

      while ($item = readdir($folder)){
         if ($item == '.' || $item == '..'){
            continue;
            }
         if (is_dir("{$diretorio}/{$item}")){
            copy_dir("{$diretorio}/{$item}", "{$destino}/{$item}", $ver_acao);
         }else{
            if ($ver_acao){
               echo "Copiando {$item} para {$destino}"."\n";
            }
            copy("{$diretorio}/{$item}", "{$destino}/{$item}");
            }
      }
   }
?>

<?php
   copiar_diretorio('./diretorio1', './diretorio2/'); // copia o diretório inteiro
?>

<?php
   copiar_diretorio('./diretorio1', './'); // copia os arquivos do diretório para o diretório de execução
?>

<?php
   copiar_diretorio('./diretorio1', './diretorio2/', true);
    // Exibe as seguintes mensagens:
    // Criando diretorio ./diretorio2
    // Copiando documento excel.xlsx para ./diretorio2
    // Copiando documento word.docx para ./diretorio2
    // Copiando imagem.jpg para ./diretorio2
?>
