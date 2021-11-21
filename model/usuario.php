<?php
class Usuario
{
	private $pdo;
    
    public $id;
    public $codigo;
    public $nombre;
    public $apellido;
    public $telefono;
	public $sexo;
    public $correo;
    public $fechaRegistro;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{$result = array();
			if ($_SESSION['user']->rol == 1) {
				$stm = $this->pdo->prepare("SELECT * FROM usuarios");
				$stm->execute();
			} else {
				$stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE user = ?");
				$stm->execute(array($_SESSION['user']->id));
			}

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM usuarios WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE usuarios SET 
						codigo				=?,
						nombre          = ?, 
						apellido        = ?,
						telefono           = ?,
						sexo				= ?,
                        correo        = ?, 
				    WHERE id = ? AND user = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->codigo,
                        $data->nombre,
                        $data->apellido,
                        $data->telefono,
						$data->sexo, 
                        $data->correo,
                        $data->id,
						$_SESSION['user']->id 
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Obtener_Codigo($codigo)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM usuarios WHERE codigo = ?");
			          

			$stm->execute(array($codigo));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{
		try 
		{
		$sql = "INSERT INTO usuarios (codigo,nombre,apellido,telefono,sexo,correo, user) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->codigo,
					$data->nombre,
                    $data->apellido, 
                    $data->telefono,
                    $data->sexo,
                    $data->correo,
					$_SESSION['user']->id 
                )
			);
			$student = new Usuario();
			$student = $this->Obtener_Codigo($data->codigo);
			$this->Registrar_Proyecto($data->proyecto, $student->id);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar_Proyecto($id_proyecto, $id_usuario)
	{
		try{
			$sql = "INSERT INTO proyecto_usuario (id_proyecto,id_estudiante) VALUES (?,?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
						$id_proyecto, $id_usuario
					)
					);
		}catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}