<?php

while (! file_exists("functions")) {
    chdir("..");
}

require "vendor/autoload.php";
include_once("functions/Conexion.php");

use \Firebase\JWT\JWT;
JWT::$leeway = 60;

class AccesoDatos {
        
  public function __construct()
  {
      $this->secret_key = "YOUR_SECRET_KEY";
      $conexion = new Conexion();
      $conexion->abrir_conexion();
      $this->conn = $conexion->retornar_conexion();
  }

  function solo_verificar_ingreso($user,$password) {

    $query = "SELECT id, nombre, clave, id_tipo FROM usuarios WHERE nombre = ? LIMIT 0,1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $user);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row["id"];
        $usuario = $row["nombre"];
        $id_tipo = $row["id_tipo"];
        $clave2 = $row["clave"];

        if(password_verify($password, $clave2))
        {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
  }

  function ingreso($user,$password) 
  {
    $query = "SELECT id, nombre, clave, id_tipo FROM usuarios WHERE nombre = ? LIMIT 0,1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $user);
    $stmt->execute();
    $num = $stmt->rowCount();

    if($num > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row["id"];
        $usuario = $row["nombre"];
        $id_tipo = $row["id_tipo"];
        $clave2 = $row["clave"];

        if(password_verify($password, $clave2))
        {
            $secret_key = $this->secret_key;
            $issuer_claim = "THE_ISSUER";
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time();
            $expire_claim = $issuedat_claim + (10 * 365 * 24 * 60 * 60);
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $id,
                    "usuario" => $usuario,
                    "id_tipo" => $id_tipo,
            ));

            $jwt = JWT::encode($token, $secret_key);

            return $jwt;
        }
        else
        {
            return null;
        }
    } else 
    {
      return null;
    }
  }

  public function es_admin($usuario) {
    $response = false;
    $sql = $this->conn->prepare("SELECT id_tipo FROM usuarios WHERE nombre = :usuario");
    $sql->execute(array("usuario" => $usuario));
    $resultado = $sql->fetch();
    $id_tipo = $resultado["id_tipo"];
    if($id_tipo=="1") {
      $response = true;
    } else {
      $response = false;
    }
    $this->conn = null;
    return $response;
  }

  public function validar($token)
    {
      try
      {
          $decoded = JWT::decode($token, $this->secret_key, array("HS256"));
          return true;
      }
      catch (Exception $e)
      {
        echo $e;exit;
        //return false;
      }
  }

  public function leerToken($token)
  {
      try
      {
          $decoded = JWT::decode($token, $this->secret_key, array("HS256"));

          $unencodedData = (array) $decoded;

          $info = array (
            "id" => $unencodedData["data"]->id,
            "usuario" => $unencodedData["data"]->usuario,
            "id_tipo" => $unencodedData["data"]->id_tipo,
          );

          $info = json_encode($info);

          return $info;

      } catch (Exception $e)
      {
        return null;
      }
  }

  public function __destruct() 
  { 
    $this->conn = null;
  }

}

?>