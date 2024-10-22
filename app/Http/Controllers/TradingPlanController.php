<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TradingPlanController extends Controller
{
    public function index(Request $request){
        $i = 0;
        $months = [];
        if(isset($request->initial_fund)){
        $i  = $request->initial_fund;
        $fund_added_each_month=$request->fund_added_each_month;
        $winPrecentMin=$request->win_precent_min/10;
        $winPrecentMax=$request->win_precent_max/10;
        $m  = 0;
        $f  = $i/$request->initial_fund_divide_by;
        $l  = $request->loss_percentage;
        $p  = $request->profit_percentage;
        $trads = $request->trads;
        $charges = 0;
        $months[0]['month_profit_loss_with_charges'] = $m ;
        $months[0]['profit_trade'] = 0 ;
        $months[0]['loss_trade'] = 0 ;
        $months[0]['charges'] = $charges ;
        $months[0]['fund_used'] = $f ;
        $equity_type = $request->equity_type;
        $exchange = $request->exchange;
        $charges = 0;
        for($n=1; $n<=$request->months; $n++) {
            if($n == 1){
                $i = $i + $m;
            } else {
                $i = $i + $m + $fund_added_each_month;
            }
            $f = $i/$request->initial_fund_divide_by;
            $winPrecent = rand($winPrecentMin,$winPrecentMax)*10;
            $pt = $trads*$winPrecent/100;
            $lt = $trads*(100-$winPrecent)/100;
            $charges = $trads* $this->tradeCharges($equity_type,$f,$exchange);
            $m_without_charges= (($f/100)*($p*$pt-$l*$lt));
            $m = $m_without_charges - $charges;
            $months[$n-1]['fund_used'] = round($f);
            $months[$n-1]['profit_trade'] = $pt;
            $months[$n-1]['profit_percentage_in_month'] = $winPrecent.'%';
            $months[$n-1]['loss_percentage_in_month'] = 100-$winPrecent. '%';
            $months[$n-1]['loss_trade'] = $lt;
            $months[$n-1]['month_profit_loss'] = round($m_without_charges);
            $months[$n-1]['month_profit_loss_with_charges'] = round($m);
            $months[$n-1]['charges'] = round($charges);
        } 
    }
        return Inertia::render('Trading',[
            'i' => round($i),
            'months' => $months
        ]);
    }
    public function tradeCharges($type,$f,$exchange) {
        switch ($type) {
            case 'equity-delivery':
                  return $this->deliveryCharges($f,$exchange);
                break;
            case 'equity-intraday':
                  $this->intradayCharges($f,$exchange);
                break;
            case 'futures':
                  $this->futuresCharges($f, $exchange);
                break;
            default:
                $this->deliveryCharges($f, $exchange);
                break;
        }
    }

    public function deliveryCharges($f,$exchange) {
        $brokerage = 0;
        $turnover = $f*2;
        $sttCtt = ($turnover*0.1)/100;
        if($exchange == 'NSE') {
            $transactionCharges = ($turnover*0.00325)/100;
        } else {
            $transactionCharges = ($turnover*0.00375)/100;
        }

        $sebiCharges= $this->calSebiCharges($turnover);
        
        if($f > 10000000){
            $stampCharges = ($f*0.015)/100;
        }else {
            $stampCharges = $f*(15/100000);
        }

        $gst = $this->calGst($brokerage,$sebiCharges,$transactionCharges);
        return $brokerage + $sttCtt + $transactionCharges + $sebiCharges + $stampCharges + $gst;
    }
    public function intradayCharges($f,$exchange) {
        $brokerage = 20;
        $brokeragePercent = $f*0.03/100;
        if($brokeragePercent<20){
            $brokerage = $brokeragePercent;
        }
        $turnover = $f*2;
        $sttCtt = ($f*0.025)/100;
        if($exchange == 'NSE') {
            $transactionCharges = ($turnover*0.00325)/100;
        } else {
            $transactionCharges = ($turnover*0.00375)/100;
        }
        $sebiCharges= $this->calSebiCharges($turnover);
        
        if($f > 10000000){
            $stampCharges = ($f*0.003)/100;
        }else {
            $stampCharges = $f*(3/100000);
        }
        $gst = $this->calGst($brokerage,$sebiCharges,$transactionCharges);
        return $brokerage + $sttCtt + $transactionCharges + $sebiCharges + $stampCharges + $gst;
    }
    public function futuresCharges($f,$exchange) {
        $brokerage = 20;
        $brokeragePercent = $f*0.03/100;
        if($brokeragePercent<20){
            $brokerage = $brokeragePercent;
        }
        $turnover = $f*2;
        $sttCtt = ($f*0.0125)/100;
        if($exchange == 'NSE') {
            $transactionCharges = ($turnover*0.0019)/100;
        } else {
            $transactionCharges = 0;
        }
        $sebiCharges= $this->calSebiCharges($turnover);
        
        if($f > 10000000){
            $stampCharges = ($f*0.002)/100;
        }else {
            $stampCharges = $f*(2/100000);
        }
        $gst = $this->calGst($brokerage,$sebiCharges,$transactionCharges);
        return $brokerage + $sttCtt + $transactionCharges + $sebiCharges + $stampCharges + $gst;
    }
    public function calGst($brokerage,$sebiCharges,$transactionCharges) {
        return (($brokerage + $sebiCharges + $transactionCharges)*18)/100;
    }
    public function calSebiCharges($turnover) {
        return $turnover*1/1000000;
    }
}
