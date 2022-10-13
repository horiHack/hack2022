<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>

  <body>
    <?php


        set_time_limit(60*60*1); // 10 heures

        require_once 'phpQuery-onefile.php';

        $dossier = 'Haki';
$url = '';

        if(!file_exists($dossier)){
          // si le dossier a bien été créé
          if(mkdir($dossier)){
            $name = 1;
            for ($i=1; $i <= 19; $i++) { //50
              $url = $url . $i;

              // teste si l'url est valide : si elle éxiste
              $headers = @get_headers($url);
              if(strpos($headers[0],'404') === false){
                phpQuery::newDocumentFileHTML($url);

                foreach ( pq('img.aligncenter') as $img) {
                  $img = pq($img)->attr('src');

                  // si l'image n'a pas été copié
                  if(!copy($img, $dossier."/".$name.".jpg")) echo "Problème pour la copie de l'image : ".$img."<br/>";

                  $name++;
                }

                echo 'Page N°'.$i.' : URL bien parser : '.$url."<br/>";

              }else{
                echo "L'url n'est pas valide ou n'éxiste pas : ".$url."<br/>";
              }


              ob_flush();
              flush();
              ob_flush();
              flush();
            }
          }else{
            echo 'Impossible de créer le dossier<br/>';
          }
        }else{
          echo "Le fichier éxiste déjà<br/>";
        }
