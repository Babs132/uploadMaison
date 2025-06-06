<?php
if(isset($_POST['nom']))
{
    $err=0;
    if(empty($_POST['nom']))
    {
        $err =1;
    }else{
        $nom = htmlspecialchars($_POST['description']);
    }
    if(empty($_POST['description']))
    {
        $err =2;
    }else{
        $description = htmlspecialchars($_POST['description']);
    }
    if($err == 0)
    {
        if(isset(['image']))
        {
        if($_FILES['image']['error']==0)
            {
                $dossier = 'images/';
                $fichier = basename($_FILES['image']['name']);
                $tailleMaxi = 200000;
                $taille = filesize($_FILES['image']['tmp_name']);
                $extensions = ['.png','.gif','.jpg','.jpeg'];
                $mimes = ["image/jpeg","imagez/gif","image/png"];
                $extention = strrchr($_FILES['image']['name'], '.');
                $mime = $_FILES['image']['ttype'];

                if($taille>$tailleMaxi)
                {
                    $err = "i5";
                }
                if(!n_array($extension, $extensions))
                {
                    $err = "i6";
                }
                if(!in_array($mime,$mimes))
                {
                    $err= "i7"
                }

                if($err==0)
                {
                    //On formate le nom du fichier, strtr remplace tous les KK spéciaux en normaux suivant notre liste
                    // image crée.jpg
                    $fichier = strtr($fichier,
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    // image cree.jpg
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); 
                    // image-cree.jpg
                    // preg_replace remplace tout ce qui n'est pas un KK normal en tiret
                    $fichiercplt = rand().$fichier;
                    // 6156156156image-cree.jpg
                    // move_uploaded_file(c:/wamp64/tmp/tmpkjfdklsfjkldsf.tmp, images/6156156156image-cree.jpg)
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$dossier.$fichiercplt))
                    {
                        require "connexion.php";
                        $insert = $bdd->prepare("INSERT INTO products(nom,description,cover) VALUES(:nom,descri,:cover)");
                        $insert->execute([
                            "nom" => $nom,
                            ":descri" => $description,
                            ":cover" => $fichiercplt
                        ]);
                        header("LOCATION:index.php?upload=success");
                        exit();
                    }else{
                        header("LOCATION: index.php?error=i8");
                        exit();
                    }
                }else{
                    header("LOCATION:index.php?error=".$error);
                    exit();
                }
            }else{
                header("LOCATION:index.php?error=3");
                exit();
            }

        }else{
            header("LOCATION:index.php?error=".$err);
            exit();
        }
    }else{
        header("LOCATION: index.php?error=".err);
        exit();
    }

}
?>