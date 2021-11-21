<?php
class User
{
	private $pdo;

	public $id;
	public $username;
	public $password;
	public $rol;


	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Obtener($username)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM user WHERE username = ?");


			$stm->execute(array($username));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo
				->prepare("DELETE FROM estudiantes WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}



	public function Registrar(User $data)
	{
		try {
			$sql = "INSERT INTO user (username,password,rol) 
		        VALUES (?, ?, 2);";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->email,
						md5($data->password),
					)
				);
				$stm = $this->Obtener($data->email);
			$sql = "INSERT INTO informacionpersonal (codigo,nombre,apellido,telefono,sexo,correo,user) 
		        VALUES (?,?,?,?,?,?,?);";

			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->code,
						$data->name,
						$data->last_name,
						$data->telephone,
						$data->sexo,
						$data->email,
						$stm->id
						
					)
				);
			return $stm;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Verificar($username, $password)
	{
		try {
			$stm = $this->pdo
				->prepare("SELECT * FROM user WHERE username = ? AND password = ?");

			$stm->execute(array($username, md5($password)));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}
