<!DOCTYPE html>
<html lang="ru" xml:lang="ru">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Результат рассчета калькулятора</title>
    <style>
        html, body{
            width: 100vw;
            height: 100vh;
            background-color: #E4E5E9;
            margin:0;
            padding:0;
            font-family: "Graphik LCG";
            text-size-adjust: 100%;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }
        .content-wrapper{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .score-card{
            width: 480px;
            height: 388px;
            background-color:#FFF;
            box-shadow: 7px 11px 17px rgba(0,0,0,.05);
            padding:40px;
            box-sizing:border-box;
        }
        h1{
            margin:0;
            font-size: 20px;
            line-height: 24px;
            color: #464648;
            font-weight: 500;
            display:block;
        }
        .date{
            font-size: 14px;
            line-height: 20px;
            color: #76767C;
            display: block;
            margin-top:4px;
        }
        ul{
            padding: 0;
            list-style: none;
            margin: 24px 0 0;
        }
        li {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 16px;

        }
        li span {
            font-size: 16px;
            line-height: 20px;
            color: #464648;
        }
        .divider{
            width:100%;
            height: 1px;
            background-color: #e4e5e9;
            margin-top:24px;
            margin-bottom: 24px;
        }
        .result-score{
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .result-span{
            font-size: 18px;
            line-height: 24px;
            font-weight: 500;
            color: #464648;
        }
    </style>
<body> 
    <div class="content-wrapper">
        <div class="score-card">
            <h1>{{$data->note}}</h1>
            <span class="date">{{$data->date}}</span>
            <ul>
                <li>
                    <span>Кредитный эксперт:</span>
                    <span>{{$data->managername}}</span>
                </li>
                <li>
                    <span>Тип кредита:</span>
                    <span>{{$data->type}}</span>
                </li>
                <li>
                    <span>FTP:</span>
                    <span>{{$data->ftp}}%</span>
                </li>
                <li>
                    <span>Валовая маржа:</span>
                    <span>{{$data->gross}}%</span>
                </li>
                <li>
                    <span>Скидка:</span>
                    <span>{{$data->decent}}%</span>
                </li>
            </ul>
            <div class="divider"></div>
            <div class="result-score">
                <span class="result-span">
                    Итого:
                </span>
                <span class="result-span">
                    {{$data->result}}%
                </span>
            </div>
        </div>
    </div>
    <h1></h1>
    <img src="{{public_path()}}/assets/logo_f.svg">
    <img src="{{public_path()}}/assets/invoices/1.jpg">
</body>

</html>