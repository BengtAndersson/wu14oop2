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


			},
			error: function(data){
				console.log("error", data);
			}

		});
		return false;
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
*/
/*
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
		});
	});
*/
});