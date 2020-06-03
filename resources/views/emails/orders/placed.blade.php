@component('mail::message')
# Objednávka prijatá

Ďakujeme za váš nákup. 

**ID objednávky:** {{ $order->id }}

**Email:** {{ $order->billing_email }}

**Meno:** {{ $order->billing_name }}

**Celkom:** €{{ round($order->billing_total / 100, 2) }}

**Objednané položky:**

@foreach ($order->products as $product)
Názov: <b>{{ $product->name }}</b> <br>
Cena: €{{ round($product->price / 100, 2) }} <br>
Množstvo: {{ $product->pivot->quantity }} <hr>
@endforeach

Bližšie informácie môžete vidieť po prihlásení sa do vášho účtu.
@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Na stránku
@endcomponent

Znova ďakujeme, že ste si nás vybrali.

S pozdravom,<br>
{{ config('app.name') }}
@endcomponent