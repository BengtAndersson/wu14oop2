$ (function(){

	$(".startButton").click(function(){
		var playerName = $('#charname').val();
		var playerClass = ($("input[type='radio']:checked").val());
		$.ajax({
			url:"start_game.php",
			dataType:"json",
			data:{
				playerName: playerName,
				playerClass: playerClass
			},
			success:function(data){
				console.log("Detta är startGame success", data);
			}
		});
	});


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