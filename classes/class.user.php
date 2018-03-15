<?php


class User{

    private $db;

	function __construct($db){
		$this->_db = $db;
	}

	public function is_logged_in(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}

	private function get_user_hash($username){

		try {

			$stmt = $this->_db->prepare('SELECT * FROM blog_members WHERE username = :username');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		} catch(PDOException $e) {
		    echo '<p class="error">'.$e->getMessage().'</p>';
		}
	}


	public function login($username,$password){

		$user = $this->get_user_hash($username);

		if($password == $user['password']){

		    $_SESSION['loggedin'] = true;
		    $_SESSION['memberID'] = $user['memberID'];
		    $_SESSION['username'] = $user['username'];
		    $_SESSION['role'] = $user['role'];
		    return true;
		}
	}


	public function logout(){
		session_destroy();
	}

}


?>
