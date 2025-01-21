@foreach ($attribute->attributeValues as $value)
    <div class="badge border-primary primary badge-border">
        {{ $value->getTranslation('value', app()->getLocale()) }}

    </div>
@endforeach
