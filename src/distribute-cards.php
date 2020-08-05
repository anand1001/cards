<?php
$card_list = [
			1=>'S-A',2=>'S-2',3=>'S-3',4=>'S-4',5=>'S-5',6=>'S-6',7=>'S-7',8=>'S-8',9=>'S-9',10=>'S-X',11=>'S-J',12=>'S-Q',13=>'S-K',
			14=>'H-A',15=>'H-2',16=>'H-3',17=>'H-4',18=>'H-5',19=>'H-6',20=>'H-7',21=>'H-8',22=>'H-9',23=>'H-X',24=>'H-J',25=>'H-Q',26=>'H-K',
			27=>'D-A',28=>'D-2',29=>'D-3',30=>'D-4',31=>'D-5',32=>'D-6',33=>'D-7',34=>'D-8',35=>'D-9',36=>'D-X',37=>'D-J',38=>'D-Q',39=>'D-K',
			40=>'C-A',41=>'C-2',42=>'C-3',43=>'C-4',44=>'C-5',45=>'C-6',46=>'C-7',47=>'C-8',48=>'C-9',49=>'C-X',50=>'C-J',51=>'C-Q',52=>'C-K'];

$total_player = file_get_contents('php://input');

//PREPARE CARD SHUFFLING
$keys = array_keys($card_list); 
shuffle($keys); 

$after_shuffle_card_list = array(); 

foreach ($keys as $key) { 
	$after_shuffle_card_list[$key] = $card_list[$key]; 
}
//END PREPARE CARD SHUFFLING

// TOTAL PLAYER MUST BE GREATER THEN 0 OR CAN CHANGE TO GREATER THEN 1 ALSO
if(is_numeric($total_player) && $total_player > 0) {
	$i = 0;
	$count = count($after_shuffle_card_list);

	while($after_shuffle_card_list != null){
		for($p=1;$p <= $total_player;$p++){
			$i = $i+1;
			if($p <= $count) {
				//PICK A TOP CARD FROM A SHUFFLED CARD LIST AND REMOVE IT FROM THE SHUFFLED CARD LIST
				$pick_card = array_shift($after_shuffle_card_list); 
				if($pick_card) {
					//DISTRIBUTE/ASSIGN CARD AND DETAILS TO THE PLAYER 
					$distributed[$p][$i] =  $pick_card; 
				}
			}else{
				$distributed[$p][$i] =  'Zero Card availabe for distribution';   
			}	
		}
	}

	//PREPARE FOR DISPLAY, HOW MANY CARDS DISTRIBUTED TO WHICH PLAYERS 
	$card_detail = '';
	foreach($distributed as $key=>$player_cards){
		$card_detail[$key]= 'Player '.$key.' : '.implode($player_cards,', ');
	}
	//END PREPARE FOR DISPLAY, HOW MANY CARDS DISTRIBUTED TO WHICH PLAYERS 
	
}else{
	$card_detail = 'Invalid no. of players';
}

echo json_encode($card_detail);
?>