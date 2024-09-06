<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <style>
        body {
            background: rgb(204,204,204); 
        }
        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            /* box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); */
        }
        page[size="A4"] {  
            width: 21cm;
            height: 29.7cm; 
        }
        .qrs{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .w-5{
            width: 5cm;
        }
        .h-5{
            height: 5cm;
        }
        .t-center{
            text-align: center;
        }
    </style>
    <?php
    // ----------- QR CODE GENERATOR ----------
    
    include('../phpqrcode/qrlib.php');
    for ($i=0; $i < count($exposure); $i++) { 
        // echo $exhibit[$i]['ru_name'];
        QRcode::png('content/'.$exposure[$i]['id'].'/0', '../public/assets/img/qr/exposure-'.$exposure[$i]['id'].'.png', 'H', 8, 2);
    }

    // -- END ----------------------- QR CODE -

    $c = 0;
?>
</head>
<body>
    @for ($p = 0; $p < count($exposure); $p++)
        @if($c == 0)
            <page size="A4">
                <div class="qrs">
        @endif
                    <div class="w-5">
                        <img class="w-5 h-5" src="{{ asset('assets/img/qr/exposure-'.$exposure[$p]['id'].'.png') }}">
                        <div class="t-center">
                            <span>{{$exposure[$p]['tm_name']}}</span>
                        </div>
                    </div>
        @if($c == 19)
                </div>
            </page>
        @endif
        @php
            // echo $c;
            $c == 19 ? $c = 0 : $c++; 
        @endphp
    @endfor
    <script>
        window.print();
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (!mql.matches) {
                window.location.replace("/{{$lang}}/admin/exposures");
            }
        });
    </script>
</body>
</html>