<?php



class PokemonController {
    public function __construct () {
        $this->dao = new PokemonDAO();
    }
    public function showRecherche(){
        include('views/recherche.php');
    }

    public function list(){
        $pokemons = $this->dao->fetchAll();
        include('views/list.php');
        
    }
    public function delete($data){
    	$this->dao->delete($data);
    }
    public function add($data){
        $this->dao->store($data);
    }

}