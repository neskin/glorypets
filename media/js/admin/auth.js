$(document).ready(function(){
	$("#login_form").submit(function(){
		var login = $("#login").val();
		var password = $("#password").val();
		send_post(HOST+'admin/login/', {'login':login, 'password':password}, 'check_auth_status(data)');
		return false;
	});
});

function check_auth_status(data){
	if(data == 1){
		alert('Авторизация успешна');
		window.location.reload();
	} else {
		alert('Вы не авторизировались');
	}
}