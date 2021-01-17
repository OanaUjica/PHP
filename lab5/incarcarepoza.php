<style>.error {color:#FF0000;}</style>

<?php
 if (isset($_POST["submit"]))
 {

    $fileerr="";
  // verificare daca a fost uploadat un fisier
    if($_FILES["fileupload"]["size"]==0)
        {
          $fileerr="Poza de profil este obligatorie";
          $eroare=1;
        }
  // verifica sa nu fie prea mare fisierul
    elseif($_FILES["fileupload"]["size"]>$max_file_size)
        {
          $fileerr="Fisierul este prea mare";
          $eroare=1;
        }
  // verifica daca fisierul este o poza
    elseif(getimagesize($_FILES["fileupload"]["tmp_name"])==false)
        {
          $fileerr="Fisierul nu este o imagine";
          $eroare=1;
        }
  // verifica daca fisierul este .jpg
        /*    else
                {
                  $target_file = $file_dir . basename($_FILES["fileupload"]["name"]);
                  $image_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                  if ($image_type !="jpg")
                    {
                      $fileerr="Fisierul trebuie sa fie jpg";
                      $eroare=1;
                    }
                }
          */

     $file_dir="pictures/";
  // se declara o variabila pentru locatia si denumirea fisierului de salvat (cu numele original al fisierului)
     $target_file = $file_dir . basename($_FILES["fileupload"]["name"]);
  // se scoate extensia din denumirea fisierului
     $image_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // se declara o variabila pentru locatia si denumirea fisierului de salvat (cu username-ul introdus si extensia originala)
     $target_file = $file_dir . $username1 .".". $image_type;
  // se uploadeaza poza
     move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file);
 }
?>
