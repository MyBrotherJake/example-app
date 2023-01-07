@component('mail::message')

# 昨日は {{ $count }}件のつぶやきが追加されました！

{{ $toUser->name }}さんこんにちは！

昨日は{{ $count }}件のつぶやきがあったよ！最新のつぶやきを確認しよう！

@component('mail::button', ['url' => route('tweet.index')])
    つぶやきを見に行く？
@endcomponent

@endcomponent