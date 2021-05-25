<!-- @extends('layout')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h2>ブログ記事一覧</h2>
    <table class="table table-striped">
      <tr>
        <th>記事番号</th>
        <th>日付</th>
        <th>タイトル</th>
        <th></th>
      </tr>
      @foreach($posts as $post)
      <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->created_at }}</td>
        <td>{{ $post->contents }}</td>
        <td>{{ $post->name }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection -->

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Bladeによるこんにちは</title>
</head>
	<body>
		<h1>こんにちは! Blade!</h1>
	</body>
</html>