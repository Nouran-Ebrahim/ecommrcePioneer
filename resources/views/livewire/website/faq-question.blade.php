    <div>
        <form wire:submit.prevent="submit">
            <div class="question-section login-section " data-aos="fade-left">
                <div class="review-form">
                    <h5 class="comment-title">Have Any Question</h5>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">Name*</label>
                            <input wire:model.live="name" type="text" id="fname" class="form-control"
                                placeholder="Name">
                            @error('name')
                                <strong role="alert" class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="email" class="form-label">Email*</label>
                            <input wire:model.live="email" type="email" id="email" class="form-control"
                                placeholder="user@gmail.com">
                            @error('email')
                                <strong role="alert" class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="subject" class="form-label">Subject*</label>
                            <input wire:model.live="subject" type="text" id="subject" class="form-control"
                                placeholder="Subject">
                            @error('subject')
                                <strong role="alert" class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="review-textarea">
                        <label for="floatingTextarea">Massage*</label>
                        <textarea wire:model.live="message" class="form-control" placeholder="Write Massage..........." id="floatingTextarea"
                            rows="3"></textarea>
                        @error('message')
                            <strong role="alert" class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="login-btn">
                        <button type="submit" class="shop-btn">Send Now</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
