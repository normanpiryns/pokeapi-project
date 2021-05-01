<?php 

class PokemonDAO {
	public function __construct () {
        
        $this->connection = new PDO('mysql:host=localhost;dbname=pokemon_db', 'root', '');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    function fetchAll () {
        try {
            $statement = $this->connection->prepare("SELECT * FROM pokemon");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $this->createAll($result);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    
    
    function createAll ($results) {
        $pokemonList = array();

        foreach ($results as $result) {
            array_push($pokemonList, $this->create($result));
        }
        return $pokemonList;
    }

    function create ($result) {
        return new Pokemon(
            $result['id'],
            $result['name'],
            $result['image']
        );
    }

    function store ($data) {
        $pokemon = $this->create(['id'=> 0, 'name'=>$data['name'], 'image' => $data['image']]);

        if ($pokemon) {
            try {
                $statement = $this->connection->prepare(
                    "INSERT INTO pokemon (name, image) VALUES (?, ?)"
                );
                $statement->execute([
                    htmlspecialchars($pokemon->__get('name')),
                    htmlspecialchars($pokemon->__get('image'))
                ]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        }  
    }

    function delete ($data) {
        if(empty($data['id'])) {
            return false;
        }
        
        try {
            $statement = $this->connection->prepare("DELETE FROM pokemon WHERE id = ?");
            $statement->execute([
                $data['id']
            ]);
        } catch(PDOException $e) {
            print $e->getMessage();
        }
    }


}


?>