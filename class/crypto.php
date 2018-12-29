<?php 

	class Crypto
	{

		private $pattern = "abcnoFGHpqrstuvwqyzABCDEIJKdefghijklmLMNOPQRST2345UVWQYZ167890";

		private function div($x, $y) {
			$sisa = $x % $y;
			return ($x-$sisa) / $y;			
		}

		private function getPos($chr) {
			$pattern = $this->pattern;
			for ($i=0; $i < strlen($pattern); $i++) { 
				if($chr==$pattern[$i])
					return $i;
			}
		}

		public function encrypt($x) {
			$out = "";
			for($i=0; $i<strlen($x); $i++){
				$rr = ord($x[$i]);
				$p = ($i+1)*2;
				$s = $this->div($rr, $p);
				$out .= $this->pattern[$s]."".$this->pattern[$rr%$p];
			}
			return $out;		
		}

		public function decrypt($x) {
			$in = "";
			for($i=0; $i<strlen($x); $i+=2){
				$ii = $this->getPos($x[$i]);
				$iii = $this->getPos($x[$i+1]);
				$p = $i+2;
				$num = ($ii*$p)+$iii;
				$in .= chr($num);
			}

			return $in;
		}

	}

 ?>