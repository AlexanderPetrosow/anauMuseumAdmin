<?php
    // ----------- QR CODE GENERATOR ----------
    
    include('../phpqrcode/qrlib.php');
    
    // outputs image directly into browser, as PNG stream
    for ($i=0; $i < count($tickets); $i++) { 
        // $login = urlencode($tickets[$i]['login']);
        // $password = urlencode($tickets[$i]['password']);
        // QRcode::png('http://museum.telekecitm.com/tm/auth/'.$login.'/'.$password, '../public/assets/img/qr/ticket-'.$tickets[$i]['id'].'.png', 'H', 8, 2);
        QRcode::png('https://muzey.akbugday.org/tm/auth/'.$tickets[$i]['login'].'/'.$tickets[$i]['password'], '../public/assets/img/qr/ticket-'.$tickets[$i]['id'].'.png', 'H', 8, 2);
    }
    
    // Ticket num correct
    function ticketIds($id){
        $ids = "0";
        $max = 7;
        $max -= strlen($id);
        if($max != 0){
            for ($i=1; $i < $max; $i++) { 
                $ids .= "0";
            }
            $ids .= $id;
        } else {
            $ids = $id;
        }
        return $ids;
    }
    // -- END ----------------------- QR CODE -
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Print</title>
</head>
<body>
    <style>
    *{
        margin: 0;
        padding: 0;
        font-family: Helvetica;
    }
    .page{
        height: 114mm;
        width: 57mm;
        border-top: 2px dotted #000000;
        border-bottom: 1px dotted #000000;
        text-align: center;
    }
    .pt-15{
        padding-top: 15px;
    }
    .pt-10{
        padding-top: 10px;
    }
    .px-10{
        padding-left: 10px;
        padding-right: 10px;
    }
    .str-bold{
        font-weight: bold;
        font-size: 14px;
    }
    .str-upper{
        text-transform: uppercase;
    }
    .between{
        display: flex;
        justify-content: space-between;
    }
    .bb-2{
        border-bottom: 2px solid #000000;
    }
    </style>

    @for($i = 0; $i < count($tickets); $i++)
    <div class="page">
        <p class="str-bold pt-15">№ 000000{{$orderId}}</p>
        <p class="pt-10" style="width: 90%; margin: 0 auto;"><i>"Beýik Saparmyrat Türkmenbaşy adyndaky Milli Ak bugdaý muzeýi"</i></p>
        <div class="between pt-10 px-10 bb-2">
            <span>{{ticketIds($tickets[$i]['id'])}}</span>
            <span>{{$today}}</span>
        </div>
        <div class="between pt-10 px-10 str-upper">
            <span>Görnüşi:</span>
            @foreach($tariffs as $tariff)
                @if($tariff['id'] == $tickets[$i]['tariff_id'])
                    <span>{{$tariff['tm_name']}}</span>
                @endif
            @endforeach
        </div>
        <div class="between px-10 bb-2 str-upper">
            <span>Bahasy:</span>
            @foreach($currencies as $currency)
                @if($currency['id'] == $tickets[$i]['currency_id'])
                    <span>{{$tickets[$i]['price']}} {{$currency['name']}}</span>
                @endif
            @endforeach
        </div>
        <br>
        <div>
            <img src="{{asset('assets/img/qr/ticket-'.$tickets[$i]['id'].'.png')}}" width="180">
        </div>
        @foreach($users as $user)
            @if($user['id'] == $tickets[$i]['user_id'])
                <p class="pt-10" style="font-size: 14px;"><span class="str-bold str-upper">Kassir:</span> <span>{{$user['name']}}</span></p>
            @endif
        @endforeach
    </div>
    @endfor
    <script>
        window.onafterprint = window.close();
        window.print();
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (!mql.matches) {
                window.location.replace("/{{$lang}}/admin/tickets");
            }
        });
    </script>
</body>
</html>