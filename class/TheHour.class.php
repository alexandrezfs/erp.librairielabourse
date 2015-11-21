<?php  

	class TheHour {

		private $transacCount;
		private $totalTransac;
		private $totalProd;

		function TheHour() {

			$transacCount = 0;
			$totalTransac = 0;	
		}

		public function getTotalTransac()
		{
		    return $this->totalTransac;
		}

		public function setTotalTransac($totalTransac)
		{
		    $this->totalTransac = $totalTransac;
		    return $this;
		}

		public function getTransacCount()
		{
		    return $this->transacCount;
		}
		
		public function setTransacCount($transacCount)
		{
		    $this->transacCount = $transacCount;
		    return $this;
		}

		public function getTotalProd()
		{
		    return $this->totalProd;
		}
		
		public function setTotalProd($totalProd)
		{
		    $this->totalProd = $totalProd;
		    return $this;
		}

	}

?>