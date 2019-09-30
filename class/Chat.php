<?php
class Chat{
	private $db;
	
	public function __construct(){
		$config = array();

		$config['db'] = 'scripts_chat';
		$config['host'] = 'localhost';
		$config['user'] = 'root';
		$config['pass'] = '';

		try {
			$this->db = new PDO("mysql:dbname=".$config['db'].";host=".$config['host']."", "".$config['user']."", "".$config['pass']."");
		} catch(PDOException $e) {
			echo "FALHA: ".$e->getMessage();
		}
	}

	public function setUser($post){

		$sql = $this->db->prepare('
			SELECT * FROM cad_logados 
			WHERE nick = :nick');
		$sql->bindValue(':nick', $post['nick']);
        $sql->execute();

        if ($sql->rowCount() == 0) {
         	$sql = $this->db->prepare('
         		INSERT INTO cad_logados
         		SET nick = :nick, sexo = :sexo');
         	$sql->bindValue(':nick', $post['nick']);
         	$sql->bindValue(':sexo', $post['sexo']);
        	$sql->execute();

        	$_SESSION['user']['id'] = $this->db->lastInsertId();

         	return true;
        } else {
        	return false;
        }
	}

	public function getUser(){
		$sql = $this->db->prepare('
			SELECT 
			cad_logados.*, 
			(SELECT COUNT(*) FROM cad_logados) as qt 
			FROM cad_logados ORDER BY nick ASC');
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getImg($sexo){
		$sql = $this->db->prepare('
			SELECT * FROM img_nick 
			WHERE sexo = :sexo');
		$sql->bindValue(':sexo', $sexo);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
	}

	public function sair($nick){
		$sql = $this->db->prepare('
			DELETE FROM cad_logados
			WHERE nick = :nick');
		$sql->bindValue(':nick', $nick);
        $sql->execute();

        return true;
	}
	public function delLogados($id){
		$sql = $this->db->prepare('
			DELETE FROM cad_logados
			WHERE id = :id');
		$sql->bindValue(':id', $id);
        $sql->execute();

        return true;
	}

	public function setMensagem($post){
		$sql = $this->db->prepare('
         		INSERT INTO mensagens
         		SET id_nick = :id_nick, 
         		mensagem = :mensagem');
     	$sql->bindValue(':id_nick', $post['id_nick']);
     	$sql->bindValue(':mensagem', $post['mensagem']);
    	$sql->execute();

     	return true;
	}

	public function getMensagens(){
		$sql = $this->db->prepare('
         		SELECT 
         		mensagens.*, 
         		cad_logados.nick,
         		cad_logados.sexo 
         		FROM mensagens
         		INNER JOIN cad_logados
         		ON mensagens.id_nick = cad_logados.id');
    	$sql->execute();

     	return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function delMensagens($id_nick){
		$sql = $this->db->prepare('
			DELETE FROM mensagens
			WHERE id_nick = :id_nick');
		$sql->bindValue(':id_nick', $id_nick);
        $sql->execute();

        return true;
	}
}