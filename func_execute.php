<?php
	function get_output($input){
		// load of each Centre
		$ld[1]=0;
		$ld[2]=0;
		$ld[3]=0;
		//load and Centre-value of each product
		$load['A']=3.0;$C['A']=1;
		$load['B']=2.0;$C['B']=1;
		$load['C']=8.0;$C['C']=1;
		$load['D']=12.0;$C['D']=2;
		$load['E']=25.0;$C['E']=2;
		$load['F']=15.0;$C['F']=2;
		$load['G']=0.5;$C['G']=3;
		$load['H']=1.0;$C['H']=3;
		$load['I']=2.0;$C['I']=3;
		
		//deconstruction of input
		$it = 0;
		$len = strlen($input);
		while($it < $len){
			if($input[$it] == '-'){
				$ch = $input[$it-1];
				$quantity = 0;
				$it++;
				while($it<$len){
					if(!is_numeric($input[$it])){break;}
					$quantity = $quantity*10;
					$quantity += (int)$input[$it];
					$it++;
				}
				$ld[$C[$ch]] += $load[$ch]*$quantity;
			}
			else $it++;
		}
		
		//checking for invalidity
		if($ld[1]+$ld[2]+$ld[3] <= 0.0){
			return 0;
			exit;
		}
		
		//processing
		$res = -1;
		$i = 0;
		
		while($i < 5){
			$j = 0;
			while($j < 5){
				if($j==$i){}
				else{
					$k = 0;
					while($k < 5){
						if($k==$j || $k==$i){}
						else{
							$tmp = array(0,0,0,0,0,0);
							$tmp[$i]=1;$tmp[$j]=2;$tmp[$k]=3;
							// tmp is a configuration of travelling
							$it = 0;
							$total=0.0;	// total weight
							$tmpcst=0.0;	// total cost of this config.
							$deliv =0.0;	// total weight delivered
							while($it<5){
								if($tmp[$it] == 4){
										$deliv += $total;
										$total=0.0;
										if($deliv == $ld[1]+$ld[2]+$ld[3]){break;}
										if($tmp[$it+1] == 0){$tmp[$it+1]=4;}
										if($tmp[$it+1] == 3){$tmpcst += 20.0;}
										if($tmp[$it+1] == 2){$tmpcst += 25.0;}
										if($tmp[$it+1] == 1){$tmpcst += 30.0;}
								}
								else{
									
									//updating total weight
									$total += $ld[$tmp[$it]];
									
									//determining cost per unit distance (cst)
									$x = (int)($total/5);
									$cst = (float)($x*8);
									if((float)($x*5) < $total){$cst += 10.0;}
									else {
										if($total > 0.0){$cst += 2.0;}
										else {$cst = 10.0;}
									}
									if($tmp[$it+1]==0){$tmp[$it+1]=4;}
									
									
									// adding cost of path to tmpcst
									if($tmp[$it]+$tmp[$it+1]==3){
										$tmpcst += 4.0*$cst;
									}
									if($tmp[$it]+$tmp[$it+1]==4){
										$tmpcst += 5.0*$cst;
									}
									if($tmp[$it]+$tmp[$it+1]==5 && $tmp[$it]==1){
										$tmpcst += 3.0*$cst;
									}
									if($tmp[$it]+$tmp[$it+1]==5 && ($tmp[$it]==2 || $tmp[$it]==3)){
										$tmpcst += 3.0*$cst;
									}
									if($tmp[$it]+$tmp[$it+1]==6){
										$tmpcst += (2.5)*$cst;
									}
									if($tmp[$it]+$tmp[$it+1]==7){
										$tmpcst += 2.0*$cst;
									}
									
								}
								$it++;
							}
							if($res == -1){$res = $tmpcst+1;}
							if($tmpcst < $res){
								$res = $tmpcst;
							}
						}
						$k++;
					}
				}
				$j++;
			}
			$i++;
		}
		return $res;
	}

?>
