$(document).ready(function(){

  let pokename, pokeimage, intervalId, isRandomizing = false;
  
  // name -> Name
  let capitalizeFirstLetter = (str) => {
    return str[0].toUpperCase() + str.slice(1);
  }

  let fetchRandomPokemon = () => {
    $.get('https://pokeapi.co/api/v2/pokemon/'+Math.floor(Math.random()*898), function(){
    }).done(function(response){
      if (response.sprites && response.sprites.front_default && response.name) {
        $('#resultat').html("<img src="+response.sprites.front_default+"></img>" + capitalizeFirstLetter(response.name));
        $("#add input").removeAttr('disabled');
        pokename = capitalizeFirstLetter(response.name);
        pokeimage = response.sprites.front_default;
      }              
    }).fail(function(error){
      console.log(error);
    });
  }



  // Recherche de pokémon
  $('#poke-api').on('submit', function(e){
    e.preventDefault();
    let data = {}; 
    data.name = $(this).find('input[name="recherche"]').val().toLowerCase();
    if (data.name.length > 0 || $("#add input").attr('disabled','disabled')) {
      $.get('https://pokeapi.co/api/v2/pokemon/'+data.name, function(){
      }).done(function(response){
        if (response.sprites && response.sprites.front_default && response.name) {
          $('#resultat').html("<img src="+response.sprites.front_default+"></img>" + capitalizeFirstLetter(response.name));
          $("#add input").removeAttr('disabled');
          pokename = capitalizeFirstLetter(data.name);
          pokeimage = response.sprites.front_default;
        }
      })
      .fail(function(error){
        $('#resultat').text("No Pokémon Matched Your Search!");
        $("#add input").attr('disabled','disabled');
      });
    }
  });

  // Adding a Pokémon
  $("#add").on("submit", function(e){
    if (pokename && pokeimage) {
      let data = {
        'name' : pokename,
        'image': pokeimage
      };

  $.post("index.php", data, function(){
      }).done(function(response){
        console.log("Successfully added "+data.name);
        delete data;
      }).fail(function(error){
        console.log("There was an error adding "+data.name);
      });
    }
  });


  // Deleting a Pokémon
  $('.del-form').on('submit', function(e){
    console.log($(this).find('input[type="hidden"]').val());
    let data = {
      'id' : $(this).find('input[type="hidden"]').val(),
      'delete-pokemon' : true
    };
    $.post("index.php",data, function(){
    }).done(function(response){
      console.log("Successfully removed.");
    }).fail(function(error){
      console.log("Failed to remove.");
    });
  });

  //Randomizing Pokémons
  $('#randomizer').on('click', function(e){
    e.preventDefault();
    isRandomizing = !isRandomizing;
    if (isRandomizing) {
      $('input[name="randomizer"]').attr('value','Stop Randomizing');
      fetchRandomPokemon();
      intervalId = setInterval(fetchRandomPokemon, 5000);
    } else {
      $('input[name="randomizer"]').attr('value','Start Randomizing');
      $('#add input').attr('disabled','disabled');
      pokename = null;
      pokeimage = null;
      $('#resultat').html('');
      clearInterval(intervalId);
    }
  });


})