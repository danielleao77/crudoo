<?php
require_once 'Crud.php';

class Usuarios extends Crud{
	
	protected $table = 'crud';
	private $nome;
	private $email;
	private $msg;
	
	public function setNome($nome){
		
		$this->nome = $nome;
		
	}
	public function getNome(){
		return $this->nome;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setMsg($msg){
		$this->msg = $msg;
	}
	
	public function insert(){
		$sql = "INSERT INTO $this->table (nome, email, msg) VALUES (:nome, :email, :msg)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':msg', $this->msg);
		return $stmt->execute();
	}//insert
	
	public function update($id){
		
		$sql = "UPDATE $this->table SET nome = :nome, email = :email, msg = :msg WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':msg', $this->msg);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}
	
	function validaemail($email){
		//verifica se e-mail esta no formato correto de escrita
		if (!ereg('^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
			$mensagem='E-mail Inv&aacute;lido!';
			return $mensagem;
		}
		else{
			//Valida o dominio
			$dominio=explode('@',$email);
			if(!checkdnsrr($dominio[1],'A')){
				$mensagem='E-mail Inv&aacute;lido!';
				return $mensagem;
			}
			else{return true;
			} // Retorno true para indicar que o e-mail é valido
		}
	}
	
	
}