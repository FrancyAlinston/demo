<?php
  array('ID#','Voucher#','User','Date','Ledger','Type','Forum','Account','Narration','Amount','Action');
   foreach ($transactions as $tran) {
     if($tran->type == 'Reciept'){
       $voucher = 'R'.$tran->receipt_id;
     }elseif($tran->type == 'Payment'){
       $voucher = 'P'.$tran->payment_id;
     }elseif($tran->type == 'Contra'){
       $voucher = 'C'.$tran->contra_id;
     }
array(
        $tran->id,
        $voucher,
        $tran->accountant,
        date('d-m-Y',strtotime($tran->tran_date)),
        $tran->ledger,
        $tran->type,
        $tran->forum,
        $tran->account,
        $tran->narration,
        $tran->amount
      );
   ?>