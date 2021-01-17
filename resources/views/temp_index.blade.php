<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <h3>Доходы:</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Категория</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomes as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->sum }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d.m.Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Расходы:</h3>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Категория</th>
                            <th>Сумма</th>
                            <th>Обязательный платеж</th>
                            <th>Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $expence)
                            <tr>
                                <td>{{ $expence->title }}</td>
                                <td>{{ $expence->category->name }}</td>
                                <td>{{ $expence->sum * -1 }}</td>
                                <td>{{ $expence->mandatory ? 'Да' : 'Нет' }}</td>
                                <td>{{ \Carbon\Carbon::parse($expence->date)->format('d.m.Y') }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    {{--                    <div class="summary__wrap" style="border: 1px solid #ccc; padding: 20px;">--}}
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h2>{{ $balance }} грн.</h2>
                            <h3>Баланс</h3>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h3>{{ $allIncomes }} грн.</h3>
                            <h4>Всего доходов: </h4>
                        </div>
                        <div class="col-md-4">
                            <h3>{{ $allMandatory }} грн.</h3>
                            <h4>Всего обязательных расходов: </h4>
                        </div>
                        <div class="col-md-4">
                            <h3>{{ $allExpenses }} грн.</h3>
                            <h4>Всего расходов: </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well">
                                <form action="{{ route('store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Заголовок</label>
                                        <input type="text" class="form-control" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Категория</label>
                                        <select name="category_id" id="" class="form-control">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Сумма</label>
                                        <input type="text" class="form-control" id="sum" name="sum">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Дата</label>
                                        <input type="text" class="form-control" id="dt" name="date">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Тип</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="0">Расходы</option>
                                            <option value="1">Доходы</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="mandatory">
                                            <input type="checkbox" name="mandatory" id="mandatory">
                                            Обязательный расход
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('locales/bootstrap-datepicker.ru.min.js') }}"></script>
<script>
    $("#dt").datepicker({
        language: 'ru'
    });
</script>
</body>
</html>
