<?php

namespace App\Livewire\Website\Dashboard;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use App\Models\Government;
use Livewire\Attributes\On;

class ProfileInfo extends Component
{
    public $screen = 'dashboard';

    public $name , $email , $phone ;
    public $country_id,$government_id,$city_id;
    public $auth_user;
    public function mount($auth_user)
    {
        $this->auth_user = $auth_user;
        $this->name = $auth_user->name;
        $this->email = $auth_user->email;
        $this->phone = $auth_user->phone;
        $this->country_id = $auth_user->country->id;
        $this->government_id = $auth_user->governorate->id;
        $this->city_id = $auth_user->city->id;
    }

    #[On('personalSelectScreen')]
    public function selectScreen($screen)
    {
        $this->screen = $screen;
    }

    protected function rules()
    {
        return[
            'name' => 'required|string|max:255',
            'email'=> 'required|email|max:255',
            'phone'=> 'required|numeric',
            'country_id' => 'required|exists:countries,id',
            'government_id' => 'required|exists:governments,id',
            'city_id' => 'required|exists:cities,id',
        ];
    }

    public function updateProfile()
    {
        $this->validate();
        $this->auth_user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country_id' => $this->country_id,
            'government_id' => $this->government_id,
            'city_id' => $this->city_id,
        ]);
        $this->dispatch('profileUpdated', __('website.profile_updated_successfully'));
    }
    public function render()
    {
        return view('livewire.website.dashboard.profile-info',[
              'countries'    => Country::get(),
              'governorates' => $this->country_id ? Government::where('country_id', $this->country_id)->get() : [],
              'cities'       => $this->government_id ? City::where('government_id', $this->government_id)->get() : [],
        ]);
    }
}
