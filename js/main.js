$ (function(){

	$(".startButton").click(function(){
		var playerName = $('#charname').val();
		var playerClass = ($("input[type='radio']:checked").val());
		console.log("Dina val: ",playerName, playerClass);
		$.ajax({
			url:"start_game.php",
			dataType:"json",
			data:{
				playerName: playerName,
				playerClass: playerClass
			},
			success:function(data){
				console.log("Detta är startGame success: ", data);
				$(".choices").hide();			
				$(".selectChallenge").append("<h2>Välkommen " + data.name + " till Herre på täppan!");
				$(".selectChallenge").append("<p>Acceptera utmaningen eller välj en ny</p>");
				$(".selectChallenge").append("<button class='accept_challenge'>Anta utmaningen</button>");
				$(".selectChallenge").append("<button class='pick_new_challenge'>Välj en ny utmaning");

			
				console.log("Vi verkar ha lyckats spara något i databasen !", data);


			},
			error: function(data){
				console.log("error: ", data);
			}

		});
		return false;
	});









});