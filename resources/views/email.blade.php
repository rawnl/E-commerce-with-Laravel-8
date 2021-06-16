<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body style="margin:0;padding:0;">
        <div style="background:#fff">
            <div style="max-width:100%;margin:0px auto;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color:#fff;">
                    <tbody>
                        <tr>
                            <td>
                                <div style="max-width:100%;box-sizing:border-box; background:#161616">
                                    <div style="width:100%;max-width:575px;min-width:300px;margin:auto;text-align:center;padding:15px">
                                        {{ config('app.name') }}
                                    </div>
                                    <div style="width:100%;max-width:575px;min-width:300px;background:#fff;margin:auto;box-sizing:border-box;border-radius:4px;border-bottom-left-radius:0;border-bottom-right-radius:0;padding:50px 30px 10px;">
                                        <h1 style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#3d4852;font-size:18px;font-weight:bold;margin-top:0;text-align:left">
                                          Bonne nouvelle :)
                                        </h1>
                                        <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">

                                            <p>Bonjour {{ $data['nom']}} {{$data['prenom']}} ,</p>
                                            <p>L'équipe ECOMM est très ravie de vous annoncer que l'article que vous avez tant attender est de nouveau en stock </p>
                                            <!--<img src="{{asset('storage/images/'.$data['product_image'])}}" style="height: 110px;" alt="product image">-->
                                            <p>Article : {{$data['product_name']}}</p>
                                            <p>Prix : {{$data['product_price']}}</p>
                                            <p>Détails : </p>
                                            <p>{{$data['product_description']}}</p>
                                            <br>
                                            <p>On vous invite d'aller visiter le site <a href="http://127.0.0.1:8000">E-COMM</a> et faites votre commande avant l'épuisement des stocks.</p>

                                        </p>                                   
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="width:100%;max-width:575px;min-width:300px;margin-left:auto;margin-right:auto; box-sizing:border-box;border-radius:4px;border-top-left-radius:0;border-top-right-radius:0;padding:10px 30px 50px; box-shadow: 5px 5px 5px #dadada;">                          
    
                                    <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        @lang('Thanks,')<br>
                                        {{ config('app.name') }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>       
            
            <div style="max-width:100%;margin:0px auto;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
                    <tbody>
                        <tr>
                            <td>
                                <div style="width:100%;max-width:575px;min-width:300px;margin:auto;box-sizing:border-box;padding-top:20px;padding-bottom:20px;padding-left:15px;padding-right:15px;">
                                    
                                    <p style="text-align:center; font-family:verdana;">
                                        <a href="http://127.0.0.1:8000" style="text-align:center;font-size:13px;line-height:1.5;color:#999999; text-decoration: none; color: cornflowerblue;     display: flex; align-items: center; justify-content: center;">
                                            {{ config('app.name') }} © 2021 </a>
                                    </p>

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>