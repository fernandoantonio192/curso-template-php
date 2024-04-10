<?php 

namespace app\controllers;

use app\framework\database\Connection;

class LoginController {

	public function index() {
		var_dump("Login");
	}

	public function store() {
		
		$email = strip_tags($_POST["email"]);
		$password = strip_tags($_POST["password"]);

		if (empty($email) || empty($password)) {
			var_dump("usuário ou senha inválidos");
			die();
		}

		$connect = Connection::getConnection();
		$prepare = $connect->prepare("SELECT id, firstName, email FROM tb_users WHERE email = :email");
		$prepare->execute([
			":email" => $email
		]);

		$userFound = $prepare->fetchObject();

		if (!$userFound) {
			var_dump("usuário ou senha inválidos");
			die();
		}

		if ($password == $userFound->password) {
			var_dump("usuário ou senha inválidos");
			die();
		}

		$_SESSION["logged"] = true;
		unset($userFound->password);
		$_SESSION["user"] = $userFound;

		redirect("/dashboard");

	}

}