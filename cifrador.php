<?php
	class Cipher {
		private $key;
		private $cipherMethod;
		
		public function __construct($key, $cipherMethod = 'AES-256-CBC') {
			$this->key = hash('sha256', $key, true); // Convertir la clave a una clave de 256 bits
			$this->cipherMethod = $cipherMethod;
		}
	
		public function encrypt($plainText) {
			$ivlen = openssl_cipher_iv_length($this->cipherMethod);
			$iv = openssl_random_pseudo_bytes($ivlen);
			
			$cipherTextRaw = openssl_encrypt($plainText, $this->cipherMethod, $this->key, $options=OPENSSL_RAW_DATA, $iv);
			$hmac = hash_hmac('sha256', $cipherTextRaw, $this->key, $as_binary=true);
			
			return base64_encode($iv.$hmac.$cipherTextRaw);
		}
	
		public function decrypt($cipherText) {
			$c = base64_decode($cipherText);
			$ivlen = openssl_cipher_iv_length($this->cipherMethod);
			
			$iv = substr($c, 0, $ivlen);
			$hmac = substr($c, $ivlen, $sha2len=32);
			$cipherTextRaw = substr($c, $ivlen + $sha2len);
			
			$plainText = openssl_decrypt($cipherTextRaw, $this->cipherMethod, $this->key, $options=OPENSSL_RAW_DATA, $iv);
			$calcmac = hash_hmac('sha256', $cipherTextRaw, $this->key, $as_binary=true);
	
			if(hash_equals($hmac, $calcmac)) { // Compara dos cadenas sin ser vulnerable a ataques de temporización
				return $plainText;
			}
	
			return false; // Si el HMAC no coincide, devuelve false
		}
	}
?>