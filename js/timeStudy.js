//login script
$( ".signin" ).on( "click", function() {
	var email = $('#InputEmail').val();
	var password = $('#InputPassword').val();
	
	var request = $.getJSON("ajax/signin.php", {useremail : email, userpassword : password}, function(data) {
		console.log(data);
		var login_button = "<button type=\"button\" class=\"btn btn-primary btn-sm signout\" name=\"signout\">Sign Out</button>";
		$(".login_button").html(login_button);
		//$("[name=email]").val(data.first_name);
		var logged = data.logged;
		var user_id = data.user_id;
		var first_name = data.first_name;
		var last_name = data.last_name;
		var auth_level = data.auth_level;


	});
});

function format_date(time_stamp){

	var a = new Date(time_stamp*1000);
	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var year = a.getFullYear();
	var month = months[a.getMonth() - 1];
	var date = a.getDate();
	//var timeDiff = end_time - start_time;
	//var seconds = Math.round(timeDiff % 60);
	//timeDiff = Math.floor(timeDiff / 60);
	//var minutes = Math.round(timeDiff % 60);
	//timeDiff = Math.floor(timeDiff / 60);
	//var hours = Math.round(timeDiff % 24);
	//timeDiff = Math.floor(timeDiff / 24);
	//var days = timeDiff;
	//var elapsed_time = days + " days, " + hours + ":" + minutes + ":" + seconds;
	var displayed_date = month + " " + date + ", " + year;
	
	return displayed_date;

}


