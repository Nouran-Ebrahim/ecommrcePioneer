<x-mail::message>
    # Hello {{ $clientName }}

    thanks for contcat us.
    **Our Response:**
    {{ $replyMessage }}

    <x-mail::button :url="config('app.url')">
        Vist our website
    </x-mail::button>

    Thanks,<br>
    **{{ config('app.name') }}**
    {{ config('app.url') }}
</x-mail::message>
