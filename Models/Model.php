<?php
namespace App\Models;

use App\Core\Db;

class Model extends Db{
    
    // Table de la base de donnée
    protected $table;
    
    // Instance de DB
    private $db;

    public function findAll(){
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    public function findBy(array $criteres){
        $champs = [];
        $valeurs = [];

        // je boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur){
            // SELECT * FROM artiles where status = ?
            // bindValue(1, valeur)
            $champs[] = "$champ = ? ";
            $valeurs[] = $valeur;
        }
        // var_dump($champs);
        // var_dump($valeurs);
        // je transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(' AND ', $champs);
        //var_dump($liste_champs);

        // j'exécute la requête 
        return $this->requete('SELECT * FROM '.$this->table.' WHERE ' .$liste_champs,$valeurs)->fetchAll();


        
    }

    public function find(int $id){
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();

    }
    public function create(Model $model){
        $champs = [];
        $inter = [];
        $valeurs = [];

        // je boucle pour éclater le tableau
        foreach($model as $champ => $valeur){
            // INSERT INTO articles (title, shortDescription, status) VALUES (?,?,?)
            
            if($valeur != null && $champ != 'table' && $champ !='db'){

                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }

        }
        // var_dump($champs);
        // var_dump($valeurs);
        // je transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);


        // echo $liste_champs; die($liste_inter);

        // j'exécute la requête 
        return $this->requete('INSERT INTO '.$this->table.' ('.$liste_champs.') VALUES('.$liste_inter.')', $valeurs);

        
    }
    public function update(int $id, Model $model){
        $champs = [];
        $valeurs = [];

        // je boucle pour éclater le tableau
        foreach($model as $champ => $valeur){
            // UPDATE articles SET title=? , shortDescription = ?, status=? WHERE id = $id
            
            if($valeur !== null && $champ != 'table' && $champ !='db'){

                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }

        }
        $valeurs[]=$id;
      
        // je transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);
       

        // j'exécute la requête 
        return $this->requete('UPDATE '.$this->table.' SET '.$liste_champs.' WHERE id = ?', $valeurs);

        
    }

    public function delete(int $id){
        return $this-> requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    protected function requete(string $sql, array $attributs = null){
        
        // je récupère l'instance de Db
        $this->db = Db::getInstance();

        //on vérifie si on a des attributs
       if($attributs !== null){
        // requête préparée
        $query=$this->db->prepare($sql);
        $query->execute($attributs);
        return $query;

       }else{
        // requête simple
        return $this->db->query($sql);
       }
    }
    public function hydrate(array $donnees){
        foreach($donnees as $key => $value){
            // on récupère le nom du setter correspondant à la clé (key)
            // title -> setTitle
            $setter = 'set'.ucfirst($key);

            // je vérifie si le setter existe 
            if(method_exists($this, $setter)){
                // j'appelle le setter
                $this->$setter($value);

            }
        }
        return $this;
    }
}