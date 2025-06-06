<?php

namespace App\Livewire\Website;

use App\Services\Website\FaqService;
use Livewire\Component;

class FaqQuestion extends Component
{
    public $name, $email, $subject, $message;

    protected FaqService $faqService;
    public function boot(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function rules()
    {
        return [
            "name" => "required|min:2|max:100",
            "email" => "required|email|max:100",
            "subject" => "required|min:2|max:100",
            "message" => "required|min:2|max:1000",
        ];
    }
    public function updated()
    {
        $this->validate();
    }
    public function submit()
    {
        $this->validate();
        $data = [
            "name" => $this->name,
            "email" => $this->email,
            "subject" => $this->subject,
            "message" => $this->message,
        ];
        $faq = $this->faqService->createFaqQuestion($data);
        if (!$faq) {
            $this->dispatch('faq-question-faild', __('messages.general_error'));
        }
        $this->reset();
        $this->dispatch('faq-question-created', __('messages.added_successfully'));

    }
    public function render()
    {
        return view('livewire.website.faq-question');
    }
}
