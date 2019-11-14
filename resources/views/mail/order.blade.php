@component('mail::message')
# Introduction
{{ "{$user->fname} {$user->lname}" }} submited his cart, you should make contact

`{{ $user->email }}`.
@component('mail::table')
| Product       | Quantity     | Price  |
| ------------- |:-------------:| --------:|
<?php $total = 0; ?>
@foreach ($cart as $item)
<?php $total += (Float) $item['price'] * $item['quantity'] ?>
| {{ $item['name'] }} | {{ $item['quantity'] }} | {{ number_format($item['price'], 2) }} |
@endforeach
|                   |                    **Total**  |     **{{ number_format($total, 2) }}**     |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
