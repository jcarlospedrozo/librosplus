$('input[name="registroEmail"]').change(function () {
	$(".alert").remove();
})

$('input[name="registroEmail"]').change(function () {
	var email = $(this).val();
	console.log(email);

	var datos = new FormData();
	datos.append("validarEmail", email);

	$.ajax({
		url: urlPrincipal + "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			if (respuesta) {
				$("input[name='registroEmail']").val("");
				$("input[name='registroEmail']").after(`

				<div class="alert alert-warning">
					<strong>ERROR:</strong>
					El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente
				</div>
				`);
				return;
			}
		}
	})
})

$(".facebook").click(function () {
	FB.login(function (response) {
		// console.log(response);
		validarUsuario();
	}, { scope: 'public_profile, email' })
})

function validarUsuario() {
	FB.getLoginStatus(function (response) {
		statusChangeCallback(response);
	})
}

function statusChangeCallback(response) {
	if (response.status === 'connected') {
		testApi();
	} else {
		Swal.fire({
			icon: "error",
			title: "¡Eror!",
			text: "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
			showConfirmButton: true,
			confirmButtonText: "Cerrar"
		}).then((result) => {
			if(result.value){   
				history.back();
		  	}
		})
	}
}

function testApi() {
	FB.api('/me?fields=id,name,email,picture', function (response) {
		if (response.email == null) {
			Swal.fire({
				icon: "error",
				title: "¡Error!",
				text: "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",
				showConfirmButton: true,
				confirmButtonText: "Cerrar"
			}).then((result) => {
				if(result.value){  
					history.back();
			 	} 
			})
			return;
		} else {
			var email = response.email;
			// console.log(email);
			var nombre = response.name;
			// console.log(nombre);
			var foto = "http://graph.facebook.com/" + response.id + "/picture?type=large";

			var datos = new FormData();
			datos.append("emailUsuario", email);
			datos.append("nombreUsuario", nombre);
			datos.append("fotoUsuario", foto);

			$.ajax({

				url: urlPrincipal + "ajax/usuarios.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function (respuesta) {
					if (respuesta == "ok") {
						window.location = urlPrincipal + "perfil";
					} else {
						Swal.fire({
							icon: "error",
							title: "¡Error!",
							text: "¡El correo electrónico " + email + " ya está registrado con un método diferente a Facebook!"
						}).then((result) => {
							if (result.value) {
								FB.getLoginStatus(function (response) {
									if (response.status === 'connected') {
										FB.logout(function (response) {
											deleteCookie("fblo_770126790213592");
											setTimeout(function () {
												window.location = urlPrincipal + "salir";
											}, 500)
										});
										function deleteCookie(name) {
											document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
										}
									}
								})
							}
						})
					}
				}
			})
		}
	})
}

$(".salir").click(function (e) {
	e.preventDefault();

	FB.getLoginStatus(function (response) {
		if (response.status === 'connected') {
			FB.logout(function (response) {
				deleteCookie("fblo_2180677115313399");
				setTimeout(function () {
					window.location = urlPrincipal + "salir";
				}, 500)
			});

			function deleteCookie(name) {
				document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
			}

		} else {
			setTimeout(function () {
				window.location = urlPrincipal + "salir";
			}, 500)
		}
	})
})