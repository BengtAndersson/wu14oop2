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
				for (var i = 0; i < data.length; i++) {
					for (var j = 0; j < data[i].length; j++) {


						$(".selectChallenge").append("<h2>Welcome " + data[i][j].name + " to the game of masters!");
						$(".selectChallenge").append("<p>Pick a challenge by accepting or hit pick new challenge if you want to change</p>");
						$(".selectChallenge").append("<button class='accept_challenge'>Accept challenge</button>");
						$(".selectChallenge").append("<button class='pick_new_challenge'>Pick new challenge");

						console.log("YAY! stored in database", data);
					}
				}

			},
			error: function(data){
				console.log("error", data);
			}

		});
		//return false;
	});



/*	function reset (){
		$.ajax({
			url:"resetdb.php",
			dataType:"json",
			success:function(){
				console.log("Försök att radera db");
			}
		});
	}
reset();

	$(".getButton").click(function(){
		$.ajax({
			url:"get_challenge.php",
			dataType:"json",
			success:function(data){
				console.log("Detta är getChallenge success", data);
			}
		});
	});

	$(".doButton").click(function(){
		$.ajax({
			url:"do_challenge.php",
			data:{
				teamUp:0
			},
			dataType:"json",
			success:function(data){
				console.log("Detta är doChallenge success", data);
			}
		});*/





});