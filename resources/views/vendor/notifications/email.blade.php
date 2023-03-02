@component('mail::message')
{{-- Greeting --}}
    @if (! empty($greeting))
    # {{ $greeting }}
    @else
    @if ($level === 'error')
    # @lang('Что то пошло не так! :( ')
    @else
    # @lang('Привет!')
    @endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('C уважением'),<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
    @slot('subcopy')
        @lang(
        "Если кнопка \":actionText\" не работает, скопируйте и вставьте ссылку\n".
        'В ваш браузер:',
        [
        'actionText' => $actionText,
        ]
        ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
    @endslot
@endisset
@endcomponent
