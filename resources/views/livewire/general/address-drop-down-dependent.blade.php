<div>
    <div class="form-group">
        <label for="country_id">Country</label>
        <select name="country_id" wire:model.live="countryId" class="form-control" id="country_id">
            <option value="" selected>Select Country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        @error('country_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="government_id">Government</label>
        <select name="government_id" wire:model.live="governorateId" class="form-control" id="government_id">
            <option value="" selected>Select Government</option>
            @foreach ($governorates as $governorate)
                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
            @endforeach
        </select>
        @error('government_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="city_id">City</label>
        <select name="city_id" wire:model="cityId" class="form-control" id="city_id">
            <option value="" selected>Select City</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
        @error('city_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
