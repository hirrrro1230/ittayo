@extends('layout')
<title>ユーザー登録</title>

@section('content')

<div class="container">
  <section class="section">
    <div class="column is-4 is-offset-4">
      <h1 class="title is-2 has-text-centered has-text-grey">ユーザー登録</h1>

      {!! Form::open(['url' => '/users']) !!}
        <div class="box">
          <div class="field">
            <label for='label'>
              ユーザ名 :
            </label>
            <p class="control">
              {!! Form::text('name', null, ['class' => 'input is-medium']) !!}
            </p>
          </div>
          <div class="field">
            <label for='label'>
              パスワード :
            </label>
            <p class="control">
              {!! Form::password('password', ['class' => 'input is-medium']) !!}
            </p>
          </div>

          <div class="field">
            <label for='label'>
              パスワード確認 :
            </label>
            <p class="control">
              {!! Form::password('password_confirmation', ['class' => 'input is-medium']) !!}
            </p>
          </div>

          <br>
          <div class="field">
            <p class="control" style="width:100%">
              {!! Form::submit('登録', ['class' => 'button is-primary is-medium', 'style' => 'width:100%']) !!}
            </p>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </section>
</div>

@endsection