@extends('partials.user_nav')

@section('content')
<h1 class="brand-header">編集</h1>

<div class="container">
  {!! Form::open(['route' => ['confirm.updata', $question->id], 'method' => 'post']) !!}
    <h3>タイトル</h3>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {!! Form::text('title', $question->title, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('title')}}</span>
      </div>
    <h3>カテゴリ</h3>
    <div class="form-group @if(!empty($errors->first('tag_category_id'))) has-error @endif">
      <select name='tag_category_id'　class = "form-control"　id =　"pref_id">
        <option value= "{{$question->tag_category_id}}">{{$question->category->name}}</option>
        @foreach($categories as $category)
        <option value= "{{$category->id}}">{{$category->name}}</option>
        @endforeach
      </select>
      <span class="help-block">{{$errors->first('tag_category_id')}}</span>
    </div>
    <h3>質問内容</h3>
      <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
        {!! Form::textarea('content', $question->content, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('content')}}</span>
      </div>
      {!! Form::hidden('id', $question->id, ['class' => 'form-control']) !!}
      <button type="submit" class="btn btn-success pull-right">確認</button>
  {!! Form::close() !!}
</div>
@endsection
